<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id', 'alias', 'receiver_name', 'receiver_phone', 'receiver_email', 
        'province', 'district', 'ward', 
        'province_code', 'district_code', 'ward_code', 
        'detail_address', 'is_default'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
