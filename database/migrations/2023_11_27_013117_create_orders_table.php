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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->decimal('total', 10, 2);

            $table->enum('status', ['pending_payment', 'pending', 'approved', 'cancelled'])->default('pending');
            $table->string('cancellation_reason', 100)->nullable(); // ¿Por qué razón se cancela el pedido.?

            $table->string('delivery_status', 50)->nullable(); //NOTA: almcena el status obtenido de la paquetería.
            $table->date('estimated_delivery_date')->nullable();

            $table->string('method', 50)->nullable(); //Transferencia Bancaria, PayPal, Stripe, Etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
