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
        Schema::create('admin_accepts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisementID');
            $table->foreign('advertisementID')->references('id')->on('advertisements');
            $table->string('accepted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_accepts');
    }
};
