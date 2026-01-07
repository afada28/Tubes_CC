<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Disable SSL verification for development (Avast/Firewall issue)
        if (!isset(\Midtrans\Config::$curlOptions)) {
            \Midtrans\Config::$curlOptions = [];
        }
        \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYHOST] = 0;
        \Midtrans\Config::$curlOptions[CURLOPT_SSL_VERIFYPEER] = 0;
    }

    public function index()
    {
        return view('payment.index');
    }

    public function createTransaction(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'duration' => 'required|in:1,3,6,12', // months
        ]);

        $user = auth()->user();
        $orderId = 'SUB-' . $user->id . '-' . time();

        // Create subscription record
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'order_id' => $orderId,
            'amount' => $request->amount,
            'status' => 'pending',
            'expires_at' => now()->addMonths($request->duration),
        ]);

        // Prepare transaction details for Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $request->amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => 'subscription-' . $request->duration,
                    'price' => (int) $request->amount,
                    'quantity' => 1,
                    'name' => 'Subscription ' . $request->duration . ' Bulan',
                ]
            ],
            'callbacks' => [
                'finish' => route('payment.finish'),
            ]
        ];

        try {
            // Log params for debugging
            \Log::info('Midtrans Request Params:', $params);
            \Log::info('Midtrans Config:', [
                'server_key' => \Midtrans\Config::$serverKey,
                'is_production' => \Midtrans\Config::$isProduction,
            ]);

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $orderId,
            ]);
        } catch (\Throwable $e) {
            \Log::error('Midtrans Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'code' => $e->getCode(),
            ]);

            // Return more detailed error for debugging
            $errorMessage = $e->getMessage();

            // Check if it's a merchant/credential error
            if (strpos($errorMessage, '10023') !== false || strpos($errorMessage, '401') !== false) {
                return response()->json([
                    'error' => 'Kredensial Midtrans tidak valid',
                    'details' => 'Server Key atau Client Key salah. Silakan cek kembali di Dashboard Midtrans.',
                    'raw_error' => $errorMessage
                ], 500);
            }

            return response()->json([
                'error' => 'Gagal membuat transaksi: ' . $errorMessage,
                'details' => 'Terjadi kesalahan saat menghubungi Midtrans API'
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $serverKey = config('services.midtrans.server_key');
            $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

            if ($hashed == $request->signature_key) {
                $subscription = Subscription::where('order_id', $request->order_id)->first();

                if ($subscription) {
                    if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                        $subscription->update([
                            'status' => 'success',
                            'transaction_id' => $request->transaction_id,
                            'payment_type' => $request->payment_type,
                            'paid_at' => now(),
                        ]);

                        // Update user subscription status
                        $user = $subscription->user;
                        $user->update([
                            'is_subscribed' => true,
                            'subscribed_at' => now(),
                            'subscription_ends_at' => $subscription->expires_at,
                        ]);
                    } elseif ($request->transaction_status == 'pending') {
                        $subscription->update([
                            'status' => 'pending',
                            'transaction_id' => $request->transaction_id,
                        ]);
                    } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
                        $subscription->update([
                            'status' => 'failed',
                            'transaction_id' => $request->transaction_id,
                        ]);
                    }
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function finish(Request $request)
    {
        $orderId = $request->order_id;
        $subscription = Subscription::where('order_id', $orderId)->first();

        if ($subscription) {
            return view('payment.finish', compact('subscription'));
        }

        return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan.');
    }

    public function checkStatus($orderId)
    {
        try {
            $status = \Midtrans\Transaction::status($orderId);

            $subscription = Subscription::where('order_id', $orderId)->first();

            if ($subscription && in_array($status->transaction_status, ['capture', 'settlement'])) {
                $subscription->update([
                    'status' => 'success',
                    'transaction_id' => $status->transaction_id,
                    'payment_type' => $status->payment_type,
                    'paid_at' => now(),
                ]);

                $user = $subscription->user;
                $user->update([
                    'is_subscribed' => true,
                    'subscribed_at' => now(),
                    'subscription_ends_at' => $subscription->expires_at,
                ]);
            }

            return response()->json($status);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
