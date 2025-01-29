<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'truseranswers';

    protected $primaryKey = 'intUserAnswer_ID';

    protected $fillable = [
        'intUser_ID',
        'intQuestion_ID',
        'intAnswer_ID',
        'txtInsertedBy',
        'dtmInserted',
        'txtUpdatedBy',
        'dtmUpdated',
        'bitActive'
    ];

    protected $dates = ['dtmInserted', 'dtmUpdated'];

    public function user()
    {
        return $this->belongsTo(User::class, 'intUser_ID');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'intQuestion_ID');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'intAnswer_ID');
    }
}
