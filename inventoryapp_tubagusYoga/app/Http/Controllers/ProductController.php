<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use File;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
        public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('admin', except: ['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::get();

        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::get();
        return view('product.create', ['categories' => $categories]);   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
        ]);
        $imageName = time() . '_' . $request->image->extension();
        $request->image->move(public_path('image'), $imageName);

        $products = new Products();
        $products->name = $request->input('name');
        $products->image = $imageName;
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->stock = $request->input('stock');
        $products->category_id = $request->input('category_id');
        $products->save();
        return redirect('/product')->with('success', 'Product berhasil ditambahkan');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $products = Products::find($id);
        return view('product.detail', ['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Products::find($id);
        $categories = Categories::get();
        return view('product.edit', ['products' => $products, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required',
        ]);

        $products = Products::find($id);
        
        if ($request->hasFile('image')) {
            if($products->image) {
                if(File::exists(public_path('image/' . $products->image))) {
                File::delete(public_path('image/' . $products->image));
                }
                $imageName = time() . '_' . $request->image->extension();
                $request->image->move(public_path('image'), $imageName);
                $products->image = $imageName;
            }
        }
        $products->name = $request->input('name');
        $products->description = $request->input('description');
        $products->price = $request->input('price');
        $products->stock = $request->input('stock');
        $products->category_id = $request->input('category_id');
        $products->save();
        return redirect('/product')->with('success', 'Product berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $products = Products::find($id);
        if($products->image) {
            if(File::exists(public_path('image/' . $products->image))) {
                File::delete(public_path('image/' . $products->image));
            }
        }
        $products->delete();
        return redirect('/product')->with('success', 'Product berhasil dihapus');
    }
}
