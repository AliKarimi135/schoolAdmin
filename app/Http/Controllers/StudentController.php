<?php

namespace App\Http\Controllers;

use App\Http\Utilitis\ClassRoomFunctions;
use App\Http\Utilitis\StudentFunctions;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Validator;

class StudentController extends Controller
{
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|string|max:50 ',
            'national_code' => 'required|string|max:14|unique:students'
        ];
        $message = [
            'required' => 'پر نمودن این فیلد اجباری است',
            'max' => 'طول عبارت شما خیلی بزرگ است',
            'unique'=>'کد ملی قبلا ثبت شده و تکراری است'
        ];
        return Validator::make($data, $rules, $message);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classRoom=ClassRoomFunctions::allClassRoom();
        $students=StudentFunctions::allStudents();
        return view('students.show_student',compact('students'),compact('classRoom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classRoom=ClassRoomFunctions::allClassRoom();
        return view('students.add_student',compact('classRoom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->toArray())->validate();
        $student=new Student();
        $student->create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request,$id)
    {
        return redirect()->route('student.result.search',[1,$request->class_id]);
    }

    public function resultSearch($id,$classId)
    {
        $classRoom=ClassRoomFunctions::allClassRoom();
        $students=StudentFunctions::getStudentsByClassId($classId);
        return view('students.show_student',compact('students'),compact('classRoom'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students=Student::find($id);
        $classRoom=ClassRoomFunctions::allClassRoom();
        return view('students.add_student',compact('classRoom'),compact('students'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validator($request->toArray())->validate();
        Student::find($id)->update($request->toArray());
        return redirect($request->pre_page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::find($id)->delete();
        return back();
    }
}
