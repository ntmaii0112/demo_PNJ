<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Log::info("Product index");
        $search = $request->input('search');
        $products = Product::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate(10);
        return view('admin.product.index', compact('products','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('del_flag', 0)->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = $filename;
        }else{
            $data['image'] = '';
        }

        // $product = Product::create([
        //     'name' => $request -> input('name'),
        //     'originalPrice' => $request -> input('originalPrice'),
        //     'salePrice' => $request -> input('salePrice'),
        //     'image' => $filename,
        //     'category_id' => $request -> input('category_id'),
        //     'quantity' => $request -> input('quantity'),
        //     'del_flag' => false,
        // ]);

        $product = Product::create($data);

        Log::info("Product create success");
        return redirect()->route('product.index')->with('success','Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        Log::info("Product edit");
        $categories = Category::where('del_flag', 0)->get();
        return view('admin.product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $data['image'] = $filename;
        }
        $product->update($data);
        Log::info("Product update success");
        return redirect()->route('product.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product->softDelete()){
            return redirect()->route('product.index')->with('success','Product deleted successfully');
        }
        return redirect()->route('product.index')->with('error','Product has been deleted');
    }
}

