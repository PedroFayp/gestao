<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Movement;
use App\Models\SaleDetail;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (session('cart') == null || count(session('cart')) == 0) {
            return redirect()->route('cart')->with('error', 'Seu carrinho está vazio.');
        }

        $totalPrice = 0;
        
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $totalPrice += $item['quantity'] * $product->price; 
            }
        }

        $sale = Sale::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
        ]);

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                SaleDetail::create([
                    'sales_id' => $sale->id, 
                    'product_id' => $product->id, 
                    'quantity' => $item['quantity'], 
                    'price' => $item['price'], 
                    'user_id' => auth()->id(),
                ]);
                
                $product->stock -= $item['quantity'];
                $product->save();

                Movement::create([
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'type' => 'saida',
                    'date' => now(),
                ]);
            }
        }

        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Compra realizada com sucesso!');
    }
}

