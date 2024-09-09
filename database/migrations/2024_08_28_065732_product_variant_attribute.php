<?php

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_variant_attribute', function (Blueprint $table) {
            $table->foreignIdFor(ProductVariant::class)->constrained();
            $table->foreignIdFor(Attribute::class)->constrained();
            $table->foreignIdFor(AttributeValue::class)->constrained();
            
            $table->unique(['product_variant_id', 'attribute_id', 'attribute_value_id'],'product_variant_attributes_unique'); // Đảm bảo tính duy nhất
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
