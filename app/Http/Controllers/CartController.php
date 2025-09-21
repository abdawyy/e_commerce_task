<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
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
            $productItem = $this->getProduct($request);
            $availableStock = $productItem->quantity;
            $requestedQuantity = $request->quantity;


            return $this->handleGuestCart($request, $productItem, $availableStock, $requestedQuantity);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while adding the product to the cart.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    private function validateCartRequest(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    }
    private function handleGuestCart($request, $productItem, $availableStock, $requestedQuantity)
    {
        $cart = session()->get('cart', []);
        $baseKey = $request->product_id . '_' . $request->size_id;

        // If the key exists already, use it. If not, generate a unique one
        $existingKey = collect($cart)->search(function ($item) use ($request) {
            return $item['product_id'] == $request->product_id && $item['size_id'] == $request->size_id;
        });

        $key = is_string($existingKey) ? $existingKey : $baseKey;

        $existingQuantity = isset($cart[$key]) ? $cart[$key]['quantity'] : 0;
        $newTotalQuantity = $existingQuantity + $requestedQuantity;

        if ($newTotalQuantity > $availableStock) {
            return $this->stockLimitResponse($productItem, $availableStock);
        }

        $cart[$key] = [
            'product_id' => $request->product_id,
            'quantity' => $newTotalQuantity,
            'name' => optional($productItem->products)->name,
            'price' => $productItem->products->price,
            'sale' => $productItem->products->sale,
            'key' => $key // store key
        ];

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully.',
            'cartCount' => count($cart)
        ]);
    }
    private function stockLimitResponse($productItem, $availableStock)
    {
        $productName = optional($productItem->product)->name ?? 'Product';

        return response()->json([
            'success' => false,
            'message' => "Cannot add more than available stock for: {$productName}. Only {$availableStock} left.",
        ], 400);
    }


    public function deleteGuest($key)
    {
        $guestCart = Session::get('cart', []);

        if (isset($guestCart[$key])) {
            unset($guestCart[$key]);
            Session::put('cart', $guestCart);

            return redirect()->back()->with('success', 'Item removed from cart.');
        }


        return redirect()->back()->with('error', 'Item not found in cart.');

    }

}