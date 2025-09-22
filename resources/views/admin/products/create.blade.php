@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
<div class="container">
    <h1>Add Product</h1>

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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        {{-- Price --}}
        <div class="mb-3">
            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
        </div>

        {{-- Quantity --}}
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="0" value="{{ old('quantity', 0) }}" required>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        {{-- Sale --}}
        <div class="mb-3">
            <label for="sale" class="form-label">Sale (%)</label>
            <input type="number" name="sale" id="sale" class="form-control" min="0" max="100" value="{{ old('sale', 0) }}">
        </div>

        {{-- Category --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select Category</option>
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" {{ old('category_id', $product->category_id ?? '') == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Is Active --}}
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
