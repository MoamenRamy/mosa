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
        Schema::create('supplier_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_order_id');
            $table->unsignedBigInteger('goods_id')->nullable();
            $table->decimal('price', 14, 2);
            $table->decimal('count', 14, 2);
            $table->decimal('total', 14, 2)->default(0);
            $table->timestamps();

            $table->foreign('supplier_order_id')->references('id')->on('supplier_orders')->onDelete('cascade');
            $table->foreign('goods_id')->references('id')->on('goods')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_order_items');
    }
};
