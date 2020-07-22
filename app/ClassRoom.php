<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable=['name','base','expertise'];
    public $timestamps=false;
}
