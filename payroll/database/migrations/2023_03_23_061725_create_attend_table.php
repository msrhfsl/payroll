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
        Schema::create('attend', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('staffID');
            $table->dateTime('timein');
            $table->dateTime('timeout');
            $table->string('attendStatus');
            $table->date('attendDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attend');
    }
};
