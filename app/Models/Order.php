<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    const UNPAID = 0;
    const PAID = 1;
    const CANCEL = 2; 

    protected $fillable = [
        'user_id', 'price', 'status', 'shipping_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lineItems()
    {
    	return $this->hasMany(LineItem::class);
    }

    public function isUnpaid()
    {
        return $this->status == Order::UNPAID;
    }

    public function isPaid()
    {
        return $this->status == Order::PAID;
    }

    public function isCancel()
    {
        return $this->status == Order::CANCEL;
    }
}
