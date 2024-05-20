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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->string('carrier')->nullable();
            $table->decimal('shipping_cost', 8, 2)->nullable();
            $table->decimal('weight', 8, 3)->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->string('origin_postal_code')->nullable();
            $table->string('destination_postal_code')->nullable();
            //Envios "Nacionales"
            // $table->string('national_carrier')->nullable();
            // $table->decimal('national_shipping_cost', 8, 2)->nullable();
            // $table->decimal('national_weight', 8, 3)->nullable();
            // $table->decimal('national_length', 8, 2)->nullable();
            // $table->decimal('national_width', 8, 2)->nullable();
            // $table->decimal('national_height', 8, 2)->nullable();
            // $table->string('national_origin_postal_code')->nullable();
            // $table->string('national_destination_postal_code')->nullable();
            // $table->decimal('total_with_shipping', 10, 2)->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('courier_code', 40)->nullable();
            $table->string('tracking_number', 50)->index()->nullable();
            $table->string('delivery_status', 50)->nullable(); //NOTA: almacenar el status obtenido de la paquetería.
            $table->string('delivery_event', 140)->nullable();
            $table->date('estimated_delivery_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
