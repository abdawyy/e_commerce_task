<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\GuestUser;


class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('client.checkout', compact('cart'));
    }


    public function placeOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // 1. Find existing guest by email or create new
        $guest = GuestUser::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'phone' => $request->phone,
            ]
        );

        // 2. Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 3. Create Order with guest_id
        $order = Order::create([
            'guest_user_id' => $guest->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_amount' => $total,
            'status'=>'pending'
        ]);

        // 4. Create Order Items and reduce stock
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity'],
                'subtotal' => $product->price * $item['quantity'],
            ]);

            $product->decrement('quantity', $item['quantity']);
        }

        // 5. Clear Cart
        Session::forget('cart');

        // 6. Redirect home with success
        return redirect('/')->with('success', 'Order placed successfully!');
    }

    public function success()
    {
        $orderId = session('order_id');
        $order = Order::with('items')->find($orderId);

        if (!$order) {
            return redirect('/')->with('error', 'Order not found.');
        }

        return view('client.home', compact('order'));
    }
}
