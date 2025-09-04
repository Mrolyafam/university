<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>edit lesson form</h2>
   <form action="{{url('/lesson/update')}}" method="post">
      @csrf
      <div>
         <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
         <input type="hidden" name="row_id" value="{{$row_id}}">
         <span>lesson: {{$lesson->name}}</span>
         <span>unit: {{$lesson->unit}}</span>
         <span>term: {{$lesson->term}}</span>
      </div>
      <ul>
         @foreach($unis as $uniId=>$uniInfo)
         <li>
            <span>{{$uniInfo['uniData']->name}} {{$uniInfo['uniData']->city}}</span>
            <ul>
               @foreach($uniInfo['colleges'] as $collegeId=>$collegeInfo)
               <li style="margin-top: 25px;">
                  <span>{{$collegeInfo['collegeData']->name}}</span>
                  <ul>
                     @foreach($collegeInfo['majors'] as $rowId=>$major)
                     <li>
                        <label for="{{$rowId}}">{{$major->name}}</label>
                        <input type="checkbox" name="row_ids[]" value="{{$rowId}}" id="{{$rowId}}" @if($rowId==$row_id) checked @endif>
                     </li>
                     @endforeach
                  </ul>
               </li>
               @endforeach
            </ul>
         </li>
         <hr>
         @endforeach
      </ul>
      </div>
      <input type="submit" value="submit">
   </form>
</body>

</html>