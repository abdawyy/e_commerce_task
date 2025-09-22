@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="container">
    <h1>Edit Product</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

          {{-- Quantity --}}
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="0" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        {{-- Sale --}}
        <div class="mb-3">
            <label for="sale" class="form-label">Sale (%)</label>
            <input type="number" name="sale" id="sale" class="form-control" min="0" max="100" value="{{ old('sale', $product->sale) }}">
        </div>


        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            @if($product->image)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="max-width: 150px; height:auto;">
                    <a href="{{ route('products.deleteImage', $product->id) }}" class="btn btn-sm btn-danger ms-2"
                       onclick="return confirm('Are you sure you want to delete this image?')">Delete Image</a>
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        {{-- Is Active --}}
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
