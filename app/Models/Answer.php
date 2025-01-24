<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'mAnswers';

    protected $primaryKey = 'intAnswer_ID';

    protected $fillable = [
        'intQuestion_ID',
        'txtAnswer',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    protected $dates = ['dtmInserted', 'dtmUpdated'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'intQuestion_ID');
    }
}
