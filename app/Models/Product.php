<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'price', 'image', 'is_active'];

    /**
     * -------------------------------
     * Scopes
     * -------------------------------
     */

    // Only active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Search by name
    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            $query->where('name', 'like', "%{$search}%");
        }
        return $query;
    }

    // Sort by price
    public function scopeSort($query, $sort)
    {
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }
        return $query;
    }

    // Filter by price ranges
    public function scopeFilterPrice($query, $filter)
    {
        if ($filter === 'under50') {
            $query->where('price', '<', 50);
        } elseif ($filter === '50to100') {
            $query->whereBetween('price', [50, 100]);
        } elseif ($filter === 'above100') {
            $query->where('price', '>', 100);
        }
        return $query;
    }

    /**
     * -------------------------------
     * Helper Methods
     * -------------------------------
     */

    // Deactivate product
    public function deactivate()
    {
        $this->update(['is_active' => false]);
    }

    // Activate product
    public function activate()
    {
        $this->update(['is_active' => true]);
    }
}
