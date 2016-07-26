<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Order;

class LineItem extends Model
{
    protected $fillable = [
        'product_id', 'order_id', 'quantity_product', 'price',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
