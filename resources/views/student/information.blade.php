<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>student information</h2>
   @if(!empty($data))
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
            <td>
               <a href="{{url('/student/select/unit/' . $data['student']->id)}}">unit selection</a>
               <a href="{{url('/student/lesson/list/' . $data['student']->id)}}">lessons list</a>
               <a href="{{url('/student/lesson/addAndDrop/' . $data['student']->id)}}">add and drop</a>
               <a href="{{url('/student/requests/' . $data['student']->id)}}">requests</a>
            </td>
         </tr>
      </tbody>
   </table>
   @else
   <p>there is not student with this code.</p>
   @endif
   <a href="{{url('/student/profile')}}">back</a>
</body>

</html>