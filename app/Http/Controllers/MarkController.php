<?php

namespace App\Http\Controllers;

use App\Book;
use App\Course;
use App\Http\Utilitis\StudentFunctions;
use App\Mark;
use App\Student;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();
        $course=Course::orderBy('class_id','desc');
        return view('mark.show_student_mark',compact('course'),compact('books'));

    }
    public function getBookByClassId(Request $request)
    {
        if ($request->ajax()) {
            $books = Book::all();
            $jsonData=array();
            $i=0;

            $courses = Course::where('class_id',$request->classId)->where('team','!=',2)->get();
            if ($courses) {
                foreach ($courses as $course) {
                    $temp=array(
                        'bookId'=>$course->book_id,
                        'bookName'=>$books->find($course->book_id)->name
                    );
                    $jsonData[$i++]=$temp;
                }
                return \Response::json($jsonData);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchStudent(Request $request)
    {
        $students=StudentFunctions::getStudentsNameByClassId($request->class_id);
        $bookId=$request->book_id;
        return view('mark.show_student_mark',compact('students'),compact('bookId'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showMark($studentId,$bookId,$studentName)
    {
        $marks=Mark::where('book_id',$bookId)->where('student_id',$studentId)->get();
        return view('mark.show_mark',compact('marks'),compact('studentName'));
    }

}
