<?php
// Cấu trúc dữ liệu để dễ sử dụng trên giao diện
        // $attributesGrouped = [];
        // foreach ($product->variants as $variant) {
        //     foreach ($variant->attributes as $attribute) {
        //         $attributesGrouped[$attribute->id] = [
        //             'name' => $attribute->name,
        //             'values' => $attribute->attributeValues->pluck('name', 'id')->toArray()
        //         ];
        //     }
        // }




        // public function productDetails($slug)
        // {
        //     $product = Product::with(['productVariants', 'productVariants.attributes', 'productVariants.attributeValues'])->where('slug', $slug)->first();
        //     $productVariants = $product->productVariants;
        //     $variants = $product->productVariants;
        //     $attributesValues = [];
    
        //     foreach ($variants as $variant) {
    
        //         foreach ($variant->attributeValues as $value) {
    
        //             $attributesValues[$value->attribute_id][$variant->id][] = $value;
        //         }
        //     }
    
        //     // dd($attributeValues->toArray());
        //     // Lấy tất cả các thuộc tính liên kết với các biến thể đó
        //     $attributes = Attribute::whereHas('productVariants', function ($q) use ($productVariants) {
        //         $q->whereIn('product_variants.id', $productVariants->pluck('id'));
        //     })->with('attributeValues')->get();
        //     // dd($attributes->toArray());
        //     return view('client.shop-details', compact('product', 'attributes', 'variants', 'attributesValues'));
        // }


        //mới nhát
//         $attributesGrouped = [];
// foreach ($product->variants as $variant) {
//     foreach ($variant->attributes as $attribute) {
//         // Lưu giá trị thuộc tính vào mảng, đảm bảo không trùng lặp
//         $attributesGrouped[$attribute->id]['name'] = $attribute->name;
//         $attributesGrouped[$attribute->id]['values'][$variant->pivot->attribute_value_id] = $attribute->attributeValues->find($variant->pivot->attribute_value_id)->name;
//     }
// }

        
//$attributeIds = Attribute::whereIn('name', array_keys($attributes))
// ->pluck('id', 'name')
// ->toArray();
// public function add(Request $request)
//   {
//     // dd($request->all());
//     $productId = $request->input('product_id');
//     $attributes = $request->input('attributes');
//     $quantity = $request->input('quantity');
//     // Chuyển đổi tên thuộc tính thành ID thuộc tính
//     $attributeIds = Attribute::whereIn('name', array_keys($attributes))
//       ->pluck('id', 'name')
//       ->toArray();

//     // Chuyển đổi tên thuộc tính thành giá trị
//     $attributeValues = array_map(function ($attribute) use ($attributeIds) {
//       return [
//         'attribute_id' => $attributeIds[$attribute['name']],
//         'attribute_value_id' => $attribute['value']
//       ];
//     }, $attributes);
//     $productVariant = ProductVariant::where('product_id', $productId)
//       ->whereHas('attributes', function ($query) use ($attributeValues) {
//         foreach ($attributeValues as $attribute) {
//           $query->where(function ($q) use ($attribute) {
//             $q->where('attribute_id', $attribute['attribute_id'])
//               ->where('attribute_value_id', $attribute['attribute_value_id']);
//           });
//         }
//       }, '=', count($attributeValues)) // Đảm bảo số lượng điều kiện khớp với số thuộc tính
//       ->first();

//     if (!$productVariant) {
//       return redirect()->back()->withErrors('Biến thể sản phẩm không tồn tại.');
//     }
//     dd($productVariant);
//   }
// public function add(Request $request) {
//         // Lấy dữ liệu từ request
//         $productId = $request->input('product_id');
//         $attributes = $request->input('attributes'); // Mảng thuộc tính với giá trị
//         $quantity = $request->input('quantity');
    
//         // Tìm biến thể sản phẩm dựa trên thuộc tính
//         $productVariant = ProductVariant::where('product_id', $productId)
//             ->whereHas('attributes', function($query) use ($attributes) {
//                 foreach ($attributes as $attributeName => $attributeValueId) {
//                     $attribute = Attribute::where('name', $attributeName)->first();
//                     if ($attribute) {
//                         $query->whereHas('attributes', function($q) use ($attribute, $attributeValueId) {
//                             $q->where('attribute_id', $attribute->id)
//                               ->where('attribute_value_id', $attributeValueId);
//                         });
//                     }
//                 }
//             }, '=', count($attributes))
//             ->first();
    
//         if (!$productVariant) {
//             return redirect()->back()->withErrors('Biến thể sản phẩm không tồn tại.');
//         }
    
//         // Thực hiện thêm sản phẩm vào giỏ hàng ở đây
//         // Giả sử bạn có một phương thức addProductToCart để xử lý việc thêm sản phẩm vào giỏ hàng
//         $this->addProductToCart($productVariant, $quantity);
    
//         return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
//     }
//     protected function addProductToCart(ProductVariant $productVariant, $quantity) {
//         // Giả sử bạn đang sử dụng session để lưu giỏ hàng
//         $cart = session()->get('cart', []);
    
//         // Thêm sản phẩm vào giỏ hàng
//         $cart[$productVariant->id] = [
//             'product_variant_id' => $productVariant->id,
//             'quantity' => $quantity,
//             'price' => $productVariant->price_sale // hoặc `price_regular` tùy thuộc vào giá bán
//         ];
    
//         // Cập nhật giỏ hàng trong session
//         session()->put('cart', $cart);
//     }
        
// use Illuminate\Support\Facades\Auth;

// public function add(Request $request)
// {
//     $productId = $request->input('product_id');
//     $attributes = $request->input('attributes');
//     $quantity = $request->input('quantity');

//     $attributeIds = [];
//     foreach ($attributes as $attributeName => $attributeValueId) {
//         $attributeId = Attribute::where('name', $attributeName)->value('id');
//         if ($attributeId) {
//             $attributeIds[$attributeId] = $attributeValueId;
//         }
//     }

//     $productVariantQuery = ProductVariant::where('product_id', $productId);

//     foreach ($attributeIds as $attributeId => $attributeValueId) {
//         $productVariantQuery->whereHas('attributes', function ($query) use ($attributeId, $attributeValueId) {
//             $query->where('attribute_id', $attributeId)
//                   ->where('attribute_value_id', $attributeValueId);
//         });
//     }

//     $productVariant = $productVariantQuery->first();

//     if (!$productVariant) {
//         return redirect()->back()->withErrors('Biến thể sản phẩm không tồn tại.');
//     }

//     // Tạo giỏ hàng nếu chưa có
//     $cart = Cart::firstOrCreate([
//         'user_id' => Auth::id(), // Sử dụng ID người dùng hiện tại
//     ]);

//     // Thêm sản phẩm vào giỏ hàng
//     CartItem::create([
//         'cart_id' => $cart->id,
//         'product_variant_id' => $productVariant->id,
//         'quantity' => $quantity,
//     ]);

//     return redirect()->route('cart.index'); // Chuyển hướng đến trang giỏ hàng
// }

// public function add(Request $request)
// {
//     $productId = $request->input('product_id');
//     $attributes = $request->input('attributes');
//     $quantity = $request->input('quantity');

//     $attributeIds = [];
//     foreach ($attributes as $attributeName => $attributeValueId) {
//         $attributeId = Attribute::where('name', $attributeName)->value('id');
//         if ($attributeId) {
//             $attributeIds[$attributeId] = $attributeValueId;
//         }
//     }

//     $productVariantQuery = ProductVariant::where('product_id', $productId);

//     foreach ($attributeIds as $attributeId => $attributeValueId) {
//         $productVariantQuery->whereHas('attributes', function ($query) use ($attributeId, $attributeValueId) {
//             $query->where('attribute_id', $attributeId)
//                   ->where('attribute_value_id', $attributeValueId);
//         });
//     }

//     $productVariant = $productVariantQuery->first();

//     if (!$productVariant) {
//         return redirect()->back()->withErrors('Biến thể sản phẩm không tồn tại.');
//     }

//     // Lưu vào session
//     $cart = session()->get('cart', []);
    
//     if (isset($cart[$productVariant->id])) {
//         $cart[$productVariant->id]['quantity'] += $quantity;
//     } else {
//         $cart[$productVariant->id] = [
//             'product_variant_id' => $productVariant->id,
//             'quantity' => $quantity,
//             'price' => $productVariant->price,
//             'name' => $productVariant->product->name,
//             // Thêm các thông tin khác nếu cần
//         ];
//     }

//     session()->put('cart', $cart);

//     return redirect()->route('cart.index'); // Chuyển hướng đến trang giỏ hàng
// }

        // 'product_variant_id' => $productVariant->id,
        // 'product_name' => $product->name,
        // 'product_sku' => $product->sku,
        // 'product_price_regular' => $product->price_regular,
        // 'product_price_sale' => $product->price_sale,
        // 'product_image' => $product->image,
        // 'quantity' => $quantity,
        // 'price' => $productVariant->price,
        // 'image' => $productVariant->image,
        // 'attributes' => $attributes ,