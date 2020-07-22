<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $fillable=['student_id','book_id','mark','description','day','month'];
    public $timestamps=false;
}
