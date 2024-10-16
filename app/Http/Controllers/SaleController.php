<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function store($total_price) 
    {
        $sale = Sale::create([
            'user_id' => auth()->id(),
            'total_price' => $total_price,
        ]);

        return $sale;
    }
}
