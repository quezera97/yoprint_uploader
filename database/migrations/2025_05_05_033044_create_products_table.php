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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('style_no')->nullable();
            $table->string('mainframe_color')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->decimal('price_per_piece', 15, 2)->default(0.00);
            $table->foreignId('upload_file_id')->nullable()->constrained('upload_files')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
