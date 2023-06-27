<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Sun\Epay\Http\Controllers\EpayCallbackController;

Route::post('notification', EpayCallbackController::class);
