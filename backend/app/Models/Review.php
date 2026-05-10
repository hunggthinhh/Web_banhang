<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'product_id',
        'order_item_id',
        'user_id',
        'guest_name',
        'rating',
        'comment',
        'images',
        'videos'
    ];

    protected $casts = [
        'images' => 'array',
        'videos' => 'array',
        'rating' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
