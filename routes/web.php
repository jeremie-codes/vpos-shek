<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Models\Country;

Route::get('/', function () {
    $countries = Country::all();
    return view('index', compact('countries'));
})->name('index');
Route::get('/error', function () { return view('error'); })->name('error');
Route::post('/vpos/pay', [PaymentController::class, 'purchase'])->name('vpos.purchase');
Route::get('/vpos/check-payment/{orderNumber}', [PaymentController::class, 'check'])->name('vpos.check');

Route::get('/vpos/callback/{code}', [PaymentController::class, 'callback'])->name('payment.callback');
Route::get('/payment/success', function () { return view('success'); })->name('success');
Route::get('/payment/cancel',  function () { return view('cancel'); })->name('payment.cancel');
Route::get('/payment/declined',  function () { return view('decline'); })->name('payment.decline');
