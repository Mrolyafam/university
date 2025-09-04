<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>student's lessons list</h2>
   @foreach($data as $term=>$value)
   <h4>id: {{$value['student']->id}} student: {{$value['student']->name}} code: {{$value['student']->code}} term: {{$term}}</h4>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>lesson</th>
            <th>unit</th>
            <th>teacher</th>
         </tr>
      </thead>
      <tbody>
         @foreach($value['lessons'] as $studentLessonRowId=>$lesson)
         <tr>
            <td>{{$lesson['lesson']->name}}</td>
            <td>{{$lesson['unit']}}</td>
            <td>{{$lesson['teacher']->name}}</td>
         </tr>
         @endforeach
      </tbody>
   </table>
   @endforeach
</body>

</html>