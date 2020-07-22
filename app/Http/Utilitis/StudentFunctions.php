<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 1/10/19
 * Time: 11:22 AM
 */

namespace App\Http\Utilitis;


use App\Student;

class StudentFunctions
{
    public static function  allStudents(){
       // return  Student::sortBy('class_id',SORT_REGULAR,true)->simplePaginate(30);
        return  Student::orderBy('class_id','desc')->simplePaginate(30);
    }
    public static function getStudentsByClassId($classId)
    {
        return Student::where('class_id',$classId)->orderBy('name', 'asc')->simplePaginate(32);
    }

    public static function allStudentId($classId)
    {
        return Student::where('class_id',$classId)->get(['id']);
    }
    public static function getStudentsNameByClassId($classId)
    {
        return Student::where('class_id',$classId)->get(['id','name']);
    }
}