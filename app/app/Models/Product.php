<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function scopeFilter($query , array $filters){
        if($filters['search'] ?? false){
            $query->where('product_id' , 'like' , '%' . request('search') . '%')
            -orwhere('product_name' , 'like' , '%' . request('search') . '%')
            ->orwhere('brand' , 'like' , '%' . request('search') . '%');
        }
    }
    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'description',
        'price',
        'status',
        'brand',
        'image',
    ];

    public static function find($id){
        $products = self::all();

        foreach ($products as $product) {
            if($product['id'] = $id){
                return $product;
            }
        }
    }
}
