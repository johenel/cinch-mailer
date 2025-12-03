<!DOCTYPE html>
<html>
    <body>
        <div style="display: block;">
            <div>
                <h1>Order Summary</h1>
            </div>
            <div>
                <b>Unique Product:</b> {{$order->product_count}}
            </div>
            <div>
                <b>Total Items:</b> {{$order->item_total_count}}
            </div>
            <div>
                <b>Delivery Address:</b> {{$order->address}}
            </div>
            <div>
                <b>Note:</b> {{$order->note}}
            </div>
            <table style="margin-top: 20px;">
                <thead>
                    <tr>
                        <th style="padding: 10px;text-align: left;">Product Name</th>
                        <th style="padding: 10px;text-align: center;">Price</th>
                        <th style="padding: 10px;text-align: center;">Quantity</th>
                        <th style="padding: 10px;text-align: center;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td style="padding: 10px;text-align: left;">{{$item->product_name}}</td>
                            <td style="padding: 10px;text-align: center;">{{$item->product_price}}</td>
                            <td style="padding: 10px;text-align: center;">{{$item->quantity}}</td>
                            <td style="padding: 10px;text-align: center;">{{$item->quantity * $item->product_price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="padding: 10px;text-align: center;">VAT</td>
                        <td style="padding: 10px;text-align: center;">{{$order->total_price_with_tax - $order->total_price}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td style="padding: 10px;text-align: center;">Total Price</td>
                        <td style="padding: 10px;text-align: center;">{{$order->total_price_with_tax}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>
