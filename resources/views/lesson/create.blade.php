<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>create lesson form</h2>
   <form action="{{url('/lesson/store')}}" method="post">
      @csrf
      <div>
         <label for="lesson-name">lesson:</label>
         <input type="text" name="name" id="lesson-name">
         <label for="lesson-unit">unit:</label>
         <input type="text" name="unit" id="lesson-unit">
         <label for="lesson-term">term:</label>
         <input type="text" name="term" id="lesson-term">
      </div>
      <p>majors:</p>
      <ul>
         @foreach($unis as $uniId=>$uniInfo)
         <li>
            <span>{{$uniInfo['uniData']?->name}} {{$uniInfo['uniData']?->city}}</span>
            <ul>
               @foreach($uniInfo['colleges'] as $collegeId=>$collegeInfo)
               <li style="margin-top: 25px;">
                  <span>{{$collegeInfo['collegeData']?->name}}</span>
                  <ul>
                     @foreach($collegeInfo['majors'] as $rowId=>$major)
                     <li>
                        <label for="{{$rowId}}">{{$major?->name}}</label>
                        <input type="checkbox" name="rows[]" value="{{$rowId}}" id="{{$rowId}}">
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