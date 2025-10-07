<?php

namespace App\Models\Images;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable = [
        'product_id',
        'image',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
