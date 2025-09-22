@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
<div class="container">
    <h1>Edit Category</h1>

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

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Use PUT for updating --}}

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" 
                   value="{{ old('name', $category->name) }}" required>
        </div>

        {{-- Is Active --}}
        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                   {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
