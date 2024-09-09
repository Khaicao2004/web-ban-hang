<?php

use App\Models\Order;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(ProductVariant::class)->constrained();
            // số lượng của biến thể
            $table->unsignedInteger('quantity')->default(0);
            //sao lưu thông tin sản phẩm
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('product_image')->nullable();
            // ảnh của biến thể
            $table->string('product_variant_image')->nullable();
            $table->decimal('product_price_regular', 10, 2);
            $table->decimal('product_price_sale', 10, 2); 
            // giá của biến thể
            $table->decimal('product_variant_price', 10, 2)->comment('Giá theo biến thể');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
