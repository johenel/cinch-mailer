<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotifyCustomerOrderRequest;
use App\Mail\OrderEmail;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function notifyCustomerOrder(NotifyCustomerOrderRequest $request): JsonResponse
    {
        $orderId = $request->get('order_id');
        $order = Order::find($orderId);

        if (empty($order)) {
            return response()->json(['message' => 'Invalid order'], 401);
        }

        // Send the email notification
        Mail::to($order->email)->queue(new OrderEmail($orderId));

        return response()->json([
            'message' => 'Order confirmation sent.'
        ]);
    }
}
