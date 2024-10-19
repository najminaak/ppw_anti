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
        // Membuat tabel categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->string('name', 100); // Kolom name
            $table->timestamps(); // Kolom created_at dan updated_at
        });

        // Membuat tabel articles
        Schema::create('articles', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->string('title', 255); // Kolom title
            $table->text('content'); // Kolom content
            $table->string('author', 100)->nullable(); // Kolom author
            $table->timestamps(); // Kolom created_at dan updated_at
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft'); // Kolom status
            $table->foreignId('category_id')->constrained('categories')->onDelete('set null'); // Kolom category_id sebagai foreign key
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

