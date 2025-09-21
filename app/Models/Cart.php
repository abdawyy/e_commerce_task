<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_user_id',
        'product_id',
        'quantity',
    ];

    // Cart belongs to a guest user
    public function guestUser()
    {
        return $this->belongsTo(GuestUser::class);
    }

    // Cart belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
