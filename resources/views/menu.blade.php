<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <ul style="display: flex; justify-content: space-around; list-style: none;">
        <li><a href="{{url('/university/create')}}">create university</a></li>
        <li><a href="{{url('/universities/list')}}">university list</a></li>
        <li><a href="{{url('/college/create')}}">create college</a></li>
        <li><a href="{{url('/colleges/list')}}">college list</a></li>
        <li><a href="{{url('/major/create')}}">create major</a></li>
        <li><a href="{{url('/majors/list')}}">major list</a></li>
        <li><a href="{{url('/lesson/create')}}">create lesson</a></li>
        <li><a href="{{url('/lessons/list')}}">lesson list</a></li>
        <li><a href="{{url('/teacher/create')}}">create teacher</a></li>
        <li><a href="{{url('/teachers/list')}}">teacher list</a></li>
        <li><a href="{{url('/student/register')}}">register student</a></li>
        <li><a href="{{url('/students/list')}}">student list</a></li>
        <li><a href="{{url('/student/profile')}}">student profile</a></li>
    </ul>
</body>

</html>