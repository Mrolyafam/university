<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>single college</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>college name</th>
            <th>university</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>{{$college->id}}</td>
            <td>{{$college->name}}</td>
            <td>{{$college->uniName}}</td>
         </tr>
      </tbody>
   </table>
   <a href="{{url('/colleges/list')}}">back</a>
</body>

</html>