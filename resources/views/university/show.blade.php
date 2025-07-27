<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>single university</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>uni name</th>
            <th>uni city</th>
         </tr>
      </thead>
      <tbody>
         <tr>
            <td>{{$uni->id}}</td>
            <td>{{$uni->name}}</td>
            <td>{{$uni->city}}</td>
         </tr>
      </tbody>
   </table>
   <a href="{{url('/universities/list')}}">back</a>
</body>

</html>