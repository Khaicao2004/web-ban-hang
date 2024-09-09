<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AttributeValue;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAttribute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
   public function showFormOrder()
   {
      // session()->forget('cart');
      if (session()->has('cart')) {
         $cart = session('cart');
      } else {
         $cart = [];
      }
      // dd($cart);
      $totalAmount = 0;
      foreach ($cart as  $item) {
         $totalAmount += $item['quantity'] * $item['price'];
      }
      return view('client.checkout', compact('totalAmount'));
   }

   public function saveOrder()
   {
      try {
         DB::transaction(function () {
            if (Auth::check()) {
               $user = Auth::user();
            } else {
               $user = User::query()->create([
                  'name' => request('user_name'),
                  'email' => request('user_email'),
                  'password' => bcrypt(request('user_email')),
                  'phone' => request('user_phone'),
                  'address' => request('user_address'),
                  'is_active' => false,
               ]);
            }
            $totalAmount = 0;
            $dataItem = [];
            $dataItemAttribute = [];
            foreach (session('cart') as $item) {
               $totalAmount += $item['quantity'] * $item['price'];

               $dataItem[] = [
                  'product_variant_id' => $item['product_variant_id'],
                  'product_name' => $item['product_name'],
                  'product_sku' => $item['product_sku'],
                  'product_image' => $item['product_image'],
                  'product_variant_image' => $item['image'],
                  'product_price_regular' => $item['product_price_regular'],
                  'product_price_sale' => $item['product_price_sale'],
                  'product_variant_price' => $item['price'],
                  'quantity' => $item['quantity'],
               ];
               $dataItemAttribute[$item['product_variant_id']] = [
                  'attributes' => $item['attributes']
               ];
            }
            // dd($dataItemAttribute);
            $order = Order::query()->create([
               'user_id' => $user->id,
               'user_name' => $user->name,
               'user_email' => $user->email,
               'user_phone' => $user->phone,
               'user_address' => $user->address,
               'user_note' => request('user_note'),
               'total_price' =>  $totalAmount,
            ]);

            foreach ($dataItem as $item) {
               $item['order_id'] = $order->id;
               $orderItem = OrderItem::query()->create($item);

               $productVariantId = $item['product_variant_id'];
               if ($dataItemAttribute[$productVariantId]) {
                  foreach ($dataItemAttribute[$productVariantId]['attributes'] as $attributeName => $attributeValueId) {
                     $attributeValue = AttributeValue::find($attributeValueId);
                     OrderItemAttribute::query()->create([
                        'order_item_id' => $orderItem->id,
                        'attribute_name' => $attributeName,
                        'attribute_value_name' => $attributeValue ? $attributeValue->name : 'Not Found'
                     ]);
                  }
               }
            }
         });

         session()->forget('cart');
         return redirect()->route('home')->with('success', 'Đặt hàng thành công');
      } catch (\Exception $exception) {
         DB::rollBack();
         Log::error('Lỗi đặt hàng ' . $exception->getMessage());
         return back()->with('error', 'Lỗi đặt hàng');
      }
   }
}
