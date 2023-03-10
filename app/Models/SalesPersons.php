<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesPersons extends Model
{
    public function sales()
{
    return $this->hasMany(Sale::class, 'sales_man_id');
}
    use HasFactory;
}
