<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_user_id',
        'total_amount',
        'status',
        'address',
    ];

    // Order belongs to a guest user
    public function guestUser()
    {
        return $this->belongsTo(GuestUser::class);
    }

    // Order has many order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
