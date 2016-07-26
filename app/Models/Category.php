<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Suggest;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function suggests()
    {
        return $this->hasMany(Suggest::class);
    }
}
