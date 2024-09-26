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
        Schema::create('bill_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->unsignedBigInteger('item_in_id')->nullable();
            $table->foreign('item_in_id')->references('id')->on('item_ins')->onDelete('cascade')->nullable();
            $table->string('product')->nullable();
            $table->string('rate');
            $table->string('quantity');
            $table->unsignedBigInteger('extra_charge_id')->nullable();
            $table->foreign('extra_charge_id')->references('id')->on('extra_charges')->onDelete('cascade');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('Cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_products');
    }
};
