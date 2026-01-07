<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\FounderJourneyController;
use App\Http\Controllers\SectionCarouselController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\PublicJourneyController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\VolunteerParticipantController;
use App\Models\FounderJourney;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainPageController::class, 'index'])->name('welcome');

Auth::routes();

// Google OAuth Routes (no middleware to prevent redirect loops)
Route::get('auth/google', [App\Http\Controllers\Auth\GoogleAuthController::class, 'redirect'])->name('auth.google')->middleware('guest');
Route::get('auth/google/callback', [App\Http\Controllers\Auth\GoogleAuthController::class, 'callback'])->name('auth.google.callback');

// Logout Route
Route::post('logout', [App\Http\Controllers\Auth\GoogleAuthController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ---------------------------------------- ADMIN ROUTE ---------------------------------------- //

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::get('/admin/users', [App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}', [App\Http\Controllers\Admin\UserManagementController::class, 'show'])->name('admin.users.show');
    Route::post('/admin/users/{id}/toggle-admin', [App\Http\Controllers\Admin\UserManagementController::class, 'toggleAdmin'])->name('admin.users.toggle-admin');

    // Analytics Routes
    Route::get('/admin/analytics', [App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('admin.analytics.index');
    Route::get('/admin/analytics/chart-data', [App\Http\Controllers\Admin\AnalyticsController::class, 'getChartData'])->name('admin.analytics.chart-data');

    Route::resource('carousel', SectionCarouselController::class);
    Route::resource('about', AboutController::class);
    Route::resource('milestone', MilestoneController::class);
    Route::resource('journey-founder', FounderJourneyController::class);
    Route::resource('donate', DonateController::class);
    Route::get('/admin/donate/{id}/participants', [DonateController::class, 'participants'])->name('donate.participants');

    Route::resource('volunteer', VolunteerController::class);
    Route::get('/admin/volunteer/{id}/participants', [VolunteerController::class, 'participants'])->name('volunteer.participants');
    Route::patch('admin/volunteer/{volunteerId}/participants/{participantId}/status', [VolunteerController::class, 'updateParticipantStatus'])->name('volunteer.updateParticipantStatus');
});

// ---------------------------------------- PUBLIC ROUTE ---------------------------------------- //
// Founder Journey Route
Route::get('/perjalanan', [PublicJourneyController::class, 'index'])->name('journey.index');
Route::get('/perjalanan/{id}', [PublicJourneyController::class, 'show'])->name('journey.show');

// Donation Route
Route::get('/donation', [App\Http\Controllers\DonationController::class, 'index'])->name('donation.index');
Route::get('/donation/{id}', [App\Http\Controllers\DonationController::class, 'show'])->name('donation.show');
Route::post('/donation/store', [App\Http\Controllers\DonationController::class, 'store'])->name('donation.store');
Route::get('/donation/success/{id}', [App\Http\Controllers\DonationController::class, 'success'])->name('donation.success');

// Volunteers Route
Route::get('/volunteers', [VolunteerParticipantController::class, 'index'])->name('volunteers.index');
Route::get('/volunteers/{id}', [VolunteerParticipantController::class, 'show'])->name('volunteers.show');
Route::post('/volunteers/participant/store', [VolunteerParticipantController::class, 'store'])->name('volunteers.participant.store');
Route::get('/volunteers/participant/success/{id}', [VolunteerParticipantController::class, 'success'])->name('volunteers.participant.success');


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// ---------------------------------------- PAYMENT ROUTE ---------------------------------------- //
Route::middleware('auth')->group(function () {
    Route::get('/subscription', [App\Http\Controllers\PaymentController::class, 'index'])->name('subscription.index');
    Route::post('/payment/create', [App\Http\Controllers\PaymentController::class, 'createTransaction'])->name('payment.create');
    Route::get('/payment/finish', [App\Http\Controllers\PaymentController::class, 'finish'])->name('payment.finish');
    Route::get('/payment/status/{orderId}', [App\Http\Controllers\PaymentController::class, 'checkStatus'])->name('payment.status');
});

// Midtrans Callback (no auth needed)
Route::post('/payment/callback', [App\Http\Controllers\PaymentController::class, 'callback'])->name('payment.callback');
