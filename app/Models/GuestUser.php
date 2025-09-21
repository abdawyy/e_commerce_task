<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
    ];

    // A guest user can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // A guest user can have many cart items
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
