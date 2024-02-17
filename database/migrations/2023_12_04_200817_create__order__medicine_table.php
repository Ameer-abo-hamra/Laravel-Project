<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('_order__medicine', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->references("id")->on("orders");
            $table->foreignId("medicine_id")->references("id")->on("medicines")->onDelete("cascade");
            $table->unsignedFloat("price");
            $table->unsignedInteger("amount");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_order__medicine');
    }
};
