<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        // Sort
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        // Filter
        if ($request->filter == 'under50') {
            $query->where('price', '<', 50);
        } elseif ($request->filter == '50to100') {
            $query->whereBetween('price', [50, 100]);
        } elseif ($request->filter == 'above100') {
            $query->where('price', '>', 100);
        }

        $products = $query->paginate(8);

        return view('home', compact('products'));
    }
}
