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
       Schema::table('product_logs', function (Blueprint $table) {
            $table->string('sale', 255)->nullable()->after('price');
            // Replace 'existing_column_name' with the column after which you want to add this
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_logs', function (Blueprint $table) {
            //
        });
    }
};
