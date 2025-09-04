<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>student requests</h2>
   <form action="{{url('/request/store')}}" method="post">
      @csrf
      <input type="hidden" name="stu_id" value="{{$student->id}}">
      <label for="approve">approve unit selection requests</label>
      <input type="checkbox" name="approve" id="approve" value="1" @if($student->active == 1) disabled @endif>
      <br>
      <label for="transfer">transfer student request</label>
      <input type="checkbox" name="transfer" id="transfer" value="1" disabled>
      <br>
      <input type="submit" value="submit">
   </form>
</body>

</html>