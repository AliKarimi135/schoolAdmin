<?php $title2="لیست دبیران  ";?>
@extends('home')
@section('search')
    <div class="card ">
        <div class="card-header">جست جوی دبیر </div>
        <div class="card-body ">
            <form role="form" method="get" action="{{route('teachers.search',1)}}">
                {!! csrf_field() !!}
                <div class="form-group row">
                    <label for="expertise" class="col-md-2 col-form-label text-md-left">{{ __('رشته') }}</label>
                    <div class="col-md-6">
                        <input id="expertise" type="text" class="form-control{{ $errors->has('expertise') ? ' is-invalid' : '' }}" name="expertise"   >
                        @if ($errors->has('expertise'))
                            <span class="invalid-feedback" role="alert">
                             <strong>{{ $errors->first('expertise') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">جست جو</button>
                        <a class="btn btn-primary" href="{{route('teachers.index')}}">بازگشت</a>
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
            <th>کدپرسنلی</th>
            <th>رشته</th>
            <th>مدرک</th>
            <th>وضعیت</th>
            <th>ویرایش</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody>
        <?php $degree=array(1=>"دکترا",2=>"فوق لیسانس",3=>"لیسانس",4=>"فوق دیپلم");?>

        <?php   $id=$teacher->id;  ?>
        <tr>
            <td>{{$teacher->name}}</td>
            <td>{{$teacher->personal_code}}</td>
            <td>{{$teacher->expertise}}</td>
            <td>{{$degree[$teacher->degree]}}</td>
            <td>@if($teacher->active===1)   فعال @else غیرفعال  @endif</td>
            <td><a href="{{route('teachers.edit',$id)}}">
                <span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a  href="{{ route('teachers.destroy',$id)}}"
                   onclick="event.preventDefault();
                        document.getElementById('delete-form-{{$id}}').submit();">
                    <span class="glyphicon glyphicon-remove"></span></a>
                <form id="delete-form-{{$id}}" action="{{route('teachers.destroy',$id)}}" method="POST" style="display: none;">
                    {!! csrf_field() !!}
                    {!! method_field("DELETE") !!}
                </form>

            </td>
        </tr>

        </tbody>
    </table>

    @endsection