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
            $table->string('Title',255)->nullable();
            $table->string('thumb', 10000)->nullable();
            $table->unsignedBigInteger('cate_id')->nullable();
            $table->foreign('cate_id')->references('id')->on('categories')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->longText('thongsokythuat')->nullable();
            $table->text('price')->nullable();
            $table->text('discount')->nullable();
            $table->string('slug',255)->nullable();   // Link
            $table->binary('active')->nullable();
            $table->binary('ishot')->nullable();
            $table->binary('isnewfeed')->nullable();
            $table->text('Amounts')->nullable();
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
