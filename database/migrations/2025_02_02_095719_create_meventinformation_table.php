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
        Schema::create('meventinformation', function (Blueprint $table) {
            $table->id('intEventInformation_ID');
            $table->string('txtModalTitle', 255);
            $table->string('txtModalContent', 255)->nullable();
            $table->string('txtModalImagePath', 255)->nullable();
            $table->string('txtModalLink', 255)->nullable();
            $table->string('txtInsertedBy', 255);
            $table->dateTime('dtmInserted');
            $table->string('txtUpdatedBy')->nullable();
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
        Schema::dropIfExists('meventinformation');
    }
};
