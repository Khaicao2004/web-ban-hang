<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Catalogue;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Catalogue::truncate();
        Tag::truncate();
        Attribute::truncate();
        AttributeValue::truncate();
        DB::table('product_variant_attribute')->truncate();
        DB::table('product_tag')->truncate();
        Catalogue::factory(10)->create();
        Tag::factory(10)->create();
        foreach (['Màu sắc', 'Kích cỡ'] as $item) {
            Attribute::query()->create([
                'name' => $item
            ]);
        }
        $attributes = [
            1 => ['Đỏ', 'Xanh', 'Vàng'], // Thuộc tính với ID = 1 (Ví dụ: Màu sắc)
            2 => ['S', 'M', 'L'], // Thuộc tính với ID = 2 (Ví dụ: Kích thước)
        ];

        foreach ($attributes as $attributeId => $values) {
            foreach ($values as $value) {
                AttributeValue::create([
                    'attribute_id' => $attributeId,
                    'name' => $value
                ]);
            }
        }

        for ($i = 1; $i < 11; $i++) {
            $name = fake()->name;
           Product::query()->create([
            'catalogue_id' => rand(1,10),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $i,
            'image' => 'https://canifa.com/img/500/750/resize/8/t/8ts24s001-sb001-thumb.webp',
            'price_regular' => 250000,
            'price_sale' => 200000,
           ]);
           ProductGallery::query()->insert([
            [
                'product_id' => $i,
                'image' => 'https://canifa.com/img/1000/1500/resize/8/t/8ts23s008-se297-1.webp', 
            ],
            [
                'product_id' => $i,
                'image' => 'https://canifa.com/img/1000/1500/resize/8/t/8ts24s015-sk317-2.webp', 
            ],
        ]);
        DB::table('product_tag')->insert([
            [
                'product_id' => $i,
                'tag_id' => rand(1,6)
            ],
            [
                'product_id' => $i, 
                'tag_id' => rand(7,11)
            ]
        ]);
        ProductVariant::query()->create([
            'product_id' => $i,
            'sku' => Str::random(8) . $i,
            'price'  => 200000,
            'quantity' => 100,
            'image' => 'https://canifa.com/img/1000/1500/resize/8/t/8ts24s015-sk317-2.webp', 
        ]);
        }
       
        for ($productId = 1; $productId < 11; $productId++) { 
          for ($attributeId= 1; $attributeId < 11; $attributeId++) { 
           for ($attributeValueId = 1; $attributeValueId < 11; $attributeValueId++) { 
            $data = [];
            $data = [
                'product_variant_id' => $productId,
            	'attribute_id' => $attributeId,
                'attribute_value_id' => $attributeValueId
            ];
                DB::table('product_variant_attribute')->insert([$data]);
           }
          }
           
        }
    }
}
