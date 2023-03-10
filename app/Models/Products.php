<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public function truck()
    {
        return $this->belongsTo('App\Truck')->onDelete('cascade')->onUpdate('no action');
    }
}
