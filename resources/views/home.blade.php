@extends('layouts.app')

@section('content')
<div class="container_home">

    <div class="row">
        <div class="col-md-3">
            <div class="card" >
                <div class="card-header">مدیریت</div>
                <div class="card-body " >

                    <button class="dropdown-btn list_sidebar">کلاس
                    </button>
                    <ul class="dropdown-container">
                        <li><a href="{{route('classroom.create')}}">افزودن کلاس</a></li>
                        <li><a href="{{route('classroom.index')}}">لیست کلاس ها</a></li>
                    </ul>

                    <button class="dropdown-btn list_sidebar" >کتاب
                    </button>

                    <ul class=" dropdown-container ">
                       <li> <a href="{{route('book.create')}}">افزودن کتاب</a></li>
                        <li> <a href="{{route('book.index')}}">لیست کتاب ها</a></li>
                    </ul>


                    <button class="dropdown-btn list_sidebar">دانش آموز
                    </button>
                    <ul class="dropdown-container">
                        <li> <a href="{{route('student.create')}}">افزودن دانش آموز</a></li>
                        <li><a href="{{route('student.index')}}">لیست دانش آموزان</a></li>
                    </ul>



                    <button class="dropdown-btn list_sidebar">دبیر
                    </button>
                    <ul class="dropdown-container">
                        <li><a href="{{route('teachers.create')}}">افزودن دبیر</a></li>
                        <li><a href="{{route('teachers.index')}}">لیست دبیران</a></li>
                    </ul>


                    <button class="dropdown-btn list_sidebar" >تدریس
                    </button>
                    <ul class="dropdown-container">
                        <li> <a href="{{route('course.create')}}">افزودن تدریس</a></li>
                        <li><a href="{{route('course.index')}}">لیست تدریس</a></li>
                    </ul>

                    <ul  style="padding: 0; margin: 0;"><li class="list_sidebar"><a href="{{route('showTeam')}}">گروه های تدریس</a></li></ul>
                    <ul style="border-bottom: solid;  border-color: #cdcdcd; padding: 0; margin: 0;"> <li class="list_sidebar"><a href="{{route('mark.index')}}">لیست نمرات</a></li></ul>

                    </div>
                    
                </div>


      </div>

    <div class="col-md-9">
        <div class="row col-md-12">
        <div class="col-md-12" style="margin-bottom: 1em;">
        @yield('search')
        </div>

    <div class="col-md-12" >
        <div class="card">
            <div class="card-header"> {{ isset($title2) ? $title2 : 'خانه' }}</div>
                <div class="card-body">
                    @yield('main_content')
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>

@endsection
