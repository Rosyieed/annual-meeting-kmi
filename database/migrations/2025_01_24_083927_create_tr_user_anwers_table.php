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
        Schema::create('truseranswers', function (Blueprint $table) {
            $table->id('intUserAnswer_ID');
            $table->foreignId('intUser_ID')->constrained('musers', 'intUser_ID');
            $table->foreignId('intQuestion_ID')->constrained('mquestions', 'intQuestion_ID');
            $table->foreignId('intAnswer_ID')->constrained('manswers', 'intAnswer_ID');
            $table->string('txtInsertedBy', 100);
            $table->dateTime('dtmInserted');
            $table->string('txtUpdatedBy', 100)->nullable();
            $table->dateTime('dtmUpdated')->nullable();
            $table->tinyInteger('bitActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truseranswers');
    }
};
