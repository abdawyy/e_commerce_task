@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1 class="mb-4">Our Products</h1>

    {{-- Search and Filter --}}
    <form method="GET" action="{{ url('/') }}" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                   placeholder="Search products...">
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="">Sort by</option>
                <option value="price_asc" {{ request('sort')=='price_asc'?'selected':'' }}>Price: Low to High</option>
                <option value="price_desc" {{ request('sort')=='price_desc'?'selected':'' }}>Price: High to Low</option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="filter" class="form-select">
                <option value="">Filter by</option>
                <option value="under50" {{ request('filter')=='under50'?'selected':'' }}>Under $50</option>
                <option value="50to100" {{ request('filter')=='50to100'?'selected':'' }}>$50 - $100</option>
                <option value="above100" {{ request('filter')=='above100'?'selected':'' }}>Above $100</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Apply</button>
        </div>
    </form>

    {{-- Product Carousel --}}
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($products->chunk(4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row g-4">
                        @foreach ($chunk as $product)
                            <div class="col-md-3">
                                <div class="card h-100">
                                    <a href="{{ route('products.show', $product->id) }}">
                                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                                    </a>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">
                                            <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                                                {{ $product->name }}
                                            </a>
                                        </h5>
                                        <p class="card-text">${{ number_format($product->price, 2) }}</p>

                                        {{-- Stock Check --}}
                                        @if($product->quantity > 0)
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-auto">
                                                @csrf
                                                <button type="submit" class="btn btn-success w-100">Add to Cart</button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary w-100 mt-auto" disabled>Out of Stock</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

        </div>

        {{-- Carousel Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
