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

    protected $table = 'mUsers';

    protected $primaryKey = 'intUser_ID';
    protected $fillable = [
        'intDepartment_ID',
        'txtName',
        'txtEmail',
        'txtNIK',
        'txtPassword',
        'txtGender',
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
}
