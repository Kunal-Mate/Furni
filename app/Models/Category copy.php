<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'mst_categories';
    protected $primaryKey = 'catId';
    protected $fillable = [
        'catName',
        'catImg',
        'isVisible',
        'mainCat',
        'superId',
        'created_at',
        'updated_at'
    ];

    public function superCategory()
    {
        return $this->belongsTo(SuperCategory::class, 'superId', 'superId');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'catId', 'catId');
    }


}
