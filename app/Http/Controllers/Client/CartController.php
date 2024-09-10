<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
  public function list(){
    // session()->forget('cart');
    if(session()->has('cart')){
      $cart = session('cart');
    }else{
      $cart = [];
    }
    // dd($cart);
    $totalAmount = 0;
   foreach ($cart as  $item) {
        $totalAmount += $item['quantity'] * $item['price'];
   }
   return view('client.shopping-cart',compact('totalAmount'));
}
  public function add(Request $request)
  {
    // dd($request->all());  
    $productId = $request->input('product_id');
    $attributes = $request->input('attributes');
    $quantity = $request->input('quantity');
    // Lấy ID của các thuộc tính dựa trên tên thuộc tính
    $attributeIds = [];
    foreach ($attributes as $attributeName => $attributeValueId) {
      $attributeId = Attribute::where('name', $attributeName)->value('id');
      if ($attributeId) {
        $attributeIds[$attributeId] = $attributeValueId;
      }
    }

    // Bắt đầu xây dựng query để tìm kiếm biến thể sản phẩm
    $productVariantQuery = ProductVariant::where('product_id', $productId);

    // Lặp qua từng thuộc tính và giá trị để thêm điều kiện vào query
    foreach ($attributeIds as $attributeId => $attributeValueId) {
      $productVariantQuery->whereHas('attributes', function ($query) use ($attributeId, $attributeValueId) {
        $query->where('attribute_id', $attributeId)
          ->where('attribute_value_id', $attributeValueId);
      });
    }

    // Lấy biến thể sản phẩm đầu tiên khớp với điều kiện
    $productVariant = $productVariantQuery->first();

    if (!$productVariant) {
      return redirect()->back()->withErrors('Biến thể sản phẩm không tồn tại.');
    }

    $cart = session()->get('cart',[]);
    if(isset($cart[$productVariant->id])){
      $cart[$productVariant->id]['quantity'] += $quantity;
    }else{
      $cart[$productVariant->id] = [
        'product_variant_id' => $productVariant->id,
        'product_name' => $productVariant->product->name,
        'product_sku' => $productVariant->product->sku,
        'product_price_regular' => $productVariant->product->price_regular,
        'product_price_sale' => $productVariant->product->price_sale,
        'product_image' => $productVariant->product->image,
        'quantity' => $quantity,
        'price' => $productVariant->price,
        'image' => $productVariant->image ?: $productVariant->product->image,
        'attributes' => $attributes ,
      ];
    }
    session()->put('cart', $cart);
    return redirect()->route('cart.list');
  }
}
