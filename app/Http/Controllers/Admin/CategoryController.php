<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\DataTables\BaseDataTable;


class CategoryController extends Controller
{
    // List categories
    public function index()
    {
        $columns =['id', 'name']; // Columns to display
        $renderComponents = true; // show action buttons
        $customActionsView = 'components.default-buttons-table'; // Blade component for buttons

        return view('admin.categories.index', compact('columns', 'renderComponents', 'customActionsView'));
    }

    /**
     * Return JSON data for DataTables.
     */
    public function data(Request $request)
    {
        $query = Category::query();
        $columns = ['id', 'name'];

        $service = new BaseDataTable($query, $columns, true, 'components.default-buttons-table');
        $service->setActionProps([
            'editRoute' => 'categories.edit',
            'deleteRoute' => 'categories.destroy',
        ]);

        return $service->make($request);
    }
    // Show create form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Category::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // Show edit form
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $category->update($data);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
