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
        Schema::create('obatalkes_m', function (Blueprint $table) {
            $table->integer('obatalkes_id', true);
            $table->string('obatalkes_kode', 100)->nullable();
            $table->string('obatalkes_nama', 250)->nullable();
            $table->decimal('stok', 15)->nullable();
            $table->text('additional_data')->nullable();
            $table->dateTime('created_date')->useCurrent();
            $table->integer('created_by')->nullable();
            $table->integer('modified_count')->nullable();
            $table->dateTime('last_modified_date')->nullable();
            $table->integer('last_modified_by')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_active')->default(true);
            $table->dateTime('deleted_date')->nullable();
            $table->integer('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obatalkes_m');
    }
};
