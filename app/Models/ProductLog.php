<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    protected $fillable = [
        'product_id',
        'action',
        'changed_by',
        'changes',
        'name',
        'image',
        'price',
        'sale'
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
