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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("pharmacist_id")->references("id")->on("pharmacists");
            // $table->foreignId("medicine_id")->references("id")->on("medicines");
            // $table->string("s_name");
            // $table->unsignedInteger("amount")->default(0);
            // $table->unsignedDouble("price");
            $table->timestamps();
            $table->string("state")->default("قيد المعالجة");
            $table->string("payed")->default('لم يتم الدفع بعد ');
            $table->boolean("isStateModified")->default(0);
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
