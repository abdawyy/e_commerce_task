@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Admins</h1>

    <x-datatable :ajax-url="route('admin.data')" :columns="['id', 'name', 'email']" :renderComponents="$renderComponents"
        :customActionsView="$customActionsView" />
@endsection