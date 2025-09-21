<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\DataTables\BaseDataTable;

class AdminController extends Controller
{
    /**
     * Show the Admin index page.
     */
  public function index()
    {
        $columns = ['id', 'name', 'email'];
        $renderComponents = true; // or false based on your condition
        $customActionsView = 'components.default-buttons-table'; // full view path

        return view('admin.index', compact('columns', 'renderComponents', 'customActionsView'));
    }

    /**
     * Return JSON data for DataTables.
     */
    public function data(Request $request)
    {
        $query = User::query();
        $columns = ['id', 'name', 'email'];

        $service = new BaseDataTable($query, $columns, true, 'components.default-buttons-table');
        return $service->make($request);
    }

    /**
     * Redirect to Breeze registration.
     */
    public function create()
    {
        return redirect()->route('register');
    }
}
