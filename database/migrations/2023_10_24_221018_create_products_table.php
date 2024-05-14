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
            $table->string('name', 120); // NOMBRE_PARA_MOSTRAR_EN_LA_TIENDA_WEB || NOMBRE
            $table->string('brand', 40)->nullable();
            $table->text('description')->nullable(); // DESCRIPCION_DETALLADA
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('netsuite_id')->nullable(); // ID
            $table->string('netsuite_item')->nullable(); // ARTICULO
            $table->string('data_sheet', 100)->nullable();
            $table->string('featured', 100)->nullable();

            $table->float('weight', 8, 2)->nullable();
            $table->float('length', 8, 2)->nullable();
            $table->float('width', 8, 2)->nullable();
            $table->float('height', 8, 2)->nullable();

            $table->boolean('status')->default(1);

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
