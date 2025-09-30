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
        Schema::create('collection_post', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Collection::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(\App\Models\Post::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_post');
    }
};
