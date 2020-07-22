php<?php use App\ClassRoom;use App\Teacher;$title2="لیست تدریس ";?>
<?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
    6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");
$classRoom=ClassRoom::all();
$teachers=Teacher::all();
?>
@extends('home')
@section('search')
    <div class="card ">
        <div class="card-header">جست جوی تدریس </div>
        <div class="card-body ">
            <form role="form" method="post" action="{{route('searchCourse')}}">
                {!! csrf_field() !!}
                <div class="form-group row">
                    <label for="teacher_id" class="col-md-2 col-form-label text-md-left">{{ __('دبیر') }}</label>
                    <div class="col-md-6 ">
                        <select name="teacher_id" class="form-control">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">
                                    {{$teacher->name." رشته ".$teacher->expertise}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">جست جو</button>
                        <a class="btn btn-primary" href="{{route('course.index')}}">بازگشت</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('main_content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>کتاب</th>
            <th>رشته</th>
            <th>دبیر</th>
            <th>کلاس</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($course as $courseItem)
            <?php   $id=$courseItem->id;
                    $classItem=$classRoom->find($courseItem->class_id);?>
        <tr>
            <td>{{$books->find($courseItem->book_id)->name}}</td>
            <td>{{$books->find($courseItem->book_id)->expertise}}</td>
            <td><a href="{{route('teachers.show',$teachers->find($courseItem->teacher_id)->id) }}">{{"آقای ". $teachers->find($courseItem->teacher_id)->name}}</a></td>
            <td>{{$base[$classItem->base]." ".$classItem->expertise." کلاس ".$classItem->name}}</td>
            <td><a href="{{route('course.edit',$id)}}">
                <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a  href="{{ route('course.destroy',$id)}}"
                   onclick="event.preventDefault();
                        document.getElementById('delete-form-{{$id}}').submit();">
                    <span class="glyphicon glyphicon-remove"></span></a>
                <form id="delete-form-{{$id}}" action="{{route('course.destroy',$id)}}" method="POST" style="display: none;">
                    {!! csrf_field() !!}
                    {!! method_field("DELETE") !!}
                </form>

            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
    <div class="container ">
    <div class="row align-items-center justify-content-center col-sm-10">
        {!! $course->render() !!}
    </div>
    </div>

    @endsection