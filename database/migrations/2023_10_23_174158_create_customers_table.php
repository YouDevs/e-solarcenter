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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('company_name')->nullable();
            $table->string('netsuite_key')->nullable();
            $table->string('rfc');
            $table->string('delivery_address_1')->nullable();
            $table->string('delivery_address_2')->nullable();
            $table->string('delivery_address_3')->nullable();
            $table->boolean('default_address')->default(0);
            $table->enum('status', ['active', 'pending', 'inactive'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
