<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('user_id');
            $table->string('description');
            $table->string('image');
            $table->string('status');    //active and in active in future
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
