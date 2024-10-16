<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function add(Request $request, $id) {
        if (!Auth::check()) {
            return response()->json(['error' => 'Você precisa estar logado para adicionar itens ao carrinho.'], 403);
        }
    
        $product = Product::find($id);
    
        if (!$product || $product->stock <= 0) {
            return response()->json(['error' => 'Produto esgotado! :('], 400);
        }
    
        $cart = session()->get('cart', []);
    
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] >= $product->stock) {
                return response()->json(['error' => 'Quantidade máxima disponível em estoque já foi adicionada.'], 400);
            }
    
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "photo" => $product->photo
            ];
        }
    
        session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Item adicionado ao carrinho!');
    }    
    
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Carrinho atualizado!');
        }

        return redirect()->back()->with('error', 'Produto não encontrado no carrinho.');
    }
  
    public function remove($id){
        $cart = session()->get('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);
            session()->put('cart', $cart);
    }
        return redirect()->back()->with('error', 'Produto removido do carrinho!');
    }

    public function index(){
        $cart = session()->get('cart');
        return view('cart.cart', compact('cart'));
    }
    
}
