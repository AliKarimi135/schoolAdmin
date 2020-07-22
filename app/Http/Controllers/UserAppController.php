<?php

namespace App\Http\Controllers;




use App\Course;
use App\Mark;
use App\Student;
use App\Teacher;
use App\Team;
use App\UserApp;
use Hekmatinasser\Verta\Verta;

use Illuminate\Http\Request;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserAppController extends Controller
{
    /**
     * UserAppController constructor.
     */
    public function __construct()
    {

        \Config::set('jwt.user', "App\UserApp");
        \Config::set('auth.providers.users.model', \App\UserApp::class);

        $this->middleware('jwt.auth')->except(['registerUserApp','loginUserApp']);
    }

    public function authention()
    {
        if(! JWTAuth::parseToken()->authenticate()){
            return false;
        }
        return true;
    }
    public function authentionTeacher()
    {
        $user = JWTAuth::parseToken()->authenticate();
        if(!$user){
            return false;
        }else if($user->type==0){
            return false;
        }
        return true;

    }

    //register user if nationalCode or personalCode exist in database
    public function registerUserApp(Request $request)
    {
        if($request->type==1){
            $teacher=Teacher::where('personal_code',$request->user_code)->where('active',0)->first();
            if(!isset($teacher)){
                return response()->json(["status"=>404,"message"=>"1"]);
            }else{
                $user=new UserApp;
                $user->create($request->toArray());
                $t=Teacher::find($teacher->id);
                $t->active=1;
                $t->save();

                return response()->json(["status"=>200,"message"=>"3"]);
            }
        }else{
            $student=Student::where('national_code',$request->user_code)->where('active',0)->first();
            if(!isset($student)){
                return response()->json(["status"=>404,"message"=>"2"]);
            }else{
                $user=new UserApp;
                $user->create($request->toArray());
                $st=Student::find($student->id);
                $st->active=1;
                $st->save();
                return response()->json(["status"=>200,"message"=>"3"]);
            }
        }

    }

    public function loginUserApp(Request $request)
    {
        try{

        }catch (\Exception $exception){}

        $credentials=$request->only('user_code','password');

        try{
            $token=JWTAuth::attempt($credentials);

            if(!$token){
                return response()->json(1, 401);
            }else{
                $user=JWTAuth::toUser($token);
                if($user->type==1){
                    $teacher=Teacher::where('personal_code',$request->user_code)->first();
                    $response=array(
                        'id'=>$teacher->id,
                        'name'=>$teacher->name,
                        'type'=>1,
                        'classId'=>0,
                        'token'=>$token
                    );
                }else{
                    $student=Student::where('national_code',$request->user_code)->first();
                    $response=array(
                        'id'=>$student->id,
                        'name'=>$student->name,
                        'type'=>0,
                        'classId'=>$student->class_id,
                        'token'=>$token
                    );
                }

            }
        }catch (JWTException $ex){
            return response()->json(1, 401);
        }
        return response()->json($response);

    }

    public function getCourse(Request $request)
    {

        if(!$this->authention()){
            return response()->json(1,401);
        }
        if($request->type==1){
            $course=Course::where('teacher_id',$request->user_id)->get(['class_id','book_id','team','book_name','class_name']);
        }else{
            //$course=Course::where('class_id',$request->user_id)->where('team',0)->orWhere('team',1)->get(['class_id','book_id','team','book_name','class_name']);
            $course=Course::where('class_id',$request->user_id)->where('team','!=',2)->get(['class_id','book_id','team','book_name','class_name']);
        }
        return response()->json($course);
    }

    public function getStudents(Request $request)
    {

        if(!$this->authention()){
            return response()->json(1,401);
        }
        $response=array();
        if($request->group_id==0){
            $response=Student::where('class_id',$request->class_id)->get(['id','name']);
        }else{
            $team=Team::where('book_id',$request->book_id)->where('class_id',$request->class_id)->
            where('team',$request->group_id)->get(['student_id']);

            if($team!=null){
                $i=0;

                foreach ($team as $item){
                    $st=Student::find($item->student_id);
                    $temp=array(
                        'id'=>$st->id,
                        'name'=>$st->name);
                    $response[$i++]=$temp;
                }
            }
        }
        return response()->json($response);

    }

    public function getMarks(Request $request)
    {
        if(!$this->authention()){
            return response()->json(1,401);
        }
        //->orderBy('month','desc')->orderBy('day','desc')
        $marks=Mark::where('book_id',$request->book_id)->where('student_id',$request->student_id)->get(['id','mark','description','day','month']);
        return response()->json($marks);
    }

    public function setMark(Request $request)
    {
        if(!$this->authentionTeacher()){
            return response()->json(1,401);
        }
        $mark=new Mark();
        $date=verta();
        $day=$date->day;
        $month=$date->month;
        $m=$mark->create([
            "student_id"=>$request->student_id,
            "book_id"=>$request->book_id,
            "mark"=>$request->mark,
            "description"=>$request->description,
            "day"=>$day,
            "month"=>$month
        ]);
        $response=array(
            "id"=>$m->id,
            "month"=>$month,
            "day"=>$day
        );
        //$marks=Mark::where('book_id',$request->book_id)->where('student_id',$request->student_id)->get(['id','mark','description','day','month']);
        //return response()->json($marks, 200);
        return response()->json($response);
    }

    public function updateMark(Request $request,$id)
    {
        if(!$this->authentionTeacher()){
            return response()->json(1,401);
        }
        $mark=Mark::find($id);
        $mark->mark=$request->mark;
        $mark->description=$request->description;
        $mark->save();
        return response()->json(1);
    }


    public function destroyMark($id )
    {
        if(!$this->authentionTeacher()){
            return response()->json(1,401);
        }
        Mark::find($id)->delete();
        return response()->json(1);
    }
}
