<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\Product;

class AdminController extends Controller
{
    public function showProducts()
    {
        return view('admin.products');
    }

    public function manageListLog(Request $request)
    {
        $query = Movement::with('product');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $movements = $query->paginate(10);

        return view('admin.list-log', compact('movements'));
    }  

    public function manageInventoryReport()
    {
        $products = Product::all();

        return view('admin.current-inventory-report', compact('products'));
    }

    public function rankingProducts()
    {
        $topProducts = Product::orderBy('sold_count', 'desc')
        ->take(10)
        ->get();

        return view('admin.ranking', compact('topProducts'));

    }


    public function index(Request $request)
    {
        $query = Movement::with('product');
    
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
    
        $movements = $query->paginate(10); 
    
        return view('admin.list-log', compact('movements'));
    }
    

    public function export(Request $request)
    {
        $query = Movement::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $movements = $query->get();

        $csvFileName = 'movements_' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$csvFileName\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $list = array (array("ID", "Tipo", "Produto", "Quantidade", "Data"));

        foreach ($movements as $movement) {
            $list[] = array(
                $movement->id,
                $movement->type,
                $movement->product->name,
                $movement->quantity,
                $movement->created_at->format('d/m/Y H:i:s')
            );
        }

        $callback = function() use ($list) {
            $out = fopen("php://output", 'w');
            foreach ($list as $line) {
                fputcsv($out, $line);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportCurrentInventory()
    {
        $products = Product::all(); 

        $csvFileName = 'current_inventory_' . date('Y-m-d') . '.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$csvFileName\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $list = array(array("ID", "Nome do Produto", "Descrição", "Preço", "Quantidade em Estoque", "SKU", "Data de Validade"));

        foreach ($products as $product) {
            $list[] = array(
                $product->id,
                $product->name,
                $product->description,
                $product->price,
                $product->stock,
                $product->sku,
                $product->expiry_date ? \Carbon\Carbon::parse($product->expiry_date)->format('d/m/Y') : 'N/A'
            );
        }

        $callback = function () use ($list) {
            $out = fopen("php://output", 'w');
            foreach ($list as $line) {
                fputcsv($out, $line);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportRankingToCsv()
    {
        $topProducts = Product::orderBy('sold_count', 'desc')
            ->take(10)
            ->get();

        $csvFileName = 'top_10_products_' . date('Y-m-d') . '.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=\"$csvFileName\"",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $list = array (array("Posição", "Nome do Produto", "Quantidade Vendida"));

        foreach ($topProducts as $index => $product) {
            $list[] = array(
                $index + 1,
                $product->name,
                $product->sold_count
            );
        }

        $callback = function() use ($list) {
            $out = fopen("php://output", 'w');
            foreach ($list as $line) {
                fputcsv($out, $line);
            }
            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

}
