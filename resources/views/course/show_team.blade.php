<?php use App\ClassRoom;use App\Teacher;
if(isset($teachers)){
    $title2="لیست دانش آموزان کلاس " . $teachers[2]['name'];
    }else{
    $title2="لیست دانش آموزان کلاس " ;
}
?>
<?php $base=array(1=>"اول",2=>"دوم",3=>"سوم",4=>"چهارم",5=>"پنجم",
    6=>"ششم",7=>"هفتم",8=>"هشتم",9=>"نهم",10=>"دهم",11=>"یازدهم",12=>"دوازدهم");
$classRoom=ClassRoom::all();
?>
@extends('home')
@section('search')
    <div class="card ">
        <div class="card-header">بررسی گروه بندی </div>
        <div class="card-body ">
            <form role="form" method="post" action="{{route('getTeam')}}">
                {!! csrf_field() !!}

                <div class="form-group row">
                    <label for="class_id" class="col-md-2 col-form-label text-md-left">{{ __('کلاس') }}</label>
                    <div class="col-md-6 ">
                        <select name="class_id" id="search" class="form-control" onchange="getSelectOption(this.value)">
                            @foreach($classRoom as $room)
                                <option value="{{$room->id}}">
                                    {{$base[$room->base]." ".$room->expertise." کلاس ".$room->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="book_id" class="col-md-2 col-form-label text-md-left">{{ __('کتاب') }}</label>
                    <div class="col-md-6 " >
                        <select name="book_id" id="selectBody" class="form-control">

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary">جست جو</button>
                        <a class="btn btn-primary" href="{{route('showTeam')}}">بازگشت</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('main_content')
    @if(isset($teachers))
           <br>گروه اول:
           {{"آقای  ".$teachers[0]['name']."  رشته ".$teachers[0]['expertise']}}
           <br><br>گروه دوم:
           {{"آقای  ".$teachers[1]['name']."  رشته ".$teachers[1]['expertise']}}
            <br><br><br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>نام</th>
                <th>گروه</th>
                <th>تغییر گروه</th>
            </tr>
            </thead>
            <tbody>
            @for($i=0;$i<count($teamJson);$i++)
                <?php   $id=$teamJson[$i]['id'];?>
            <tr>
                <td>{{$teamJson[$i]['name']}}</td>
                <td id="teamId_{{$id}}">{{$teamJson[$i]['team']}}</td>
                <td><a onclick="changeTeam({{$id}})"><span class="glyphicon glyphicon-transfer"></span></a></td>
            </tr>
                @endfor
            </tbody>
        </table>
@endif
    <script>
        function getSelectOption(id) {
            classId=$("select#search option").filter(":selected").val();
            //alert($classId);
            $.ajax({
                type : 'get',
                url : '{{url('team/classId')}}',
                data:{'classId':id},
                success:function(data){
                    //$('selectBody').html(data);
                    var output='';
                  for(i=0;i<data.length;i++){
                      output+='<option value=" '+data[i]['bookId']+' ">';
                      output+=data[i]['bookName']+'</option>';
                  }

                  document.getElementById("selectBody").innerHTML = output;
                }
            });
        }
        function changeTeam(id) {
            var id2=id;
            $.ajax({
                type : 'get',
                url : '{{url('team/changeId/teamId')}}',
                data:{'teamId':id},
                success:function(data){
                     //teamName=(data===1 ? 'اول':'دوم');
                    document.getElementById("teamId_"+id).innerHTML = data;
                    //document.getElementById("teamId_"+id).append(teamName);
                }
            });
        }
    </script>

    @endsection