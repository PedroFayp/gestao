<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 
        'type', 
        'quantity', 
        'created_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
