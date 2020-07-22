<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 1/9/19
 * Time: 3:07 PM
 */

namespace App\Http\Utilitis;



use App\ClassRoom;

class ClassRoomFunctions
{
    public static function  allClassRoom(){
        return  ClassRoom::orderBy('expertise', 'asc')->simplePaginate(30);
    }

    public static function getExpertises()
    {
        return ClassRoom::distinct()->get(['expertise']);
    }


}