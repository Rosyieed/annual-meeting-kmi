<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'mRoles';
    protected $primaryKey = 'intRole_ID';
    protected $fillable = [
        'txtRole',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'intRole_ID', 'intRole_ID');
    }
}
