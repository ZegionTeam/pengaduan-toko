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
        Schema::create('follow_up_laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporans_id')->constrained('laporans')->onDelete('cascade');
            $table->enum('before', ['open', 'pending', 'in progress', 'completed']);
            $table->enum('after', ['open', 'pending', 'in progress', 'completed']);
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follow_up_laporans');
    }
};
