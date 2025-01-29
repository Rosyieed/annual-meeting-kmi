<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'mgroups';
    protected $primaryKey = 'intGroup_ID';

    protected $fillable = [
        'txtGroupName',
        'intLeader_ID',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    protected $dates = ['dtmInserted', 'dtmUpdated'];

    public function members()
    {
        return $this->belongsToMany(User::class, 'mgroupmembers', 'intGroup_ID', 'intUser_ID')
            ->withPivot('intVotes', 'boolIsLeader', 'boolHasVoted' , 'txtInsertedBy', 'dtmInserted', 'txtUpdatedBy', 'dtmUpdated')
            ->withTimestamps();
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'intLeader_ID', 'intUser_ID');
    }
}
