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
        Schema::create('trGeetingCommitments', function (Blueprint $table) {
            $table->id('intGeeting_ID');
            $table->unsignedBigInteger('intUser_ID');
            $table->string('txtPhoto', 255);
            $table->string('txtCommitment', 255);
            $table->dateTime('dtmInserted');
            $table->string('txtInsertedBy', 100);
            $table->dateTime('dtmUpdated')->nullable();
            $table->string('txtUpdatedBy', 100)->nullable();
            $table->tinyInteger('bitActive')->default(1);
            $table->timestamps();

            // Foreign Key
            $table->foreign('intUser_ID')->references('intUser_ID')->on('musers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trGeetingCommitments');
    }
};
