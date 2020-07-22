<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mark;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$marks=Mark::where('book_id',5)->where('student_id',9)->orderBy('month','desc')->orderBy('day','desc')->get(['id','mark','description','day','month']);
        return response()->json($marks);*/
        return view('home');
    }


}
