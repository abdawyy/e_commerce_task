<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Services\DataTables\BaseDataTable;



class ProductController extends Controller
{
    public function index()
    {
        $columns = ['id', 'name', 'category.name', 'price', 'sale', 'quantity']; // Columns to display
        $renderComponents = true; // show action buttons
        $customActionsView = 'components.default-buttons-table'; // Blade component for buttons


        return view('admin.products.index', compact('columns', 'renderComponents', 'customActionsView'));
    }

    /**
     * Return JSON data for DataTables.
     */
    public function data(Request $request)
    {
        $query = Product::with('category'); // Eager load category
        $columns = ['id', 'name', 'category.name', 'price', 'sale', 'quantity']; // Columns to display

        $service = new BaseDataTable($query, $columns, true, 'components.default-buttons-table');
        $service->setActionProps([
            'editRoute' => 'products.edit',
            'deleteRoute' => 'products.destroy',
            'deactivateRoute' => 'products.toggleStatus',

        ]);

        return $service->make($request);
    }

    public function create()
    {
        // Only active categories
        $categories = Category::where('is_active', true)->pluck('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0', // added quantity
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // In store()
        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'created',
            'changed_by' => Auth::id(),
            'changes' => $product->toArray(),
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'sale' => $product->sale
        ]);


        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::where('is_active', true)->pluck('name', 'id');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0', // added quantity
            'category_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $original = $product->getOriginal();
        $product->update($data);

        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'updated',
            'changed_by' => Auth::id(),
            'changes' => array_diff_assoc($product->toArray(), $original),
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'sale' => $product->sale

        ]);
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'deleted',
            'changed_by' => Auth::id(),
            'changes' => $product->toArray(),
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'sale' => $product->sale

        ]);
        $product->delete();



        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
    public function toggleStatus(Product $product)
    {
        // Toggle the is_active status
        $product->is_active = !$product->is_active;
        $product->save();

        // Log the action
        ProductLog::create([
            'product_id' => $product->id,
            'action' => $product->is_active ? 'activated' : 'deactivated',
            'changed_by' => Auth::id(),
            'changes' => $product->toArray(),
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'sale' => $product->sale
        ]);

        $status = $product->is_active ? 'activated' : 'deactivated';
        return redirect()->route('products.index')->with('success', "Product {$status} successfully.");
    }
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        $product->restore();

        // Log the restore action
        ProductLog::create([
            'product_id' => $product->id,
            'action' => 'restored',
            'changed_by' => Auth::id(),
            'changes' => $product->toArray(),
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'sale' => $product->sale
        ]);

        return redirect()->route('products.index')->with('success', 'Product restored successfully.');
    }
    // ProductController.php
    public function deleteImage(Product $product)
    {
        if ($product->image && \Storage::disk('public')->exists($product->image)) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->image = null;
        $product->save();

        return redirect()->back()->with('success', 'Product image deleted successfully.');
    }


}
