<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>major information</h2>
   @foreach($lessons as $lesson)
   <div>{{$lesson}}</div>
   @endforeach
   <a href="{{url('/majors/list')}}">back</a>
</body>

</html>