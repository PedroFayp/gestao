<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function show($id) {
        $order = Order::with('items.product')->find($id);
    
        if(!$order || $order->user_id != auth()->id()){
            return redirect()->route('home')->with('error', 'Pedido não encontrado.');
        }
    
        return view('orders.show', compact('order'));
    }
}
