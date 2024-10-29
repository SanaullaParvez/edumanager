<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', [CompanyController::class, 'index'])->name('/');
Route::get('/features/all', [FeatureController::class, 'index'])->name('/features');
Route::get('/pricing/all', [PricingController::class, 'index'])->name('/pricing');
Route::get('/download/apps', [CompanyController::class, 'downloadApps'])->name('/download-apps');
Route::get('/about/company', [CompanyController::class, 'aboutUs'])->name('/about-us');
Route::get('/contact-us', [CompanyController::class, 'contactUs'])->name('/contact');
Route::get('/customer/sign-up', [CustomerController::class, 'signUp'])->name('/customer-sign-up');
Route::post('/customer/add', [CustomerController::class, 'addCustomer'])->name('/add-new-customer');
Route::get('/customer/confirmation-message', [CustomerController::class, 'message'])->name('/confirmation-message');
Route::get('/customer/sign-in/new', [CustomerController::class, 'signInForm'])->name('/customer-sign-in-form');
Route::post('/customer/sign-in', [CustomerController::class, 'signInCustomer'])->name('/customer-sign-in');
Route::post('/customer/sign-out', [CustomerController::class, 'signOutCustomer'])->name('/customer-sign-out');
Route::get('/customer-email-check', [CustomerController::class, 'customerEmailCheck'])->name('customer-email-check');

//************Manage Client****************//

Route::get('/client/all', [ClientController::class, 'allClients'])->name('/clients');
Route::get('client/view-client/{id}', [ClientController::class, 'viewclientInfo'])->name('/view-client');

Route::get('client/unpublished/{id}', [ClientController::class, 'unpublishedCustomerInfo'])->name('unpublished-customer');
Route::get('client/published/{id}', [ClientController::class, 'publishedCustomerInfo'])->name('published-customer');

Route::get('client/send-mail/{id}', [ClientController::class, 'sendMainToClient'])->name('/send-mail');
Route::post('/client/mail/send', [ClientController::class, 'saveClientMailInfo'])->name('/save-client-mail-info');
Route::get('client/delete/{id}', [ClientController::class, 'deleteCustomer'])->name('/delete-client');

Route::get('/customer/deposit-slip/{id}', [ClientController::class, 'downloadDepositClip'])->name('/download-deposit-slip');

Route::get('/customer/download-order-invoice/{id}', [ClientController::class, 'downloadOrderInvoice'])->name('/download-order-invoice');

Route::get('/home', [HomeController::class, 'index'])->name('home');

//************Manage Checkout****************//


Route::get('/customer/shipping/info/{id}', [CustomerController::class, 'shippingInfo'])->name('/shipping-info');

Route::post('/customer/shipping/info/save', [CheckoutController::class, 'saveShippingInfo'])->name('/save-shipping-info');

Route::get('/customer/checkout/cancel_url', [CheckoutController::class, 'cancelMessage'])->name('/cancel-url');

Route::get('/customer/checkout/fail_url', [CheckoutController::class, 'failMessage'])->name('/fail-url');

Route::get('/customer/checkout/success_url', [CheckoutController::class, 'onlinePaymentResponse'])->name('/success-url');


Route::get('/customer/checkout/success_notice', function () {
    return view('front.checkout.success-message');
});


