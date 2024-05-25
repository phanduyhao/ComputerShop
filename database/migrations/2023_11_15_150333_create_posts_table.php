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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('Title',255)->nullable();
            $table->string('slug',255)->nullable();   // Link
            $table->longText('thumb')->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->binary('active')->nullable();
            $table->binary('ishot')->nullable();
            $table->binary('isnewfeed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
