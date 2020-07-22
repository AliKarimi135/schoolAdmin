<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable=['name','personal_code','degree','expertise','active'];
    public $timestamps=false;
}
