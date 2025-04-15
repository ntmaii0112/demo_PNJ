<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::info('Hiển thị trang quản lý category');
        $Category = Category::active()->orderBy('id','desc')->paginate(10);
        return view('admin.category.index',compact('Category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Log::info("Hiển thị trang create category");
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category = Category::create($validatedData);

        Log::info('Category created successfully');
        return redirect()->route('category.index')->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        Log::info('Hiển thị chi tiết sản phẩm');
        return view('admin.category.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Log::info('Hiển thị form edit category');
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $category->update($request->all());
        Log::info('Category updated successfully');
        return redirect()->route('category.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category->softDelete()){
            return redirect()->route('category.index')->with('success','Category has been deleted');
        }
        return redirect()->route('category.index')->with('error','Category has been deleted');
    }

}
