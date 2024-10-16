<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $topProducts = Product::orderBy('sold_count', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('topProducts'));
    }
}
