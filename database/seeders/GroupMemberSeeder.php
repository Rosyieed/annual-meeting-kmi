<?php

namespace Database\Seeders;

use App\Models\GroupMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GroupMember::create([
            'intGroup_ID' => 1,
            'intUser_ID' => 1,
            'intVotes' => 0,
            'boolIsLeader' => true,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 1,
            'intUser_ID' => 2,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 1,
            'intUser_ID' => 3,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 1,
            'intUser_ID' => 4,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 1,
            'intUser_ID' => 5,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 2,
            'intUser_ID' => 6,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 2,
            'intUser_ID' => 7,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 2,
            'intUser_ID' => 8,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 2,
            'intUser_ID' => 9,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);

        GroupMember::create([
            'intGroup_ID' => 2,
            'intUser_ID' => 10,
            'intVotes' => 0,
            'boolIsLeader' => false,
            'boolHasVoted' => false,
            'txtInsertedBy' => 'Seeder',
            'dtmInserted' => now(),
            'txtUpdatedBy' => 'Seeder',
            'dtmUpdated' => now(),
        ]);
    }
}
