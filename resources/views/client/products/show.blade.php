@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container">
    <div class="row">
        {{-- Product Image --}}
        <div class="col-md-6">
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="img-fluid rounded shadow">
        </div>

        {{-- Product Details --}}
        <div class="col-md-6">
            <h2>{{ $product->name }}</h2>
            <h4 class="text-success">${{ number_format($product->price, 2) }}</h4>

            <p><strong>Status:</strong>
                @if($product->is_active && $product->quantity > 0)
                    <span class="badge bg-success">In Stock</span>
                @elseif(!$product->is_active)
                    <span class="badge bg-danger">Inactive</span>
                @else
                    <span class="badge bg-warning text-dark">Out of Stock</span>
                @endif
            </p>

            {{-- Add to Cart --}}
            @if($product->quantity > 0 && $product->is_active)
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-lg" disabled>
                    <i class="bi bi-x-circle"></i> Not Available
                </button>
            @endif

            {{-- Back to Products --}}
            <div class="mt-3">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Products</a>
            </div>
        </div>
    </div>
</div>
@endsection
