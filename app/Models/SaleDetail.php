<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 'sales_details';

    protected $fillable = [
        'sales_id',
        'user_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
