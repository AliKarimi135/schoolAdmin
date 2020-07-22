<?php

namespace App\Http\Controllers;

use App\Http\Utilitis\TeacherFunctions;
use App\Teacher;
use Illuminate\Http\Request;
use Validator;

class TeacherController extends Controller
{
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|string|max:50 ',
            'expertise' => 'required|string|max:50',
            'personal_code' => 'required|string|max:14|unique:teachers'
        ];
        $message = [
            'required' => 'پر نمودن این فیلد اجباری است',
            'max' => 'طول عبارت شما خیلی بزرگ است',
            'unique' => 'کد پرسنلی قبلا ثبت شده و تکراری است'
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
        $teachers=TeacherFunctions::allTeachers();
        return view('teachers.show_teachers',compact('teachers'));
    }
    public function search(Request $request,$id)
    {
        if(!strcmp($request->expertise,null))
            return redirect()->route('teachers.index');

        return redirect()->route('teachers.result.search',[1,$request->expertise]);
    }

    public function resultSearch($id,$expertise)
    {
        $teachers=TeacherFunctions::searchTeacher($expertise);

        return view('teachers.show_teachers',compact('teachers'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.add_teacher');
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
        $teacher=new Teacher;
        $teacher->create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher=Teacher::find($id);

        return view('teachers.show_teacher',compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers=Teacher::find($id);
        return view('teachers.add_teacher',compact('teachers'));
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
        Teacher::find($id)->update($request->toArray());
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
        Teacher::find($id)->delete();
        return back();
    }
}
