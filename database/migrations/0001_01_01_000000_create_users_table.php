<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        // Set default role ke ID 3 (Asumsi ID 3 adalah 'Peserta')
        $table->foreignId('role_id')->default(3)->constrained('roles')->onDelete('restrict');
        $table->string('name');
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->boolean('is_active')->default(true); // Untuk fitur nonaktifkan akun
        $table->rememberToken();
        $table->timestamps();
        $table->softDeletes(); // Menambahkan kolom deleted_at untuk penghapusan via Excel
    });
    // ... (biarkan tabel password_reset_tokens & sessions bawaan Laravel)
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
