@extends('layouts.client')

@section('title', 'Checkout')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Checkout</h1>

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
