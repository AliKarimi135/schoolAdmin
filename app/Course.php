<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=['teacher_id','book_id','class_id','team','class_name','book_name'];
    public $timestamps=false;
}
