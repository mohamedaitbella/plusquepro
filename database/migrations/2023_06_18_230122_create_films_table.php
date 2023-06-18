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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->boolean('adult')->default(false);
            $table->string('backdrop_path')->nullable();
            $table->string('title')->nullable();
            $table->string('original_language')->nullable();
            $table->string('original_title');
            $table->text('overview')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('media_type')->nullable();
            $table->decimal('popularity', 8, 2)->nullable();
            $table->date('release_date')->nullable();
            $table->boolean('video')->default(false)->nullable();
            $table->decimal('vote_average', 5, 3)->nullable();
            $table->unsignedInteger('vote_count')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
