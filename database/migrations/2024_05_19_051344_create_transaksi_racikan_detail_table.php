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
        Schema::create('transaksi_racikan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi')->nullable();
            $table->foreign('no_transaksi')->references('no_transaksi')->on('transaksi_racik');
            $table->string('nama_obat');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_racikan_detail');
    }
};
