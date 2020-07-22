<?php
$status=false;
$value=0;
$value2=0;
if(isset($classroom)){
    $title2="ویرایش کلاس";
    $status=true;
    $value=$classroom->base;
    $value2=$classroom->expertise;
 }else{
    $title2="افزودن کلاس";
    }
?>
@extends('home')
@section('main_content')
    @if($status)
        <form role="form" method="post" action="{{route('classroom.update',$classroom->id)}}">
            {!! method_field("PUT") !!}
    @else
        <form role="form" method="post" action="{{route('classroom.store')}}">
    @endif
        {!! csrf_field() !!}
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('نام') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ ($status) ? $classroom->name : old('name') }}"  autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('پایه') }}</label>
            <div class="col-md-6 ">
                <select name="base" class="form-control">
                    <option value="1" {{ ($status && $value===1) ? 'selected' :''}}>اول</option>
                    <option value="2" {{ ($status && $value===2) ? 'selected' :''}}>دوم</option>
                    <option value="3" {{ ($status && $value===3) ? 'selected' :''}}>سوم</option>
                    <option value="4" {{ ($status && $value===4) ? 'selected' :''}}>چهارم</option>
                    <option value="5" {{ ($status && $value===5) ? 'selected' :''}}>پنجم</option>
                    <option value="6" {{ ($status && $value===6) ? 'selected' :''}}>ششم</option>
                    <option value="7" {{ ($status && $value===7) ? 'selected' :''}}>هفتم</option>
                    <option value="8" {{ ($status && $value===8) ? 'selected' :''}}>هشتم</option>
                    <option value="9" {{ ($status && $value===9) ? 'selected' :''}}>نهم</option>
                    <option value="10" {{ ($status && $value===10) ? 'selected' :''}}>دهم</option>
                    <option value="11" {{ ($status && $value===11) ? 'selected' :''}}>یازدهم</option>
                    <option value="12" {{ ($status && $value===12) ? 'selected' :''}}>دوازدهم</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="expertise" class="col-md-2 col-form-label text-md-left">{{ __('رشته') }}</label>
            <div class="col-md-6">
                <input id="expertise" type="text" class="form-control{{ $errors->has('expertise') ? ' is-invalid' : '' }}" name="expertise" value="{{ ($status) ? $classroom->expertise : old('expertise') }}"  >
                @if ($errors->has('expertise'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('expertise') }}</strong>
                </span>
                @endif
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
    </form>

@endsection