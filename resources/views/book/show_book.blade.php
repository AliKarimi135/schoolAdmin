<?php $title2="لیست کتاب ها";?>
@extends('home')
@section('search')
        <div class="card ">
            <div class="card-header">جست جوی کتاب </div>
            <div class="card-body ">
                <form role="form" method="get" action="{{route('book.search',1)}}">
                    {!! csrf_field() !!}
                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('پایه') }}</label>
                    <div class="col-md-6 ">
                        <select name="base" class="form-control">
                            <option value="1" >اول</option>
                            <option value="2" >دوم</option>
                            <option value="3" >سوم</option>
                            <option value="4" >چهارم</option>
                            <option value="5" >پنجم</option>
                            <option value="6" >ششم</option>
                            <option value="7" >هفتم</option>
                            <option value="8" >هشتم</option>
                            <option value="9" >نهم</option>
                            <option value="10" >دهم</option>
                            <option value="11" >یازدهم</option>
                            <option value="12" >دوازدهم</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="expertise" class="col-md-2 col-form-label text-md-left">{{ __('رشته') }}</label>
                    <div class="col-md-6">
                        <select name="expertise" class="form-control">
                            <option value="هردو" >تخصصی و عمومی</option>
                            <option value="عمومی" > عمومی</option>
                            @foreach($expertises as $expertise)
                                <option value="{{$expertise->expertise}}" >{{$expertise->expertise}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="type" class="col-md-2 col-form-label text-md-left">{{ __('نوع') }}</label>
                    <div class="col-md-6 ">
                        <select name="type" class="form-control">
                            <option value="3" >هر دو</option>
                            <option value="1" >تئوری</option>
                            <option value="2" >عملی</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">جست جو</button>
                        <a class="btn btn-primary" href="{{route('book.index')}}">بازگشت</a>
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
            <th>پایه</th>
            <th>نوع</th>
            <th>رشته</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        <?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
                            6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");?>
        @foreach($books as $book)
            <?php   $id=$book->id;  ?>
        <tr>
            <td>{{$book->name}}</td>
            <td>{{$base[$book->base]}}</td>
            <td>@if($book->type===1)   تئوری @else عملی  @endif</td>
            <td>{{$book->expertise}}</td>
            <td><a href="{{route('book.edit',$id)}}">
                <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a  href="{{ route('book.destroy',$id)}}"
                   onclick="event.preventDefault();
                        document.getElementById('delete-form-{{$id}}').submit();">
                    <span class="glyphicon glyphicon-remove"></span></a>
                <form id="delete-form-{{$id}}" action="{{route('book.destroy',$id)}}" method="POST" style="display: none;">
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
        {!! $books->render() !!}
    </div>
    </div>

    @endsection