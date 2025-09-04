<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>college information</h2>
   <ul>
      @foreach($info as $collegeName=>$value)
      <li>{{$collegeName}}
         <ul>
            @foreach($value as $majorName=>$lessons)
            <li>{{$majorName}}
               <ul>
                  @foreach($lessons as $lesson)
                  <li>{{$lesson}}</li>
                  @endforeach
               </ul>
            </li>
            @endforeach
         </ul>
      </li>
      @endforeach
   </ul>
   <a href="{{url('/colleges/list')}}">back</a>
</body>

</html>