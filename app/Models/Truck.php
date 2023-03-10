<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{

    use HasFactory;
 
    // public function inventory()
    // {
    //     return $this->hasMany('App\TotalInventory');
    // }

    // public function specific_inventory()
    // {
    //     return $this->hasMany('App\Inventory');
    // }

    public function products()
    {
        return $this->hasMany('App\Products');
    }


}
