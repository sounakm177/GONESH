<?php

use Illuminate\Support\Facades\Route;

Route::post('inbound/email', [\App\Http\Controllers\InboundEmailController::class, 'receive'])
    ->name('inbound.email');