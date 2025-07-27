<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>university list</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>uni name</th>
            <th>uni city</th>
            <th>actions</th>
         </tr>
      </thead>
      <tbody>
         @foreach($unis as $uni)
         <tr>
            <td>{{$uni->id}}</td>
            <td>{{$uni->name}}</td>
            <td>{{$uni->city}}</td>
            <td>
               <a href="{{url('/university/show/' . $uni->id)}}">show</a>
               <a href="{{url('/university/edit/' . $uni->id)}}">edit</a>
               <a href="{{url('/university/information/' . $uni->id)}}">information</a>
               <a href="{{url('/university/students/requests/' . $uni->id)}}">students requests</a>
               <a href="{{url('/university/delete/' . $uni->id)}}">delete</a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</body>

</html>