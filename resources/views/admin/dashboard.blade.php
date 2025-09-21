@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row">
        <!-- Orders -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text fs-3">{{ $stats['total_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Orders -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Completed Orders</h5>
                    <p class="card-text fs-3">{{ $stats['completed_orders'] }}</p>
                </div>
            </div>
        </div>

        <!-- Products -->
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Products</h5>
                    <p class="card-text fs-3">{{ $stats['total_products'] }}</p>
                </div>
            </div>
        </div>

        <!-- Admins -->
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Admins</h5>
                    <p class="card-text fs-3">{{ $stats['total_admins'] }}</p>
                </div>
            </div>
        </div>

        <!-- Guest Users -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Guest Users</h5>
                    <p class="card-text fs-3">{{ $stats['guest_users'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
