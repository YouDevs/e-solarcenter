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
            $table->unsignedInteger('folio');
            $table->decimal('total', 10, 2);
            $table->string('payment_concept', 30)->nullable();

            $table->enum('status', ['payment_submitted', 'pending_payment', 'pending', 'approved', 'cancelled'])->default('pending');
            $table->string('cancellation_reason', 100)->nullable(); // ¿Por qué razón se cancela el pedido.?
            $table->string('invoice', 100)->nullable(); // NOTA: Factura que se sube a la orden.
            $table->string('method', 50)->nullable(); //Transferencia Bancaria, PayPal, Stripe, Etc.
            $table->timestamps();

            $table->softDeletes();
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