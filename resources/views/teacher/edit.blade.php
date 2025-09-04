<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>edit teacher form</h2>
   <form action="{{url('/teacher/update')}}" method="post">
      @csrf
      <div>
         <input type="hidden" name="teacher_id" value="{{$data['teacher']?->id}}">
         <input type="hidden" name="midd_lesson_id" value="{{$data['middLessonId']}}">
         <label for="teacher-name">teacher:</label>
         <input type="text" name="name" id="teacher-name" value="{{$data['teacher']?->name}}">
      </div>
      <p>lessons:</p>
      <ul>
         @foreach($unis as $uniId=>$uniInfo)
         <li>
            <span>{{$uniInfo['uniData']?->name}} {{$uniInfo['uniData']?->city}}</span>
            <ul>
               @foreach($uniInfo['colleges'] as $collegeId=>$collegeInfo)
               <li style="margin-top: 25px;">
                  <span>{{$collegeInfo['collegeData']?->name}}</span>
                  <ul>
                     @foreach($collegeInfo['majors'] as $rowId=>$majorInfo)
                     <li>
                        <span>{{$majorInfo['majorData']?->name}}</span>
                        <ul>
                           @foreach($majorInfo['lessons'] as $middLessonId=>$lesson)
                           <li>
                              <label>{{$lesson?->name}}</label>
                              <input type="checkbox" name="middLessons[]" value="{{$middLessonId}}" @if($data['middLessonId']==$middLessonId) checked @endif>
                           </li>
                           @endforeach
                        </ul>
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