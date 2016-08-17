<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Suggest;
use App\Models\Category;

class Category extends Model
{
    protected $fillable = [
        'name', 'parent_id', 'link',
    ];

    public function suggests()
    {
        return $this->hasMany(Suggest::class);
    }
}
