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
        Schema::create('mgroupmembers', function (Blueprint $table) {
            $table->id('intGroupMember_ID');
            $table->foreignId('intGroup_ID')->constrained('mgroups', 'intGroup_ID');
            $table->foreignId('intUser_ID')->constrained('musers', 'intUser_ID');
            $table->unsignedBigInteger('intVotes')->default(0);
            $table->boolean('boolIsLeader')->default(0);
            $table->boolean('boolHasVoted')->default(0);
            $table->string('txtInsertedBy', 100);
            $table->dateTime('dtmInserted');
            $table->string('txtUpdatedBy', 100)->nullable();
            $table->dateTime('dtmUpdated')->nullable();
            $table->timestamps();

            // Unique constraint untuk mencegah duplikasi anggota dalam grup
            $table->unique(['intGroup_ID', 'intUser_ID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mgroupmembers');
    }
};
