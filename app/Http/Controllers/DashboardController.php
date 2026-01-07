<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SectionCarousel;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get carousel items count
        $carouselCount = SectionCarousel::count();

        // Get users count
        $userCount = User::count();

        // Get subscribed users count
        $subscribedUsersCount = User::where('is_subscribed', true)
            ->where('subscription_ends_at', '>', now())
            ->count();

        // Get revenue this month
        $monthlyRevenue = Subscription::where('status', 'success')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        // Get total revenue
        $totalRevenue = Subscription::where('status', 'success')->sum('amount');

        // Get visitor stats for last 7 days
        $visitorStats = Visitor::select(
            DB::raw('DATE(visit_date) as date'),
            DB::raw('COUNT(DISTINCT ip_address) as visitors')
        )
        ->where('visit_date', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Get today's visitors
        $todayVisitors = Visitor::where('visit_date', today())
            ->distinct('ip_address')
            ->count();

        // Get recent subscriptions
        $recentSubscriptions = Subscription::with('user')
            ->where('status', 'success')
            ->latest()
            ->take(5)
            ->get();

        // Get last login days
        $lastLoginDays = 0; // You can implement this feature if you have a last_login field in your users table

        // Get recent carousel items
        $recentCarouselItems = SectionCarousel::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'carouselCount',
            'userCount',
            'subscribedUsersCount',
            'monthlyRevenue',
            'totalRevenue',
            'visitorStats',
            'todayVisitors',
            'recentSubscriptions',
            'lastLoginDays',
            'recentCarouselItems'
        ));
    }
}
