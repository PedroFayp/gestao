<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Movement;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'photo' => 'image|nullable|max:5120',
            'expiry_date' => 'required|date|after:today',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|max:255|unique:products,sku',
        ]);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->category_id = $validatedData['category_id'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];

        if ($request->hasFile('photo')) {
            $product->photo = $request->file('photo')->store('images', 'public');
        }

        $product->expiry_date = $validatedData['expiry_date'];
        $product->stock = $validatedData['stock'];
        $product->sku = $validatedData['sku'];
        $product->save();

        Movement::create([
            'product_id' => $product->id,
            'quantity' => $product->stock,
            'type' => 'entrada',
        ]);

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!'); 
    }

    public function registerExit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($id);

        if ($product->stock < $validatedData['quantity']) {
            return response()->json(['error' => 'Estoque insuficiente'], 400);
        }

        $product->stock -= $validatedData['quantity'];
        $product->save();

        Movement::create([
            'product_id' => $product->id,
            'quantity' => $validatedData['quantity'], 
            'type' => 'saida', 
        ]);

        return response()->json(['success' => true]);
    }


    public function index()
    {
        $products = Product::all();
        
        $categories = Category::withCount('products')->get();

        return view('products', compact('products', 'categories'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        Movement::create([
            'product_id' => $product->id,
            'quantity' => $product->stock,
            'type' => 'saida',
            'date' => now(),
        ]);

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->sku = $request->sku;
        
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $product->photo = $path;
        }

        $product->expiry_date = $request->expiry_date;
        $product->save();

        return response()->json(['success' => true]);
    }

}
