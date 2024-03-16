<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\create_category_table;



class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'price',
        'discount',
        'is_available',
        'is_trendy',
        'image',
        'amount'
    ];

    public function category(){
        return $this->belongsTo(Categories::class,'category_id');
    }

    public function brand(){
        return $this->belongsTo(Brands::class,'brand_id');
    }
}