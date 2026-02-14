<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'installed'], function () {
    Route::group(['middleware' => 'protectedPage'], function () {
        Route::any('/admin', [AdminController::class, 'index']);
        Route::get('admin/logout', [AdminController::class, 'logout']);
        Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
        Route::resource('admin/category', CategoryController::class);
        Route::resource('admin/services', ServiceController::class);
        Route::post('admin/services/approve', [ServiceController::class, 'approve']);
        Route::post('admin/services/status', [ServiceController::class, 'change_status']);
        Route::any('admin/payouts', [ProviderController::class, 'payouts']);
        Route::post('admin/complete_payout_request', [ProviderController::class, 'complete_payout_request']);
        Route::any('admin/providers', [ProviderController::class, 'index']);
        Route::resource('admin/users', UserController::class);
        Route::resource('admin/pages', PageController::class);
        Route::resource('admin/city', CityController::class);
        Route::resource('admin/bookings', BookingController::class);
        Route::any('admin/commission', [SettingController::class, 'commission']);
        Route::any('admin/general-settings', [SettingController::class, 'general_settings']);
        Route::any('admin/profile-settings', [SettingController::class, 'profile_settings']);
        Route::post('admin/change-password', [SettingController::class, 'change_password']);
        Route::any('admin/social-settings', [SettingController::class, 'social_settings']);
        Route::any('admin/contact-queries', [SettingController::class, 'contact_queries']);
        Route::any('admin/banner', [SettingController::class, 'banner_settings']);
        Route::post('admin/users/change-status', [UserController::class, 'userChangeStatus']);
        Route::any('admin/transactions', [PaymentController::class, 'transactions']);
        Route::any('admin/payment_methods', [PaymentController::class, 'payment_methods']);
    });


    Route::get('/', [HomeController::class, 'index']);
    Route::get('/all-categories', [HomeController::class, 'all_categories']);
    Route::get('/c/{text}', [HomeController::class, 'cat_services']);


    Route::get('/search', [HomeController::class, 'search']);

    Route::get('signup', [UserController::class, 'create']);
    Route::get('provider-signup', [ProviderController::class, 'create']);
    Route::post('signup', [UserController::class, 'store']);
    Route::group(['middleware' => 'userProtectedPage'], function () {
        Route::any('/login', [UserController::class, 'login']);
        Route::get('profile', [UserController::class, 'show']);
        Route::post('profile', [UserController::class, 'update']);
        Route::any('change-password', [UserController::class, 'change_password']);
        Route::get('dashboard', [UserController::class, 'dashboard']);
        Route::get('my-services', [ProviderController::class, 'my_services']);
        Route::get('add-service', [ProviderController::class, 'add_service']);
        Route::post('/add-service', [ServiceController::class, 'store']);
        Route::get('edit-service/{id}', [ServiceController::class, 'edit']);
        Route::post('update-service', [ServiceController::class, 'update']);
        Route::post('service-status', [ServiceController::class, 'change_status']);

        Route::any('availability', [ProviderController::class, 'availability']);

        Route::get('provider-bookings', [ProviderController::class, 'provider_bookings']);

        Route::get('my-bookings', [UserController::class, 'user_bookings']);

        Route::get('book-service/{text}', [HomeController::class, 'book_service']);

        Route::post('submit-booking', [HomeController::class, 'submit_booking']);

        Route::post('accept-booking', [BookingController::class, 'accept_booking']);

        Route::post('reject-booking', [BookingController::class, 'reject_provider_booking']);

        Route::post('cancel-booking', [BookingController::class, 'cancel_booking']);

        Route::post('complete-booking', [BookingController::class, 'complete_booking']);

        Route::get('my-wallet', [UserController::class, 'my_wallet']);

        Route::post('withdraw-wallet', [ProviderController::class, 'withdraw_payment_wallet']);

        Route::any('payout-settings', [ProviderController::class, 'payout_settings']);

        Route::get('payout-requests', [ProviderController::class, 'payout_requests']);

        Route::get('pay-with-paypal/{id}', [PaymentController::class, 'payWithpaypal']);
        Route::get('/paypal/status', [PaymentController::class, 'getPaymentStatus'])->name('paypal-status');
        Route::get('/pay-with-razorpay/{id}/{text}', [PaymentController::class, 'payWithRazorpay']);
    });

    Route::any('/contact', [HomeController::class, 'contact']);
    Route::any('logout', [UserController::class, 'logout']);

    Route::get('{text}/{slug}', [HomeController::class, 'singlePage']);

    Route::get('/{text}', [HomeController::class, 'footer_pages']);
});
