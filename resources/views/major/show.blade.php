<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>single major</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>major name</th>
            <th>college</th>
            <th>university</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>{{$major->id}}</td>
            <td>{{$major->name}}</td>
            @foreach($data as $collegeName=>$uniName)
            <td>{{$collegeName}}</td>
            <td>{{$uniName}}</td>
            @endforeach
         </tr>
      </tbody>
   </table>
   <a href="{{url('/majors/list')}}">back</a>
</body>

</html>