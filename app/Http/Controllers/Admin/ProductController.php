<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|unique:products,sku',
            'name' => 'required|string',
            'category' => 'required|string',
            'unit' => 'required|string',
            'selling_price' => 'required|numeric|min:0',
            'safety_stock' => 'nullable|integer|min:0',
        ]);

            $product = Product::create($validated);

            return redirect()
                ->route('admin.products.show', $product->id)
                ->with('success', 'Product created successfully!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'sku' => 'required|unique:products,sku,' . $id,
            'name' => 'required|string',
            'category' => 'required|string',
            'unit' => 'required|string',
            'selling_price' => 'required|numeric|min:0',
            'safety_stock' => 'nullable|integer|min:0',
        ]);

            $product->update($validated);

            return redirect()
                ->route('admin.products.show', $product->id)
                ->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
            $product = Product::findOrFail($id);

            if ($product->current_stock > 0) {
                return redirect()
                    ->route('admin.products.index')
                    ->with('error', 'Cannot delete product with existing stocks and sales. Please reduce stock to zero before deletion.');
            }

            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product deleted successfully!');
    }

    public function showStock($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'name' => $product->name,
            'current_stock' => $product->current_stock,
            'safety_stock' => $product->safety_stock,
        ]);
    }
}
