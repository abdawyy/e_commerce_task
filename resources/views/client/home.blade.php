@extends('layouts.client')

@section('title', 'Home')

@section('content')
<style>

</style>

<h1 class="mb-4">Our Products</h1>
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


{{-- Search and Filter --}}
<form method="GET" action="{{ url('/') }}" class="row mb-4">
    <div class="col-12 col-sm-6 col-md-4 mb-2 mb-md-0">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Search products...">
    </div>

    <div class="col-6 col-sm-3 col-md-3 mb-2 mb-md-0">
        <select name="sort" class="form-select">
            <option value="">Sort by</option>
            <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Price: Low to High</option>
            <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price: High to Low</option>
        </select>
    </div>

    <div class="col-6 col-sm-3 col-md-3 mb-2 mb-md-0">
        <select name="filter" class="form-select">
            <option value="">Filter by</option>
            <option value="under50" {{ request('filter')=='under50'?'selected':'' }}>Under $50</option>
            <option value="50to100" {{ request('filter')=='50to100'?'selected':'' }}>$50 - $100</option>
            <option value="above100" {{ request('filter')=='above100'?'selected':'' }}>Above $100</option>
        </select>
    </div>

    <div class="col-12 col-sm-12 col-md-2">
        <button type="submit" class="btn btn-primary w-100">Apply</button>
    </div>
</form>

{{-- Products --}}
@if ($products->count() > 0)
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-3">
                <div class="card h-100">
                    <a href="{{ route('products.show', $product->id) }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-img" alt="{{ $product->name }}">
                        @else
                            <img src="{{ asset('images/no-image.png') }}" class="card-img-top product-img" alt="No Image">
                        @endif
                    </a>

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <p class="card-text">${{ number_format($product->price, 2) }}</p>

                        @if($product->quantity > 0)
                            <div class="mt-auto">
                                <input type="number" id="qty-{{ $product->id }}" value="1" min="1" class="form-control mb-2">
                                <button type="button" class="btn btn-success w-100"
                                        onclick="addToCart({{ $product->id }}, document.getElementById('qty-{{ $product->id }}'))">
                                    Add to Cart
                                </button>
                            </div>
                        @else
                            <button class="btn btn-secondary w-100 mt-auto" disabled>Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@else
    <div class="alert alert-warning text-center">
        🚫 No products found.
    </div>
@endif

@endsection
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
function addToCart(productId, qtyInput) {
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: qtyInput.value
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
let cartBadge = document.querySelector('.navbar .badge');
            if (cartBadge) {
                cartBadge.textContent = data.cartCount > 9 ? '9+' : data.cartCount;
            }

            Toastify({
                text: data.message,
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "green",
                stopOnFocus: true
            }).showToast();
        } else {
            Toastify({
                text: data.message || 'Failed to add to cart',
                duration: 3000,
                gravity: "top",
                position: 'right',
                backgroundColor: "red",
                stopOnFocus: true
            }).showToast();
        }
    })
    .catch(error => console.error(error));
}
</script>
