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
   Schema::create('product_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
        $table->enum('action', ['created', 'updated', 'deleted']);
        $table->unsignedBigInteger('changed_by')->nullable(); // admin user id
        $table->json('changes')->nullable(); // old vs new values
        $table->string('name')->nullable();   // snapshot of product name
        $table->string('image')->nullable();  // snapshot of product image
        $table->decimal('price', 10, 2)->nullable(); // snapshot of product price
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_logs');
    }
};
