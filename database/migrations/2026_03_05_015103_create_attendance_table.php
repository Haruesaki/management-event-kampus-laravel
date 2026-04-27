<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(){
    Schema::create('attendance', function (Blueprint $table) {
        $table->id();
        $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
        $table->enum('status_kehadiran', ['Hadir', 'Tidak Hadir'])->default('Tidak Hadir');
        $table->timestamp('waktu_kehadiran')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
