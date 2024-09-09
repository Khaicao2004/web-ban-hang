<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productHotDeals = Product::query()->where('is_hot_deal', true)->paginate(5);
        return view('client.index', compact('productHotDeals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function productDetails($slug)
    {
        $product = Product::with(['productVariants', 'productVariants.attributes', 'productVariants.attributeValues'])->where('slug', $slug)->first();
        $groupedAttributes = [];
        foreach ($product->productVariants as $variant) {
            foreach ($variant->attributes as $attribute) {
                $groupedAttributes[$attribute->name][$attribute->pivot->attribute_value_id] = $attribute->attributeValues->find($attribute->pivot->attribute_value_id)->name;
            }
        }
        // dd($groupedAttributes);

        return view('client.shop-details', compact('product', 'groupedAttributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
