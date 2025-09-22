<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        return view('client.cart');
    }

    public function add(Request $request)
    {
        $this->validateCartRequest($request);

        try {
            $product = $this->getProduct($request);

            $availableStock = $product->quantity;
            $requestedQuantity = $request->quantity;

            return $this->handleGuestCart($product, $availableStock, $requestedQuantity);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the product to the cart.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getProduct(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            abort(response()->json([
                'success' => false,
                'message' => 'Product not found.'
            ], 404));
        }

        return $product;
    }

    private function validateCartRequest(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    }

    private function handleGuestCart($product, $availableStock, $requestedQuantity)
    {
        $cart = session()->get('cart', []);
        $key = $product->id; // key based only on product_id

        $existingQuantity = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;
        $newTotalQuantity = $existingQuantity + $requestedQuantity;

        if ($newTotalQuantity > $availableStock) {
            return response()->json([
                'success' => false,
                'message' => "Cannot add more than available stock for: {$product->name}. Only {$availableStock} left.",
            ], 400);
        }

        $cart[$key] = [
            'product_id' => $product->id,
            'quantity' => $newTotalQuantity,
            'name' => $product->name,
            'price' => $product->price,
            'sale' => $product->sale ?? null, // optional
            'image'=>$product->image,
            'key'=>$key
        ];

        session()->put('cart', $cart);



        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cartCount' => count($cart)
        ]);
    }

    public function deleteGuest($key)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$key])) {
            unset($cart[$key]);
            Session::put('cart', $cart);

            return redirect()->back()->with('success', 'Item removed from cart.');
        }

        return redirect()->back()->with('error', 'Item not found in cart.');
    }
}
