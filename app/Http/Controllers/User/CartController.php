<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        //Tìm sản phẩm trong giỏ hàng
        $cartItem = Cart::where('user_id',auth()->id())
                        ->where('product_id',$product->id)
                        ->first();
        if($cartItem){
            //nếu có sản phẩm trong giỏ hàng, chỉ tăng số lượng
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        }    else{
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->image,
                'product_price' => $product->salePrice,
                'quantity' => $request->quantity,
            ]);
        }
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    //Xem giỏ hàng
    public function index(){
        $cartItems = Cart::with('product')->where('user_id',Auth::id())->get();
        return view('users.cart',compact('cartItems'));
    }
    public function remove($id){
        Cart::where('id',$id)->where('user_id',Auth::id())->delete();
        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
    public function update(Request $request, $id) {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cập nhật số lượng thành công!');
    }
//    public function boot(){
//        View::composer('*', function ($view) {
//            $cartCount = 0;
//           if(Auth::check()){
//               $cartCount = Cart::where('user_id', Auth::id())->count();
//           }
//           $view->with('cartCount', $cartCount);
//        });
//    }
}
