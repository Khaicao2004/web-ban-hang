<?php

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
        Schema::create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->index()->nullable();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('description')->nullable();

            $table->foreign('parent_id')->references('id')->on('catalogues');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogues');
    }
};
