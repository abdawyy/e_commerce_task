<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GuestUser;
use Illuminate\Http\Request;
use App\Services\DataTables\BaseDataTable;

class GuestUserController extends Controller
{
    /**
     * Display the list of guest users.
     */
    public function index()
    {
        $columns = ['id', 'name', 'email', 'phone'];
        $renderComponents = true; // Show action buttons
        $customActionsView = 'components.default-buttons-table';

        return view('admin.guest_users.index', compact('columns', 'renderComponents', 'customActionsView'));
    }

    /**
     * Return JSON data for DataTables.
     */
    public function data(Request $request)
    {
        $query = GuestUser::query(); // Use GuestUser model
        $columns = ['id', 'name', 'email', 'phone'];

        $service = new BaseDataTable($query, $columns, true, 'components.default-buttons-table');
        $service->setActionProps([
 
        ]);

        return $service->make($request);
    }



  
 
}
