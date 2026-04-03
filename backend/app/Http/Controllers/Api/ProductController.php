<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('is_active', true);
        if ($request->has('featured')) {
            $query->take(4);
        }
        return response()->json($query->latest()->get());
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();
            
        return response()->json([
            'product' => $product,
            'related' => $relatedProducts
        ]);
    }

    // --- Admin Routes ---
    public function adminIndex()
    {
        $products = Product::with('category')->latest()->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $request->image ?? 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80',
            'is_active' => $request->boolean('is_active', true)
        ]);

        return response()->json(['message' => 'Thêm thành công', 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->update([
            'name' => $request->name ?? $product->name,
            'slug' => $request->name ? Str::slug($request->name) : $product->slug,
            'category_id' => $request->category_id ?? $product->category_id,
            'price' => $request->price ?? $product->price,
            'description' => $request->description ?? $product->description,
            'image' => $request->image ?? $product->image,
            'is_active' => $request->has('is_active') ? $request->boolean('is_active') : $product->is_active
        ]);

        return response()->json(['message' => 'Cập nhật thành công', 'product' => $product]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}
