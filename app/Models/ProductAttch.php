<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttch extends Model
{
    use HasFactory;
    protected $table = 'productAttch';
    protected $primaryKey = 'AttachId';
    protected $fillable = [
        'productId',
        'attachment',
        'isVisible',
    ];
   
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'productId');
    }


}
