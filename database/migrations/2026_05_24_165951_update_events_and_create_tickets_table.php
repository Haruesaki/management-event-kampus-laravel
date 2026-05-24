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
        // 1. Update tabel events
        Schema::table('events', function (Blueprint $table) {
            $table->string('category')->after('title')->nullable();
            $table->string('gates_open')->after('event_date')->nullable();
            $table->string('duration')->after('gates_open')->nullable();
            $table->string('google_maps_url')->after('location')->nullable();
            
            // Jadikan kolom lama nullable karena data pindah ke tabel tiket
            $table->integer('quota')->nullable()->change();
            $table->decimal('ticket_price', 12, 2)->nullable()->change();
        });

        // 2. Buat tabel event_tickets
        Schema::create('event_tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['Gratis', 'Berbayar']);
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('quota');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_tickets');

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['category', 'gates_open', 'duration', 'google_maps_url']);
            $table->integer('quota')->nullable(false)->change();
            $table->decimal('ticket_price', 12, 2)->nullable(false)->change();
        });
    }
};
