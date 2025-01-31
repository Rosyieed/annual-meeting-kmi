<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountdownTeam extends Model
{
    use HasFactory;

    protected $table = 'mcountdownteam';
    protected $primaryKey = 'intCountdownTeam_ID';
    protected $fillable = [
        'dtmStartTime',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive',
    ];

    public $timestamps = false;
}
