<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'catalogue_id',
        'name',
        'sku',
        'slug',
        'image',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
        'user_manual',
        'views',
        'is_active',
        'is_hot_deal',
        'is_new',
        'is_sale',
        'is_show_home',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_new' => 'boolean',
        'is_sale' => 'boolean',
        'is_show_home' => 'boolean',
    ];
    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }
    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
