<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable=['student_id','book_id','team','class_id'];
    public $timestamps=false;
}
