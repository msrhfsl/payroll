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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('userId');
            $table->string('phoneNum');
            $table->string('homeAdd');
            $table->string('gender');
            $table->string('position');
            $table->string('bank');
            $table->string('accNum');
            $table->string('epfNo');
            $table->string('socsoNo');
            $table->string('basicPay');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
