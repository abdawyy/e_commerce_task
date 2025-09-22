@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="container my-5" id="printableArea">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h1>Order #{{ $order->id }}</h1>
        <button class="btn btn-primary no-print" onclick="printOrder()">🖨 Print</button>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Customer Information</strong>
        </div>
        <div class="card-body">
            <p><strong>Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
            <p><strong>Address:</strong> {{ $order->address }}</p>
            <p><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>

            {{-- Status Form --}}
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="no-print">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="status" class="form-label"><strong>Status:</strong></label>
                    <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <strong>Order Items</strong>
        </div>
        <div class="card-body">
            @if($order->items->count() > 0)
                <table class="table table-striped align-middle">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($order->items as $item)
                            @php
                                $subtotal = $item->price * $item->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->name }}" width="60">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="No Image" width="60">
                                    @endif
                                </td>
                                <td class="text-center">${{ number_format($item->price, 2) }}</td>
                                <td class="text-center">{{ $item->quantity }}</td>
                                <td class="text-end">${{ number_format($subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td class="text-end"><strong>${{ number_format($total, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            @else
                <p class="text-muted">No items found in this order.</p>
            @endif
        </div>
    </div>

    <div class="mt-3 no-print">
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">Back to Orders</a>
    </div>
</div>

@endsection

@section('styles')
<style>
     /* Only print the #printableArea content */
    @media print {
        body * {
            visibility: hidden; /* hide everything */
        }
        #printableArea, #printableArea * {
            visibility: visible; /* show only printable area */
        }
        #printableArea {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important; /* hide elements with no-print class */
        }
    }
</style>

@section('scripts')
<script>
function printOrder() {
    window.print();
}
</script>
