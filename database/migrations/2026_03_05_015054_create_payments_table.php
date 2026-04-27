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
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('registration_id')->constrained('registrations')->onDelete('cascade');
        $table->decimal('amount', 12, 2);
        $table->enum('payment_status', ['Pending', 'Success', 'Rejected'])->default('Pending');
        $table->string('payment_method')->nullable();
        $table->timestamp('expired_at')->nullable(); // Batas waktu 5 menit
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
