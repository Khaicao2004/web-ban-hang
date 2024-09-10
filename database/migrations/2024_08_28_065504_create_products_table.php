<?php

use App\Models\Catalogue;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Catalogue::class)->constrained();
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->decimal('price_regular', 10, 2)->comment('Giá cơ bản');
            $table->decimal('price_sale', 10, 2)->nullable()->comment('Giá cơ bản');
            $table->string('description')->nullable();
            $table->text('content')->nullable();
            $table->text('material')->nullable()->comment('Chất liệu');
            $table->text('user_manual')->nullable()->comment('Hướng dẫn sử dụng');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_new')->default(false);
            $table->boolean('is_sale')->default(false);
            $table->boolean('is_show_home')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
