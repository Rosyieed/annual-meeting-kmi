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
        Schema::create('mcountdownteam', function (Blueprint $table) {
            $table->id('intCountdownTeam_ID');
            $table->dateTime('dtmStartTime');
            $table->string('txtInsertedBy');
            $table->dateTime('dtmInserted');
            $table->string('txtUpdatedBy')->nullable();
            $table->dateTime('dtmUpdated')->nullable();
            $table->tinyInteger('bitActive')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcountdownteam');
    }
};
