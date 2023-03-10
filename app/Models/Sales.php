<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'sales_man_id',
        'product_code',
        'product_name',
        'route',
        'stock_out_cost',
        'stock_out',
        'stock_in',
        'sold_stock_qty',
        'sold_stock_cost',
    ];

    public function salesMan()
    {
        return $this->belongsTo(SalesPerson::class, 'sales_man_id');
    }

    // public function inventory()
    // {
    //     return $this->belongsTo(TotalInventories::class);
    // }
    use HasFactory;

}
