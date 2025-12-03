<?php

namespace Tests\Feature\Api;

use App\Mail\OrderEmail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NotificationControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test products
        Product::truncate();
        OrderItem::query()->delete();
        Order::query()->delete();

        Product::query()->insert([
            [
                'name' => 'Washing Machine #1',
                'description' => 'test description washing machine',
                'price' => 450.50,
                'stock' => 23
            ],
            [
                'name' => 'Kettle #1',
                'description' => 'test description kettle',
                'price' => 25.00,
                'stock' => 10
            ],
            [
                'name' => 'Hammer #3',
                'description' => 'Hammer description',
                'price' => 75.25,
                'stock' => 5
            ]
        ]);

        // Make sure test products are created from the product database (mysql_product connection)
        $this->assertEquals(3, Product::count());

        // Create test order
        $order = new Order;
        $order->email = config('mail.testing.email');
        $order->address = 'test address';
        $order->note = 'test note';
        $order->total_price = 275.50;
        $order->total_price_with_tax = 308.56;
        $order->item_total_count = 7;
        $order->product_count = 2;
        $order->save();

        // Create test order items

        // Test order item product #1
        $hammer = Product::query()->where('name', 'Hammer #3')->first();

        $item = new OrderItem;
        $item->order_id = $order->id;
        $item->product_id = $hammer->id;
        $item->product_name = $hammer->name;
        $item->product_description = $hammer->description;
        $item->product_price = $hammer->price;
        $item->quantity = 2;
        $item->save();

        // Test order item product #2
        $kettle = Product::query()->where('name', 'Kettle #1')->first();

        $item = new OrderItem;
        $item->order_id = $order->id;
        $item->product_id = $kettle->id;
        $item->product_name = $kettle->name;
        $item->product_description = $kettle->description;
        $item->product_price = $kettle->price;
        $item->quantity = 5;
        $item->save();

        // Validate order items, should have 2 records
        $this->assertEquals(2, OrderItem::count());
    }

    /**
     * A basic feature test example.
     */
    public function test_order_notification_email_api(): void
    {
        Mail::fake();

        $order = Order::first();
        $this->assertNotEmpty($order);

        $response = $this->postJson('/api/notifications/order', [
            'order_id' => $order->id
        ]);

        $response->assertOk();

        Mail::assertQueued(OrderEmail::class, function ($mail) use ($order) {
            return $mail->hasTo($order->email);
        });
    }
}
