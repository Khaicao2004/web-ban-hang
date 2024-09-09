<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Catalogue;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Tag;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::query()->with(['catalogue', 'tags'])
            ->latest()->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catalogues = Catalogue::query()->pluck('name', 'id');
        $tags = Tag::query()->pluck('name', 'id');
        $attributes = Attribute::query()->pluck('name', 'id');
        $attributeValues = AttributeValue::query()->pluck('name', 'id');
        $wareHouses = WareHouse::query()->pluck('name', 'id');
        return view(self::PATH_VIEW . __FUNCTION__, compact('catalogues', 'tags', 'attributes', 'attributeValues', 'wareHouses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd($request->all());
            $dataProduct = $request->except(['image', 'variants', 'product_galleries', 'tags']);
            $dataProduct['is_active'] = isset($dataProduct['is_active']) ? 1 : 0;
            $dataProduct['is_hot_deal'] = isset($dataProduct['is_active']) ? 1 : 0;
            $dataProduct['is_new'] = isset($dataProduct['is_active']) ? 1 : 0;
            $dataProduct['is_show_home'] = isset($dataProduct['is_active']) ? 1 : 0;
            $dataProduct['slug'] = Str::slug($dataProduct['name']) . '-' . $dataProduct['sku'];

            if ($request->hasFile('image')) {
                $dataProduct['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            $product = Product::query()->create($dataProduct);
            $wareHouseId = $request->input('ware_house_id');
            // biến thể
            // dd($request->variants);
            foreach ($request->variants as $variantData) {
                // Tạo mới biến thể
                // if ($variantData['image']) {
                //     $variantData['image'] = Storage::put('variants', $variantData['image']);
                // }
                $image = $variantData['image'] ?? null;
                if ($image) {
                    $image = Storage::put('variants', $image);
                }
                $productVariant = $product->productVariants()->create([
                    'price' => $variantData['price'],
                    'quantity' => $variantData['quantity'],
                    'image' => $image ?? $product->image,
                ]);
                if ($variantData['attributes'] && $variantData['attribute_values']) {
                    $attributes = [];
                    foreach ($variantData['attributes'] as $key => $attributeId) {
                        $attributeValueId = $variantData['attribute_values'][$key];
                        if ($attributeValueId) {
                            $attributes[$attributeId] = ['attribute_value_id' => $attributeValueId];
                        }
                    }
                    $productVariant->attributes()->sync($attributes);
                }
                Inventory::query()->create([
                    'ware_house_id' => $wareHouseId,
                    'product_id' => $product->id,
                    'product_variant_id' => $productVariant->id,
                    'quantity' => $variantData['quantity']
                ]);
            }

            foreach ($request->product_galleries as $image) {
                $product->galleries()->create([
                    'image' => Storage::put('galleries', $image)
                ]);
            }
            $product->tags()->sync($request->tags);
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Lỗi thêm sản phẩm ' . $exception->getMessage());
            return back()->with('success', 'Lỗi thêm sản phẩm');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
