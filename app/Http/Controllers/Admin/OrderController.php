<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Services\DataTables\BaseDataTable;


class OrderController extends Controller
{
       /**
     * Show the index page for orders.
     */
    public function index()
    {
        $columns = ['id', 'guest_user.name', 'guest_user.email', 'total_amount', 'status', 'created_at'];
        $renderComponents = true; // Show action buttons
        $customActionsView = 'components.default-buttons-table'; // Blade view for actions (edit/delete/show)

        return view('admin.orders.index', compact('columns', 'renderComponents', 'customActionsView'));
    }

    /**
     * Return JSON data for DataTables.
     */
    public function data(Request $request)
    {
        $query = Order::query()->with('guestUser','items'); // eager load guest info if needed
        $columns = ['id', 'guest_user.name', 'guest_user.email', 'total_amount', 'status', 'created_at'];

        $service = new BaseDataTable($query, $columns, true, 'components.default-buttons-table');

        // Optional: add custom action properties
        $service->setActionProps([
            'showRoute' => 'orders.show',
        ]);

        return $service->make($request);
    }
    // Show single order
    public function show($id)
    {
        $order = Order::with('items', 'guestUser')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,completed,cancelled'
    ]);

    $order = Order::findOrFail($id);
    $order->status = $request->status;
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}


    // Optional: delete order
}
