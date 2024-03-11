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
            // $table->decimal('price', 10, 2)->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('netsuite_item')->nullable();
            $table->string('netsuite_item_txt')->nullable(); //NOTA: en netsuite está como: itemTxt
            $table->string('data_sheet', 100)->nullable();
            $table->string('featured', 100)->nullable(); //TODO: quitar nullable cuando ya tengamos subida de imagenes.

            $table->boolean('status')->default(1); // 1 Activo, 0 Inactivo

            $table->string('slug', 100)->nullable();

            $table->timestamps();

            $table->softDeletes();

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
