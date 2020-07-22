<?php $title2="لیست دانش آموزان  ";?>
<?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
    6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");?>
@extends('home')
@section('search')
    <div class="card ">
        <div class="card-header">جست جوی دانش آموز </div>
        <div class="card-body ">
            <form role="form" method="get" action="{{route('student.search',1)}}">
                {!! csrf_field() !!}
                <div class="form-group row">
                    <label for="class_id" class="col-md-2 col-form-label text-md-left">{{ __('کلاس') }}</label>
                    <div class="col-md-6 ">
                        <select name="class_id" class="form-control">
                            @foreach($classRoom as $room)
                                <option value="{{$room->id}}">
                                    {{$base[$room->base]." ".$room->expertise." کلاس ".$room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">جست جو</button>
                        <a class="btn btn-primary" href="{{route('student.index')}}">بازگشت</a>
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
            <th>نام</th>
            <th>کدملی</th>
            <th>رشته</th>
            <th>پایه</th>
            <th>کلاس</th>
            <th>وضعیت</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <?php   $id=$student->id;  ?>
        <tr>
            <td>{{$student->name}}</td>
            <td>{{$student->national_code}}</td>
            <td>{{$classRoom->find($student->class_id)->expertise}}</td>
            <td>{{$base[$classRoom->find($student->class_id)->base]}}</td>
            <td>{{$classRoom->find($student->class_id)->name}}</td>
            <td>@if($student->active===1)   فعال @else غیرفعال  @endif</td>
            <td><a href="{{route('student.edit',$id)}}">
                <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a  href="{{ route('student.destroy',$id)}}"
                   onclick="event.preventDefault();
                        document.getElementById('delete-form-{{$id}}').submit();">
                    <span class="glyphicon glyphicon-remove"></span></a>
                <form id="delete-form-{{$id}}" action="{{route('student.destroy',$id)}}" method="POST" style="display: none;">
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
        {!! $students->render() !!}
    </div>
    </div>

    @endsection