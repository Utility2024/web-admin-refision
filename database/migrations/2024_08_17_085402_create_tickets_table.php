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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique(); // Nomor tiket unik
            $table->string('title'); // Judul tiket
            $table->text('description'); // Deskripsi tiket
            $table->enum('status', ['open', 'in progress', 'closed'])->default('open'); // Status tiket
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('low'); // Prioritas tiket
            $table->foreignId('category_id')->constrained('category_tickets')->onDelete('cascade'); // Relasi ke tabel category_tickets
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke tabel users (user yang membuat tiket)
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null'); // Relasi ke tabel users (assigned user)
            $table->timestamp('closed_at')->nullable(); // Tanggal tiket ditutup
            $table->timestamps(); // Tanggal created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
