<?php $title2="  نمرات ".$studentName;
$month=array(" ","فروردین","اردیبیهشت","خرداد","تیر","مرداد","شهریور","مهر","آبان","آذر","دی","بهمن","اسفند");
?>
@extends('home')
@section('main_content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th>نمره</th>
            <th>توضیحات</th>
            <th>تاریخ</th>
        </tr>
        </thead>
        <tbody>

        @foreach($marks as $mark)
        <tr>
            <td>{{$mark->mark}}</td>
            <td>{{$mark->description}}</td>
            <td>{{$mark->day." ".$month[$mark->month]}}</td>
        </tr>
            @endforeach
        </tbody>
    </table>

    @endsection