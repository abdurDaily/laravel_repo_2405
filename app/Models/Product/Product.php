<?php

namespace App\Models\Product;

use App\Models\Images\Images;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function images()
    {
        return $this->hasMany(Images::class);
    }
}
