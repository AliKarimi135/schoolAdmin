<?php
$status=false;
$value=0;


if(isset($teachers)){
    $title2="ویرایش اطلاعات معلم";
    $status=true;
    $value=$teachers->degree;
 }else{
    $title2="افزودن اطلاعات معلم";
    }
?>
@extends('home')
@section('main_content')
    @if($status)
        <form role="form" method="post" action="{{route('teachers.update',$teachers->id)}}">
            {!! method_field("PUT") !!}
    @else
        <form role="form" method="post" action="{{route('teachers.store')}}">
    @endif
        {!! csrf_field() !!}
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('نام') }}</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ ($status) ? $teachers->name : old('name') }}"  autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="personal_code" class="col-md-2 col-form-label text-md-left">{{ __('کد پرسنلی') }}</label>
            <div class="col-md-6">
                <input id="personal_code" type="text" class="form-control{{ $errors->has('personal_code') ? ' is-invalid' : '' }}" name="personal_code" value="{{ ($status) ? $teachers->personal_code : old('personal_code') }}"  >
                @if ($errors->has('personal_code'))
                    <span class="invalid-feedback" role="alert">
                 <strong>{{ $errors->first('personal_code') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="expertise" class="col-md-2 col-form-label text-md-left">{{ __('رشته') }}</label>
            <div class="col-md-6">
                <input id="expertise" type="text" class="form-control{{ $errors->has('expertise') ? ' is-invalid' : '' }}" name="expertise" value="{{ ($status) ? $teachers->expertise : old('expertise') }}"  >
                @if ($errors->has('expertise'))
                    <span class="invalid-feedback" role="alert">
                 <strong>{{ $errors->first('expertise') }}</strong>
            </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="degree" class="col-md-2 col-form-label text-md-left">{{ __('مدرک') }}</label>
            <div class="col-md-6 ">
                <select name="degree" class="form-control">
                    <option value="1" {{ ($status && $value===1) ? 'selected' :''}}>دکترا</option>
                    <option value="2" {{ ($status && $value===2) ? 'selected' :''}}>فوق لیسانس</option>
                    <option value="3" {{ ($status && $value===3) ? 'selected' :''}}>لیسانس</option>
                    <option value="4" {{ ($status && $value===4) ? 'selected' :''}}>فوق دیپلم</option>
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
        <input type="hidden" name="active" value="{{ ($status) ? $teachers->active : 0 }}"/>
    </form>

@endsection