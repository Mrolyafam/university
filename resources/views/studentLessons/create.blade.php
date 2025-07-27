<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>unit selection</h2>
   <form action="{{url('/unit/store')}}" method="post">
      @csrf
      <span style="font-weight: bold;">student: {{$student->name}}</span>
      <span style="font-weight: bold;">code: {{$student->code}}</span>
      <span style="font-weight: bold;">term: {{$term->term}}</span>
      <input type="hidden" name="student_id" value="{{$student->id}}">
      <input type="hidden" name="term" value="{{$term->term}}">
      @foreach($data as $middLessonId=>$info)
      <div>
         <label for="{{$info['lesson']->id}}">lesson: {{$info['lesson']->name}} unit: {{$info['lesson']->unit}}</label>
         <input type="checkbox" name="lessons[{{$middLessonId}}]" id="{{$info['lesson']->id}}" value="{{$info['lesson']->unit}}">
         <span>teachers:</span>
         @foreach($info['teachers'] as $middTeacherId=>$teacher)
         <label>{{$teacher->name}}</label>
         <input type="radio" name="{{$middLessonId}}" value="{{$middTeacherId}}">
         @endforeach
      </div>
      @endforeach
      <input type="submit" value="submit">
   </form>
</body>

</html>