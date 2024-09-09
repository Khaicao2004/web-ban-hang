<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'product_name',
        'product_sku',
        'product_image',
        'product_variant_image',
        'product_price_regular',
        'product_price_sale',
        'product_variant_price'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function productVariant(){
        return $this->belongsTo(ProductVariant::class);
    }
    public function orderItemAttributes(){
        return $this->hasMany(OrderItemAttribute::class);
    }

}
