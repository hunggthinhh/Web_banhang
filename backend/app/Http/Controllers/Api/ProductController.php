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
        $query = Product::with('category');
        
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        
        if ($request->has('featured')) {
            $query->where('is_featured', true)->take(10);
        }
        
        return response()->json($query->latest()->get());
    }

    public function show($idOrSlug)
    {
        $product = Product::with('category')
            ->where('id', $idOrSlug)
            ->orWhere('slug', $idOrSlug)
            ->firstOrFail();
        
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
            'price' => 'required|numeric',
        ]);

        $imagePath = $request->image ?? 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $p = public_path('uploads');
            if (!file_exists($p)) mkdir($p, 0777, true);
            $file->move($p, $filename);
            $imagePath = asset('uploads/' . $filename);
        }

        $subImages = [];
        for ($i = 0; $i < 4; $i++) {
            if ($request->hasFile("sub_image_$i")) {
                $file = $request->file("sub_image_$i");
                $filename = time() . "_sub_{$i}_" . $file->getClientOriginalName();
                $p = public_path('uploads');
                if (!file_exists($p)) mkdir($p, 0777, true);
                $file->move($p, $filename);
                $subImages[] = asset('uploads/' . $filename);
            }
        }

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $imagePath,
            'sub_images' => $subImages,
            'is_active' => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false)
        ]);

        return response()->json(['message' => 'Thêm thành công', 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $imagePath = $request->image ?? $product->image;
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $p = public_path('uploads');
            if (!file_exists($p)) mkdir($p, 0777, true);
            $file->move($p, $filename);
            $imagePath = asset('uploads/' . $filename);
        }

        $subImages = $product->sub_images ?? [];
        for ($i = 0; $i < 4; $i++) {
            if ($request->hasFile("sub_image_$i")) {
                $file = $request->file("sub_image_$i");
                $filename = time() . "_sub_{$i}_" . $file->getClientOriginalName();
                $p = public_path('uploads');
                if (!file_exists($p)) mkdir($p, 0777, true);
                $file->move($p, $filename);
                // Replace or add
                $subImages[$i] = asset('uploads/' . $filename);
            }
        }

        $product->update([
            'name' => $request->name ?? $product->name,
            'slug' => $request->name ? Str::slug($request->name) : $product->slug,
            'category_id' => $request->category_id ?? $product->category_id,
            'price' => $request->price ?? $product->price,
            'description' => $request->description ?? $product->description,
            'content' => $request->content ?? $product->content,
            'image' => $imagePath,
            'sub_images' => $subImages,
            'is_active' => $request->has('is_active') ? $request->boolean('is_active') : $product->is_active,
            'is_featured' => $request->has('is_featured') ? $request->boolean('is_featured') : $product->is_featured
        ]);

        return response()->json(['message' => 'Cập nhật thành công', 'product' => $product]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Xóa thành công']);
    }
}
