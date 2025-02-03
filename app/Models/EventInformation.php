<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventInformation extends Model
{
    use HasFactory;

    protected $table = 'meventinformation';

    protected $primaryKey = 'intEventInformation_ID';

    protected $fillable = [
        'txtModalTitle',
        'txtModalContent',
        'txtModalImagePath',
        'txtModalLink',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive',
    ];
}
