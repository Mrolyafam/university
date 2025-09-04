<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>single lesson</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>lesson name</th>
            <th>lesson unit</th>
            <th>lesson term</th>
            <th>major</th>
            <th>college</th>
            <th>university</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>{{$data['lesson']?->id}}</td>
            <td>{{$data['lesson']?->name}}</td>
            <td>{{$data['lesson']?->unit}}</td>
            <td>{{$data['lesson']?->term}}</td>
            <td>{{$data['major']}}</td>
            <td>{{$data['college']}}</td>
            <td>{{$data['uni']}}</td>
         </tr>
      </tbody>
   </table>
   <a href="{{url('/lessons/list')}}">back</a>
</body>

</html>