<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\WebshopController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get("locale/{lang}", [LocalizationController::class, 'setlang']);

Auth::routes();

Route::get('customer/register', [CustomerController::class, 'create'])->name('customers.register');

Route::post('customer/register/new', [CustomerController::class, 'store'])->name('customers.register.new');

Route::middleware('can:manage-delivery')->group(function () {
    Route::get('deliveries/search', [DeliveryController::class, 'Search'])->name('deliveries.search');
    Route::get('deliveries/import', [DeliveryController::class, 'Import'])->name('deliveries.import');
    Route::get('deliveries/import/examplefile', [DeliveryController::class, 'DownloadExamplefile'])->name('deliveries.importexample');

    Route::get('pickups', [PickupController::class, 'index'])->name('pickups.index');
    Route::get('pickups/all', [PickupController::class, 'all'])->name('pickups.all');

    Route::post('deliveries/print-labels', [DeliveryController::class, 'PrintLabels'])->name('deliveries.print-labels');
    Route::post('deliveries/{delivery}/print-delivery-label', [DeliveryController::class, 'PrintDeliveryLabel'])->name('delivery.print-delivery-label');

    Route::post('deliveries/import', [DeliveryController::class, 'SaveImportedDeliveries'])->name('deliveries.saveimporteddeliveries');
    Route::post('pickups/request', [PickupController::class, 'store'])->name('pickups.request');

    Route::resource('deliveries', DeliveryController::class)->except(['create', 'edit']);
});

Route::middleware('can:show-delivery')->group(function () {
    Route::get('deliveries', [DeliveryController::class, 'index'])->name('deliveries.index');
    Route::get('deliveries/{delivery}', [DeliveryController::class, 'show'])->name('deliveries.show');
    Route::get('deliveries/search', [DeliveryController::class, 'Search'])->name('deliveries.search');

});

Route::middleware('can:manage-users')->group(function () {
    Route::resource('users', UserManagementController::class)->except(['show', 'store']);
});

Route::middleware('can:manage-webshops')->group(function () {
    Route::resource('webshops', WebshopController::class);
});

Route::middleware('can:review-delivery')->group(function () {
    Route::post('deliveries/review/{delivery}', [ReviewController::class, 'create']);
});




















