<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cart;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function createOrder(Request $request){

        $user = auth()->user();

        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();

        if($cartItems->isEmpty()){
            return redirect()->back()->with('error','No items in your cart');
        }
        $total = 0;

        //Tạo đơn hàng
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'ordered',
        ]);

        //Di chuyển sp từ giỏ hàng sang chi tiết đơn hàng
        foreach ($cartItems as $item) {
            $product = $item->product;

            // Debug
            if (!$product) {
                dd("Không tìm thấy product cho cartItem", $item);
            }

            if (is_null($product->salePrice)) {
                dd("Giá sản phẩm bị null", $product);
            }

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $product->salePrice,
            ]);
            $total += $product->salePrice * $item->quantity;
        }
        $order->total = $total;
        $order->save();

        Cart::where('user_id',$user->id)->delete();
        return redirect()->route('orders.show', $order->id)->with('success','Order created successfully');
    }
    public function show()
    {
        $orders = Order::with('user')->where('user_id',Auth::id())->get();
        return view('users.orders.show', compact('orders'));
    }

    public function index(){
        $orders = Order::with('user')->get();

        return view('admin.orders.index',compact('orders'));
    }
    public function updateStatus(Request $request,$id){
        //Lâấy đơn hàng từ DB
        $order = Order::findOrFail($id);

        //Kiểm tra xam trạng tháu gửi lên có hợp lệ hay ko
        $validated = $request->validate([
            'status' => 'required|in:ordered,delivering,completed,cancelled',
        ]);
        $order->status = $request->input('status');
        $order->save();

        return back()->with('success','Order status updated successfully');
    }
}
