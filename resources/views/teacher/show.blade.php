<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>single teacher</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>teacher name</th>
            <th>lesson</th>
            <th>unit</th>
            <th>major</th>
            <th>college</th>
            <th>university</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>{{$data['teacher']->id}}</td>
            <td>{{$data['teacher']->name}}</td>
            <td>{{$data['lesson']->name}}</td>
            <td>{{$data['lesson']->unit}}</td>
            <td>{{$data['major']->name}}</td>
            <td>{{$data['college']->name}}</td>
            <td>{{$data['uni']->name}} {{$data['uni']->city}}</td>
         </tr>
      </tbody>
   </table>
   <a href="{{url('/teachers/list')}}">back</a>
</body>

</html>