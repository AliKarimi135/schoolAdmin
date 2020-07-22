<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 1/9/19
 * Time: 8:32 PM
 */

namespace App\Http\Utilitis;


use App\Teacher;

class TeacherFunctions
{
    public static function  allTeachers(){
        return  Teacher::orderBy('degree', 'asc')->simplePaginate(30);
    }

    public static function searchTeacher($expertise)
    {
        return Teacher::where('expertise','LIKE',$expertise)->orderBy('degree', 'asc')->simplePaginate(30);
    }


}