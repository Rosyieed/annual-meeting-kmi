<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'mQuestions';

    protected $primaryKey = 'intQuestion_ID';

    protected $fillable = [
        'txtQuestion',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    protected $dates = ['dtmInserted', 'dtmUpdated'];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'intQuestion_ID');
    }
}
