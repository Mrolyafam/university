<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>single student</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>name</th>
            <th>status</th>
            <th>code</th>
            <th>term</th>
            <th>major</th>
            <th>college</th>
            <th>university</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>{{$data['student']->id}}</td>
            <td>{{$data['student']->name}}</td>
            <td>
               @if($data['student']->active == 0)
               inactive
               @else
               active
               @endif
            </td>
            <td>{{$data['student']->code}}</td>
            <td>{{$data['term']}}</td>
            <td>{{$data['major']->name}}</td>
            <td>{{$data['college']->name}}</td>
            <td>{{$data['uni']->name}} {{$data['uni']->city}}</td>
         </tr>
      </tbody>
   </table>
   <a href="{{url('/students/list')}}">back</a>
</body>

</html>