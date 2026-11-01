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
        Schema::create('iurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("p_id")->nullable();
            $table->string("tahun");
            $table->date("tanggal");
            $table->integer("nominal");
            $table->string("payment");
            $table->string("status");
            $table->timestamps();

            $table->foreign("p_id")->references("p_id")->on("penduduks")->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iurans');
    }
};
