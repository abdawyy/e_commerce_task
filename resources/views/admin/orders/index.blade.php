@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Orders</h1>

    {{-- Success message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Error message --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <x-datatable :ajax-url="route('orders.data')" :columns="        $columns = ['id', 'guest_user.name', 'guest_user.email', 'total_amount', 'status', 'created_at']"
        :renderComponents="$renderComponents" :customActionsView="$customActionsView" />
@endsection