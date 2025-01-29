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
        Schema::create('mgroups', function (Blueprint $table) {
            $table->id('intGroup_ID');
            $table->string('txtGroupName', 100);
            $table->foreignId('intLeader_ID')->nullable(); // Tambahkan nullable terlebih dahulu
            $table->string('txtInsertedBy', 100);
            $table->dateTime('dtmInserted');
            $table->string('txtUpdatedBy', 100)->nullable();
            $table->dateTime('dtmUpdated')->nullable();
            $table->tinyInteger('bitActive')->default(1);
            $table->timestamps();

            $table->foreign('intLeader_ID')->references('intUser_ID')->on('musers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mGroups');
    }
};
