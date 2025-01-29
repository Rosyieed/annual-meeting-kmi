<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'mdepartments';

    protected $primaryKey = 'intDepartment_ID';

    protected $fillable = [
        'txtDepartment',
        'txtShortName',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    protected $dates = ['dtmInserted', 'dtmUpdated'];

    public function users()
    {
        return $this->hasMany(User::class, 'intDepartment_ID');
    }
}
