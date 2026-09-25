<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'status',
    ];

    // Product kis farmer/user ka hai
    public function farmer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Product kis category mein hai
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

