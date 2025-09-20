<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->search($request->search)
            ->sort($request->sort)
            ->filterPrice($request->filter)
            ->paginate(8);

        return view('home', compact('products'));
    }
    public function show($id)
{
    $product = Product::findOrFail($id);
    return view('client.products.show', compact('product'));
}

}
