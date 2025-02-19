<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeetingButton extends Model
{
    use HasFactory;

    protected $table = 'mgeetingbuttoncountdown';

    protected $primaryKey = 'intButtonCountdown_ID';

    protected $fillable = [
        'dtmButtonShow',
        'dtmInserted',
        'txtInsertedBy',
        'dtmUpdated',
        'txtUpdatedBy',
        'bitActive',
    ];
}
