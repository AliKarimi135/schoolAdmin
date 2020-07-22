<?php $title2="لیست کلاس ها";?>
@extends('home')

@section('main_content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>نام</th>
            <th>پایه</th>

            <th>رشته</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        <?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
                            6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");?>
        @foreach($classroom as $room)
            <?php   $id=$room->id;  ?>
        <tr>
            <td>{{$room->name}}</td>
            <td>{{$base[$room->base]}}</td>
            <td>{{$room->expertise}}</td>
            <td><a href="{{route('classroom.edit',$id)}}">
                <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a  href="{{ route('classroom.destroy',$id)}}"
                   onclick="event.preventDefault();
                        document.getElementById('delete-form-{{$id}}').submit();">
                    <span class="glyphicon glyphicon-remove"></span></a>
                <form id="delete-form-{{$id}}" action="{{route('classroom.destroy',$id)}}" method="POST" style="display: none;">
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
        {!! $classroom->render() !!}
    </div>
    </div>

    @endsection