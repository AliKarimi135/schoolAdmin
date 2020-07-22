<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['name','national_code','class_id','active'];
    public $timestamps=false;

}
