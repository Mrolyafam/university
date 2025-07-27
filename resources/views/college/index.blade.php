<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>college list</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>college name</th>
            <th>university</th>
            <th>actions</th>
         </tr>
      </thead>
      <tbody>
         @foreach($data as $info)
         <tr>
            <td>{{$info['collegeId']}}</td>
            <td>{{$info['collegeName']}}</td>
            <td>{{$info['uni']}}</td>
            <td>
               <a href="{{url('/college/show/' . $info['ucRowId'])}}">show</a>
               <a href="{{url('/college/edit/' . $info['ucRowId'])}}">edit</a>
               <a href="{{url('/college/information/' . $info['ucRowId'])}}">information</a>
               <a href="{{url('/college/delete/' . $info['ucRowId'])}}">delete</a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</body>

</html>