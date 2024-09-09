<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItemAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_item_id',
        'attribute_name',
        'attribute_value_name'
    ];


    public function orderItem(){
        return $this->belongsTo(OrderItem::class);
    }
    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
    public function attributeValue(){
        return $this->belongsTo(AttributeValue::class);
    }
}
