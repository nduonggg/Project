<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;


class CheckOutController extends Controller
{
    public function index(){
        $carts = Cart::content();
        $total = Cart::total();
        $subtotal = Cart::subtotal();

        return view('front.checkout.index', compact('carts', 'total', 'subtotal'));
    }

    public function addOrder(Request $request){
        // Them don hang
        $order = Order::create($request->all());

        // Them chi tiet don hang
        $carts = Cart::content();

        foreach($carts as $cart){
            $data = [
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'qty' => $cart->qty,
                'amount' => $cart->price,
                'total' => $cart->price * $cart->qty,
            ];

            OrderDetail::create($data);
        }

        // Gui mail
        $total = Cart::total();
        $subtotal = Cart::subtotal();
        $this->sendEmail($order, $total, $subtotal);

        // Xoa gio hang
        Cart::destroy();

        // Tra ve kq
        return redirect('checkout/result')
            ->with('notification', 'Success! Please check your email.');
    }

    public function result(){
        $notification = session('notification');
        return view('front.checkout.result', compact('notification'));
    }

    private function sendEmail($order, $total, $subtotal){
        $email_to = $order->email;

        Mail::send('front.checkout.email', compact('order', 'total', 'subtotal'),
            function($message) use ($email_to){
                $message->from('nguyenthuyduong201102@gmail.com', 'Shop');
                $message->to($email_to, $email_to);
                $message->subject('Order Notification');

        });
    }


}
