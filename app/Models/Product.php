<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function category()
    {
        return $this->belongsTo(Category::class, 'catId', 'catId');
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttch::class, 'productId', 'productId');
    }
}
