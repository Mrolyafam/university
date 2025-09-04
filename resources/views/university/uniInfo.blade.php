<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>university information</h2>
   <ul>
      @foreach($data as $uniName=>$collegeData)
      <li>{{$uniName}}
         <ul>
            @foreach($collegeData as $collegeName=>$majorData)
            <li>{{$collegeName}}
               <ul>
                  @foreach($majorData as $majorName=>$lessonData)
                  <li>{{$majorName}}
                     <ul>
                        @foreach($lessonData as $lessonName)
                        <li>{{$lessonName}}</li>
                        @endforeach
                     </ul>
                  </li>
                  @endforeach
               </ul>
            </li>
            @endforeach
         </ul>
      </li>
      @endforeach
   </ul>
   <a href="{{url('/universities/list')}}">back</a>
</body>

</html>