<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductLog;
use Illuminate\Http\Request;
use App\Services\DataTables\BaseDataTable;

class ProductLogController extends Controller
{
    /**
     * Display the product logs page.
     */
    public function index()
    {
        $columns = ['id', 'product.name', 'user.name', 'action', 'created_at'];
        $renderComponents = true;
        $customActionsView = 'components.default-buttons-table'; // Blade component for action buttons

        return view('admin.product_logs.index', compact('columns', 'renderComponents', 'customActionsView'));
    }

    /**
     * Return JSON data for DataTables.
     */
    public function data(Request $request)
    {
        $query = ProductLog::with(['product', 'user'])->latest();
        $columns = ['id', 'product.name', 'user.name', 'action', 'created_at'];

        $service = new BaseDataTable($query, $columns, true, 'components.default-buttons-table');
        $service->setActionProps([
        ]);

        return $service->make($request);
    }
}
