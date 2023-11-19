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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('brand', 40);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('sku')->nullable();
            $table->integer('stock')->nullable();
            $table->string('data_sheet', 100)->nullable();
            $table->string('featured', 100)->nullable(); //TODO: quitar nullable cuando ya tengamos subida de imagenes.
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
