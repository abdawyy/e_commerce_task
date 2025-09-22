@extends('layouts.client')

@section('title', $product->name)

@section('content')
    <div class="container my-4">
        <div class="row">
            {{-- Product Image --}}
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                        class="img-fluid rounded shadow" style="width:100%; height:400px; object-fit:cover;">
                @else
                    <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="img-fluid rounded shadow"
                        style="width:100%; height:400px; object-fit:cover;">
                @endif
            </div>

            {{-- Product Details --}}
            <div class="col-12 col-md-6">
                <h2>{{ $product->name }}</h2>
                <h4 class="text-success">${{ number_format($product->price, 2) }}</h4>
                @if($product->sale)
                    <p class="text-danger">Sale: {{ $product->sale }}%</p>
                @endif

                <p><strong>Status:</strong>
                    @if($product->is_active && $product->quantity > 0)
                        <span class="badge bg-success">In Stock</span>
                    @elseif(!$product->is_active)
                        <span class="badge bg-danger">Inactive</span>
                    @else
                        <span class="badge bg-warning text-dark">Out of Stock</span>
                    @endif
                </p>

                {{-- Quantity and Add to Cart --}}
                @if($product->quantity > 0 && $product->is_active)
                    <div class="mb-3">
                        <input type="number" id="qty-{{ $product->id }}" value="1" min="1" class="form-control w-25 mb-2">
                        <button type="button" class="btn btn-primary"
                            onclick="addToCart({{ $product->id }}, document.getElementById('qty-{{ $product->id }}'))">
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                    </div>
                @else
                    <button class="btn btn-secondary" disabled>
                        <i class="bi bi-x-circle"></i> Not Available
                    </button>
                @endif

                {{-- Description --}}
                <div class="mt-3">
                    <h5>Description</h5>
                    <p>{{ $product->description ?? 'No description available.' }}</p>
                </div>

                {{-- Back to Products --}}
                <div class="mt-3">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Products</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Toastify & Add to Cart JS --}}
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
                        if (cartBadge) cartBadge.textContent = data.cartCount > 9 ? '9+' : data.cartCount;

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
@endsection