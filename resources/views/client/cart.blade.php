@extends('layouts.client')

@section('title', 'My Cart')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">My Cart</h1>

    <div class="card">
        <div class="card-header bg-light">
            <strong>Your Cart</strong>
        </div>
        <div class="card-body">
            @if(session('cart') && count(session('cart')) > 0)
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Sale</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Subtotal</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $item)
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
                                <td class="text-center">
                                    @if(!empty($item['sale']))
                                        <span class="badge bg-success">{{ $item['sale'] }}% Off</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item['quantity'] }}</td>
                                <td class="text-end">${{ number_format($subtotal, 2) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $item['key']) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6" class="text-end"><strong>Total:</strong></td>
                            <td class="text-end"><strong>${{ number_format($total, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>

                {{-- Checkout button --}}
                <div class="text-end mt-3">
                    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                        <i class="bi bi-bag-check"></i> Proceed to Checkout
                    </a>
                </div>
            @else
                <p class="text-muted">Your cart is empty.</p>
            @endif
        </div>
    </div>
</div>
@endsection
