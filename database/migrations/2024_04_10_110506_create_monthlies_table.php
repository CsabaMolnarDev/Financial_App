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
        Schema::create('monthlies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('finance_id');
            $table->integer("year");
            $table->integer("month");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('finance_id')->references('id')->on('finances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthlies');
    }
};
