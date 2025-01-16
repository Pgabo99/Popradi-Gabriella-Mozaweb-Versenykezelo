<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rounds extends Model
{
    //Columns
    protected $fillable = [
        'id',
        'round_name',
        'description',
        'comp_name',
        'comp_year',
        'questions_number',
        'correct_point',
        'wrong_point',
        'blank_point',
        'round_start',
        'round_end'
    ];

    //Disabling the created_at, updated_at

    public $timestamps = false;

}
