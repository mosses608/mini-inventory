<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if($filters['search'] ?? false){
            $query->where('product_id' , 'like' , '%' . request('search') . '%')
            ->orwhere('product_name' , 'like' , '%' . request('search') . '%')
            ->orwhere('brand' , 'like' , '%' . request('search') . '%');
        }
    }

    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'price',
        'brand',
        // 'image',
        'totalprice',
    ];

    public static function find($id){

        $sales = self::all();

        foreach ($sales as $sale) {
            if($sale['id'] = $id){
                return $sale;
            }
        }
    }
}
