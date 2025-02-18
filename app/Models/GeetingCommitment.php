<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeetingCommitment extends Model
{
    use HasFactory;

    protected $table = 'trgeetingcommitments';

    protected $primaryKey = 'intGeeting_ID';

    protected $fillable = [
        'intUser_ID',
        'txtPhoto',
        'txtCommitment',
        'dtmInserted',
        'txtInsertedBy',
        'dtmUpdated',
        'txtUpdatedBy',
        'bitActive',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'intUser_ID', 'intUser_ID');
    }
}
