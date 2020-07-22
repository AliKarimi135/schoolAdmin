<?php

namespace App\Http\Controllers;

use App\Book;
use App\ClassRoom;
use App\Course;
use App\Http\Utilitis\StudentFunctions;
use App\Teacher;
use App\Team;
use Illuminate\Http\Request;
use Validator;
use Zend\Diactoros\Response\JsonResponse;

class CourseController extends Controller
{
    protected function validator(array $data)
    {
        $rules = [
            'book_id' => 'required',
        ];
        $message = [
            'required' => 'پر نمودن این فیلد اجباری است',
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
        $books=Book::all();
        $course=Course::orderBy('class_id','desc')->simplePaginate(30);
        return view('course.show_course',compact('course'),compact('books'));

    }

    public function searchCourse(Request $request)
    {
        $books=Book::all();
        $course=Course::where('teacher_id',$request->teacher_id)->simplePaginate(30);
        return view('course.show_course',compact('course'),compact('books'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('course.add_course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * aghe book teory bood neyaz be team nadarim
         * faghad dafe aval ghroh bandi mikonim
         */
        $this->validator($request->toArray())->validate();
        $bookType=Book::find($request->book_id)->type;
        $team=1;
        if($bookType==1){
            $request->team=0;
            Course::create([
                'class_id'=>$request->class_id,
                'teacher_id'=>$request->teacher_id,
                'book_id'=>$request->book_id,
                'team'=>0,
                'book_name'=>Book::find($request->book_id)->name,
                'class_name'=>ClassRoom::find($request->class_id)->name
            ]);
            return back();
        }

        $status_team=Team::where('book_id',$request->book_id)->where('class_id',$request->class_id)->get();

        if($status_team->isEmpty()){
            $studentsId=StudentFunctions::allStudentId($request->class_id);
            foreach ($studentsId as $studentId){
                Team::create([
                    'book_id'=>$request->book_id,
                    'student_id'=>$studentId->id,
                    'team'=>1,
                    'class_id'=>$request->class_id
                  ]);
            }
        }else{
            $team=2;
        }


        Course::create([
            'class_id'=>$request->class_id,
            'teacher_id'=>$request->teacher_id,
            'book_id'=>$request->book_id,
            'team'=>$team,
            'book_name'=>Book::find($request->book_id)->name,
            'class_name'=>ClassRoom::find($request->class_id)->name
        ]);
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
        $course=Course::find($id);
        $book=Book::find($course->book_id);

        return view('course.add_course',compact('book'),compact('course'));

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
        Course::find($id)->update([
            'class_id'=>$request->class_id,
            'teacher_id'=>$request->teacher_id,
            'book_id'=>$request->book_id
        ]);
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
        $course=Course::find($id);
        if($course->team==0 || $course->team==2){
            $course->delete();
            return back();
        }else if ($course->team==1){
            $course2 = Course::where('class_id','=',$course->class_id)->
                                where('book_id','=',$course->book_id)->get();
            if(!isEmpty($course2)) {
                $course2->team = 1;
                $course2->save();
            }
            $course->delete();
            return back();
        }
    }

    public function showTeam()
    {
        $books=Book::all();
        $course=Course::orderBy('class_id','desc')->simplePaginate(30);
        return view('course.show_team',compact('course'),compact('books'));

    }

    public function getCourseByclassId(Request $request)
    {
    if ($request->ajax()) {
            $books = Book::all();
            $jsonData=array();
             $i=0;
            $courses = Course::where('class_id','=',(int)$request->classId)->where('team', '=', 2)->get();
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

    public function getTeam(Request $request)
    {
        if($request->book_id==0)
            return redirect()->route('showTeam');
        $students=StudentFunctions::getStudentsNameByClassId($request->class_id);
        $team=Team::where('book_id',$request->book_id)->where('class_id',$request->class_id)->orderBy('team','asc')->get();
        $teachersId=Course::where('book_id',$request->book_id)->where('class_id',$request->class_id)->orderBy('team','asc')->get(['teacher_id','team','class_name'])->toArray();

        $teachers2 = Teacher::whereIn('id',[$teachersId[0]['teacher_id'],$teachersId[1]['teacher_id']])->get(['id','name', 'expertise'])->toArray();
        if($teachersId[0]['teacher_id']===$teachers2[0]['id']) {
            $teachers[0] = array('name' => $teachers2[0]['name'], 'expertise' => $teachers2[0]['expertise']);
            $teachers[1] = array('name' => $teachers2[1]['name'], 'expertise' => $teachers2[1]['expertise']);
        }else {
            $teachers[0] = array('name' => $teachers2[1]['name'], 'expertise' => $teachers2[1]['expertise']);
            $teachers[1] = array('name' => $teachers2[0]['name'], 'expertise' => $teachers2[0]['expertise']);
        }
        $teachers[2] = array('name' =>$teachersId[0]['class_name']);
        $teamJson=array();
        $i=0;
        foreach ($team as $t){
            $group1=($t->team===1 ? 'اول':'دوم');
            $temp=array(
                'id'=>$t->id,
                'name'=>$students->find($t->student_id)->name,
                'team'=>$group1
            );
            $teamJson[$i++]=$temp;
        }
        return view('course.show_team',compact('teamJson'),compact('teachers'));
}

    public function setTeam(Request $request)
    {
        if ($request->ajax()) {
            $team=Team::find($request->teamId);
            if($team->team==1)
                $t2=2;
            else
                $t2=1;
            $team->team=$t2;
            $team->save();
            //$team->update(['teams.team'=>(int)$t2]);
            return Response(($t2===1 ? 'اول':'دوم'));
        }
    }
}
