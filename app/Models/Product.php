<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\LineItem;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'price', 
        'status', 
        'image', 
        'quantity', 
        'rating', 
        'category_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function lineItem()
    {
        return $this->hasOne(LineItem::class);
    }
}
