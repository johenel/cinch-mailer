<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mysql_checkout';

    protected $with = ['items'];

    protected $fillable = [
        'emial',
        'address',
        'note',
        'total_price',
        'total_price_with_tax',
        'item_total_count',
        'product_count'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
