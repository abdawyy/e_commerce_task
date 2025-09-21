@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>

    {{-- Cart Items --}}
    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Your Cart</strong>
        </div>
        <div class="card-body">
            @if(session('cart') && count(session('cart')) > 0)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $item)
                            @php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="text-center">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" width="60">
                                </td>
                                <td class="text-center">${{ number_format($item['price'], 2) }}</td>
                                <td class="text-center">{{ $item['quantity'] }}</td>
                                <td class="text-end">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td class="text-end"><strong>${{ number_format($total, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p class="text-muted">Your cart is empty.</p>
            @endif
        </div>
    </div>

    {{-- Customer Info --}}
    <div class="card">
        <div class="card-header bg-light">
            <strong>Customer Information</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('checkout.placeOrder') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Shipping Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                </div>

                {{-- Place Order Button --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-check-circle"></i> Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
