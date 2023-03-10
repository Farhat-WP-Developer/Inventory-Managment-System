<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalInventories extends Model
{
  /**
   * Get all of the comments for the TotalInventories
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
//   public function Sales(): HasMany
//   {
//       return $this->hasMany(TotalInventories::class, 'product_id ', 'id');
//   }
    use HasFactory;
}
