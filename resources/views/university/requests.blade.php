<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>confirm student requests</h2>
   <form action="{{url('/student/request/result')}}" method="post">
      @csrf
      <p>students :</p>
      @foreach($students as $student)
      <input type="hidden" name="stu_ids[{{$student->id}}]" value="{{$student->id}}">
      <div style="margin-top: 20px;">
         <span>{{$student->name}} {{$student->code}}</span>
         <div>
            @if($student->transferReq)
            <label for="transfer{{$student->id}}">confirm transfer request</label>
            <input type="checkbox" name="stu_ids[{{$student->id}}][transfer]" id="transfer{{$student->id}}" value="1" disabled>
            @endif
            @if($student->approveReq)
            <label for="approve{{$student->id}}">confirm approve request</label>
            <input type="checkbox" name="stu_ids[{{$student->id}}][approve]" id="approve{{$student->id}}" value="1">
            @endif
         </div>
      </div>
      @endforeach
      <input type="submit" value="submit">
   </form>
</body>

</html>