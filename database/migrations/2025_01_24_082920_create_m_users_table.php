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
        Schema::create('mUsers', function (Blueprint $table) {
            $table->id('intUser_ID');
            $table->foreignId('intDepartment_ID')->constrained('mDepartments', 'intDepartment_ID');
            $table->string('txtName', 100);
            $table->string('txtEmail', 100)->unique();
            $table->string('txtNIK', 100)->unique();
            $table->string('txtPassword', 100);
            $table->enum('txtGender', ['L', 'P']);
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
        Schema::dropIfExists('mUsers');
    }
};
