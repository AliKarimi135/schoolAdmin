<?php
$status=false;
$value=0;


if(isset($students)){
    $title2="ویرایش اطلاعات دانش آموز";
    $status=true;
    $value=$students->class_id;
 }else{
    $title2="افزودن اطلاعات دانش آموز";
    }
?>
<?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
    6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");?>
@extends('home')
@section('main_content')
    @if($status)
        <form role="form" method="post" action="{{route('student.update',$students->id)}}">
            {!! method_field("PUT") !!}
    @else
        <form role="form" method="post" action="{{route('student.store')}}">
    @endif
        {!! csrf_field() !!}
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('نام') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ ($status) ? $students->name : old('name') }}"  autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="national_code" class="col-md-2 col-form-label text-md-left">{{ __('کد ملی') }}</label>
            <div class="col-md-6">
                <input id="national_code" type="text" class="form-control{{ $errors->has('national_code') ? ' is-invalid' : '' }}" name="national_code" value="{{ ($status) ? $students->national_code : old('national_code') }}"  >
                @if ($errors->has('national_code'))
                    <span class="invalid-feedback" role="alert">
                 <strong>{{ $errors->first('national_code') }}</strong>
            </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="class_id" class="col-md-2 col-form-label text-md-left">{{ __('کلاس') }}</label>
            <div class="col-md-6 ">
                <select name="class_id" class="form-control">
                    @foreach($classRoom as $room)
                        <option value="{{$room->id}}"
                                {{ ($status && $value===$room->class_id) ? 'selected' :''}}>
                            {{$base[$room->base]." ".$room->expertise." کلاس ".$room->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">{{ ($status) ? 'ویرایش' :'افزودن'}}</button>
            @if($status)
                <a  class="btn btn-primary" href="{!! URL::previous() !!}">بازگشت</a>
                <input type="hidden" name="pre_page" value="{!! URL::previous() !!}"/>
                @endif
        </div>
        </div>
        <input type="hidden" name="active" value="{{ ($status) ? $students->active : 0 }}"/>
    </form>

@endsection