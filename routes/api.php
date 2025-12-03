<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;


Route::post('/notifications/order', [NotificationController::class, 'notifyCustomerOrder']);
