<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>major list</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>major name</th>
            <th>college</th>
            <th>university</th>
            <th>actions</th>
         </tr>
      </thead>
      <tbody>
         @foreach($majorInfo as $info)
         @foreach($info as $data)
         <tr>
            <td>{{$data['majorId']}}</td>
            <td>{{$data['majorName']}}</td>
            <td>{{$data['college']}}</td>
            <td>{{$data['uni']}}</td>
            <td>
               <a href="{{url('/major/show/' . $data['rowId'])}}">show</a>
               <a href="{{url('/major/edit/' . $data['rowId'])}}">edit</a>
               <a href="{{url('/major/information/' . $data['rowId'])}}">information</a>
               <a href="{{url('/major/delete/' . $data['rowId'])}}">delete</a>
            </td>
         </tr>
         @endforeach
         @endforeach
      </tbody>
   </table>
</body>

</html>