<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $table = 'mgroupMembers';
    protected $primaryKey = 'intGroupMember_ID';

    protected $fillable = [
        'intGroup_ID',
        'intUser_ID',
        'intVotes',
        'boolIsLeader',
        'boolHasVoted',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated'
    ];
}
