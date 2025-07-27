<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>register student form</h2>
   <form action="{{url('/student/store')}}" method="post">
      @csrf
      <label for="stu-name">name:</label>
      <input type="text" name="name" id="stu-name">
      <label for="code">code:</label>
      <input type="text" name="code" id="code">
      <label>university college major:</label>
      <select name="rowId">
         <option hidden>choose uni college major</option>
         @foreach($mucs as $muc)
         <option value="{{$muc['rowId']}}">university: {{$muc['uni']}} college: {{$muc['college']}} major: {{$muc['major']}}</option>
         @endforeach
      </select>
      <input type="submit" value="submit">
   </form>
</body>

</html>