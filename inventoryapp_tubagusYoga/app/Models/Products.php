<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'image', 'description', 'price', 'stock', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
