<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'musers';

    protected $primaryKey = 'intUser_ID';
    protected $fillable = [
        'intDepartment_ID',
        'intRole_ID',
        'txtName',
        'txtEmail',
        'txtNIK',
        'txtPassword',
        'txtGender',
        'intProcessStep',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    protected $dates = ['dtmInserted', 'dtmUpdated'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'intDepartment_ID');
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'mgroupMembers', 'intUser_ID', 'intGroup_ID')
            ->withPivot('intVotes', 'boolIsLeader', 'boolHasVoted' , 'txtInsertedBy', 'dtmInserted', 'txtUpdatedBy', 'dtmUpdated')
            ->withTimestamps();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'intRole_ID', 'intRole_ID');
    }
}
