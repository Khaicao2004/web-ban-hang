<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $productHotDeals = Product::query()->where('is_hot_deal', true)->paginate(5);
        return view('client.index', compact('productHotDeals'));
    }

    public function productDetails($slug)
    {
        $product = Product::with(['productVariants', 'productVariants.attributes', 'productVariants.attributeValues'])->where('slug', $slug)->first();
        $galleries = ProductGallery::query()->where('product_id', $product->id)
        ->pluck('image', 'id');
        // dd($galleries);
        $groupedAttributes = [];
        foreach ($product->productVariants as $variant) {
            foreach ($variant->attributes as $attribute) {
                $groupedAttributes[$attribute->name][$attribute->pivot->attribute_value_id] = $attribute->attributeValues->find($attribute->pivot->attribute_value_id)->name;
            }
        }
        // dd($groupedAttributes);

        return view('client.shop-details', compact('product', 'groupedAttributes', 'galleries'));
    }

    public function shop($slug){
        $catalogue = Catalogue::where('slug', $slug)->first();
        $products = Product::query()
        ->where('catalogue_id', $catalogue->id)
        ->where('is_active', true)
        ->get();
        // dd($products->toArray());
        return view('client.shop', compact('products'));
    }
    
}
