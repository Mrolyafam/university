<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>edit student form</h2>
   <form action="{{url('/student/update')}}" method="post">
      @csrf
      <input type="hidden" name="id" value="{{$data['student']->id}}">
      <label for="stu-name">name:</label>
      <input type="text" name="name" id="stu-name" value="{{$data['student']->name}}">
      <label for="code">code:</label>
      <input type="text" name="code" id="code" value="{{$data['student']->code}}">
      <label>university college major:</label>
      <select name="rowId">
         @foreach($mucs as $muc)
         <option value="{{$muc['rowId']}}" @if($muc['rowId']==$data['rowId']) selected @endif>
            university: {{$muc['uni']}} college: {{$muc['college']}} major: {{$muc['major']}}
         </option>
         @endforeach
      </select>
      <input type="submit" value="submit">
   </form>
</body>

</html>