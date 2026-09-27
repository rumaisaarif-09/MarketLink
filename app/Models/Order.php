<?php

namespace App\Models;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'grand_total',
        'total_price',
        'address',
        'shipping_address',
        'pickup_date',
        'pickup_time',
        'phone',
        'payment_method',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function canBeCancelled(): bool
    {
        return ! in_array($this->status, ['completed', 'cancelled'], true);
    }
}
