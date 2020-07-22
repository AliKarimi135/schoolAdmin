<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 1/8/19
 * Time: 7:11 PM
 */

namespace App\Http\Utilitis;


use App\Book;

class BookFuctions
{

    public static function  allBooks(){
        return  Book::orderBy('base', 'asc')->simplePaginate(20);
    }


    public static function searchBooks($type,$base,$expertise)
    {
         $result=strcmp($expertise,'هردو');
         $result2=strcmp($expertise,'عمومی');

        if($result2==0){
            $books = Book::where('base',$base)->
                where('expertise','LIKE',$expertise)->simplePaginate(24);
            return $books;
        }


        if($type==3 and $result!=0){
            $books = Book::where('base',$base)
                ->where('expertise','LIKE',$expertise)->simplePaginate(24);
            return $books;
        }else if($type==3){
            $books = Book::where('base',$base)->simplePaginate(24);
            return $books;
        }else if($type!=3 and $result!=0){
            $books = Book::where('base',$base)->where('type',$type)
                ->where('expertise','LIKE',$expertise)->simplePaginate(24);
            return $books;
        }else if($type!=3) {
            $books = Book::where('base',$base)->where('type',$type)->simplePaginate(24);
            return $books;
        }


    }


}