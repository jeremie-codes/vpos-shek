<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Models\Country;
use App\Http\Middleware\SetLocale;

Route::get('/', function () {
    $locale = request()->getPreferredLanguage(['fr', 'en']);
    return redirect('/' . $locale);
});

Route::prefix('{locale}')
    ->where(['locale' => 'fr|en'])
    ->middleware(SetLocale::class)
    ->group(function () {

        Route::get('/', function () {
            $countries = Country::all()->sortBy('name');

            return view('index', compact('countries'));
        })->name('index');

        Route::get('/error', function () {
            return view('error');
        })->name('error');

        Route::get('/payment/success/{code}', [PaymentController::class, 'success'])
        ->name('payment.success');

        Route::get('/payment/cancel/{code}', [PaymentController::class, 'cancel'])
        ->name('payment.cancel');

        Route::get('/payment/declined/{code}', [PaymentController::class, 'decline'])
        ->name('payment.decline');
    });

    Route::post('/vpos/pay', [PaymentController::class, 'purchase'])
    ->name('vpos.purchase');

    Route::get('/vpos/check-payment/{orderNumber}', [PaymentController::class, 'check'])
    ->name('vpos.check');

    Route::get('/vpos/callback/{code}', [PaymentController::class, 'callback'])
    ->name('payment.callback');
