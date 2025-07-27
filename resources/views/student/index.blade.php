<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>student list</h2>
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
            <th>actions</th>
         </tr>
      </thead>
      <tbody>
         @foreach($data as $info)
         <tr>
            <td>{{$info['student']->id}}</td>
            <td>{{$info['student']->name}}</td>
            <td>
               @if($info['student']->active == 0)
               inactive
               @else
               active
               @endif
            </td>
            <td>{{$info['student']->code}}</td>
            <td>{{$info['term']}}</td>
            <td>{{$info['major']->name}}</td>
            <td>{{$info['college']->name}}</td>
            <td>{{$info['uni']->name}} {{$info['uni']->city}}</td>
            <td>
               <a href="{{url('/student/show/' . $info['student']->id)}}">show</a>
               <a href="{{url('/student/edit/' . $info['student']->id)}}">edit</a>
               <a href="{{url('/student/delete/' . $info['student']->id)}}">delete</a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</body>

</html>