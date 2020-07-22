<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\Http\Utilitis\ClassRoomFunctions;
use Illuminate\Http\Request;
use Validator;
class ClassRoomController extends Controller
{
    protected function validator(array $data)
    {
        $rules = [
            'name' => 'required|string|max:50 ',
            'expertise' => 'required|string|max:50'
        ];
        $message = [
            'required' => 'پر نمودن این فیلد اجباری است',
            'max' => 'طول عبارت شما خیلی بزرگ است',
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
        $classroom=ClassRoomFunctions::allClassRoom();
        return view('classroom.show_classroom',compact('classroom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.add_classroom');
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
        $classroom=new ClassRoom;
        $classroom->create($request->all());
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom=ClassRoom::find($id);
        return view('classroom.add_classroom',compact('classroom'));
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
        ClassRoom::find($id)->update($request->toArray());
        /*$classroom=ClassRoom::find($id);
        $classroom->name=$request->name;
        $classroom->base=$request->base;
        $classroom->expertise=$request->expertise;
        $classroom->save();*/
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
        $classroom=ClassRoom::find($id);
        $classroom->delete();
        return back();
    }
}
