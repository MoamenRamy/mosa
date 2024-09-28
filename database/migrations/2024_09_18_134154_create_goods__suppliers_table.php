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
        Schema::create('goods__suppliers', function (Blueprint $table) {
            // this table show who supplies what
            $table->id();
            $table->unsignedBigInteger('goods_id');
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();

            $table->foreign('goods_id')->references('id')->on('goods');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods__suppliers');
    }
};
