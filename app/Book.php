<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable=['name','base','expertise','type'];
    public $timestamps=false;
}
