<?php

use App\ClassRoom;

$status=false;
$teacherId=0;
$classId=0;
$bookBase=0;
$value3='';
$classroom=ClassRoom::all();
$teachers=\App\Teacher::all();

if(isset($course)){
    $title2="ویرایش اطلاعات تدریس";
    $status=true;
    $teacherId=$course->teacher_id;
    $classId=$course->class_id;
    $bookBase=$book->base;
    $value3=$book->expertise;
 }else{
    $title2="افزودن اطلاعات تدریس";
    }
?>
<?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
    6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");
    $type=array(1=>"تئوری",2=>"عملی");
?>
@extends('home')
@section('main_content')
    @if($status)
        <form role="form" method="post" action="{{route('course.update',$course->id)}}">
            {!! method_field("PUT") !!}
    @else
        <form role="form" method="post" action="{{route('course.store')}}">
    @endif
        {!! csrf_field() !!}
            <div class="form-group row">
                <label for="name" class="col-md-2 col-form-label text-md-left">{{ __('پایه') }}</label>
                <div class="col-md-6 ">
                    <select name="base" id="base" class="form-control">
                        <option value="1" {{ ($status && $bookBase===1) ? 'selected' :''}}>اول</option>
                        <option value="2" {{ ($status && $bookBase===2) ? 'selected' :''}}>دوم</option>
                        <option value="3" {{ ($status && $bookBase===3) ? 'selected' :''}}>سوم</option>
                        <option value="4" {{ ($status && $bookBase===4) ? 'selected' :''}}>چهارم</option>
                        <option value="5" {{ ($status && $bookBase===5) ? 'selected' :''}}>پنجم</option>
                        <option value="6" {{ ($status && $bookBase===6) ? 'selected' :''}}>ششم</option>
                        <option value="7" {{ ($status && $bookBase===7) ? 'selected' :''}}>هفتم</option>
                        <option value="8" {{ ($status && $bookBase===8) ? 'selected' :''}}>هشتم</option>
                        <option value="9" {{ ($status && $bookBase===9) ? 'selected' :''}}>نهم</option>
                        <option value="10" {{ ($status && $bookBase===10) ? 'selected' :''}}>دهم</option>
                        <option value="11" {{ ($status && $bookBase===11) ? 'selected' :''}}>یازدهم</option>
                        <option value="12" {{ ($status && $bookBase===12) ? 'selected' :''}}>دوازدهم</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="expertise" class="col-md-2 col-form-label text-md-left">{{ __('رشته') }}</label>
                <div class="col-md-6">
                    <select name="expertise" id="expertise" class="form-control" onchange="getSelectOption(this.value)">
                        <option value="عمومی" > عمومی</option>
                        @foreach(\App\Http\Utilitis\ClassRoomFunctions::getExpertises() as $expertise)
                            <option value="{{$expertise->expertise}}"
                                    {{ ($status && $value3===$expertise->expertise) ? 'selected' :''}}>
                                {{$expertise->expertise}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
        <div class="form-group row">
            <label for="book_id" class="col-md-2 col-form-label text-md-left">{{ __('کتاب') }}</label>
            <div class="col-md-6 ">
                <select name="book_id" id="book" class="form-control{{ $errors->has('book_id') ? ' is-invalid' : '' }}">
                    @if($status)
                        <option value="{{$book->id}}">
                                {{  $book->name." ".$type[$book->type]}}</option>
                    @endif
                </select>
                @if ($errors->has('book_id'))
                    <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('book_id') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <label for="teacher_id" class="col-md-2 col-form-label text-md-left">{{ __('دبیر') }}</label>
            <div class="col-md-6 ">
                <select name="teacher_id" class="form-control">
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}"
                                {{ ($status && $teacherId===$teacher->id) ? 'selected' :''}}>
                            {{"آقای ".$teacher->name." رشته ".$teacher->expertise}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="class_id" class="col-md-2 col-form-label text-md-left">{{ __('کلاس') }}</label>
            <div class="col-md-6 ">
                <select name="class_id" class="form-control">
                    @foreach($classroom as $room)
                        <option value="{{$room->id}}"
                                {{ ($status && $classId===$room->id) ? 'selected' :''}}>
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
            <input type="hidden" name="team" value="{{ ($status) ? $course->team : 0 }}"/>
    </form>
    <script>
        function getSelectOption(expertise) {
            id=$("select#base option").filter(":selected").val();

            $.ajax({
                type : 'get',
                url : '{{url('search/base')}}',
                data:{'base':id,'expertise':expertise},
                success:function(data) {

                    var output='';
                    var type='';
                    for(i=0;i<data.length;i++){
                        type=(data[i]['type']===1 ? 'تئوری': 'عملی');
                        output+='<option value=" '+data[i]['bookId']+' ">';
                        output+=data[i]['bookName']+' '+type+'</option>';
                    }
                    document.getElementById("book").innerHTML = output;
                }});
        }
    </script>
@endsection