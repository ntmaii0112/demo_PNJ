<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductPublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('del_flag', 0)->get();
        $categoryId = $request->input('category_id');
        $search = $request->input('search');

        $products = Product::where('del_flag', 0)
            ->when($categoryId, fn($query) => $query->where('category_id', $categoryId))
            ->when($search, fn($query) => $query->where('name', 'like', '%' . $search . '%'))
            ->paginate(12);

        return view('users.homepage', compact('categories', 'products', 'categoryId', 'search'));
    }
    public function show(Product $product){
        return view('users.showProduct', compact('product'));
    }


}
