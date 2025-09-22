@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Product Logs</h1>

    <x-datatable :ajax-url="route('product-logs.data')" :columns="['id', 'product.name', 'user.name', 'action', 'created_at']" :renderComponents="$renderComponents"
        :customActionsView="$customActionsView" />
@endsection