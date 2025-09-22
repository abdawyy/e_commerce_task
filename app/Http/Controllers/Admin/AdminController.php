<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\DataTables\BaseDataTable;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;

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
        $service->setActionProps([
            'deleteRoute' => 'admin.destroy',
            'editRoute' => 'admin.edit',

        ]);
        return $service->make($request);
    }

    /**
     * Redirect to Breeze registration.
     */
    public function create()
    {
        return view('admin.create');
    }

    public function delete($id)
    {
        // Find the model dynamically based on route/model binding
        $modelClass = $this->model ?? null; // Make sure $model is defined in the controller
        if (!$modelClass) {
            return redirect()->back()->with('error', 'Model not defined.');
        }

        $item = $modelClass::find($id);

        if (!$item) {
            return redirect()->back()->with('error', 'Item not found.');
        }

        try {
            $item->delete();
            return redirect()->back()->with('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete item: ' . $e->getMessage());
        }
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        return redirect()->route('admin.index')
            ->with('success', 'Admin created successfully.');
    }
    // Show edit form
    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // Update admin
    public function update(Request $request, User $admin): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $admin->id],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // keep current password
        }

        $admin->update($data);

        return redirect()->route('admin.index')
            ->with('success', 'Admin updated successfully.');
    }



}
