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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelapor')->constrained('users')->onDelete('cascade');
            $table->foreignId('pekerja')->nullable()->constrained('users')->onDelete('cascade');
            $table->text('laporan');
            $table->foreignId('jenis_aduans_id')->constrained('jenis_aduans')->onDelete('cascade');
            $table->string('foto');
            $table->enum('status', ['open', 'pending', 'in progress', 'completed'])->default('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
