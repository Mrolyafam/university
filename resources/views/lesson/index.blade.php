<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>lesson list</h2>
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
            <th>actions</th>
         </tr>
      </thead>
      <tbody>
         @foreach($data as $info)
         <tr>
            <td>{{$info['lesson']->id}}</td>
            <td>{{$info['lesson']->name}}</td>
            <td>{{$info['lesson']->unit}}</td>
            <td>{{$info['lesson']->term}}</td>
            <td>{{$info['major']}}</td>
            <td>{{$info['college']}}</td>
            <td>{{$info['uni']}}</td>
            <td>
               <a href="{{url('/lesson/show/' . $info['lesson']->id . '/row/' . $info['rowId'] )}}">show</a>
               <a href="{{url('/lesson/edit/' . $info['lesson']->id . '/row/' . $info['rowId'] )}}">edit</a>
               <a href="{{url('/lesson/delete/' . $info['lesson']->id . '/row/' . $info['rowId'] )}}">delete</a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</body>

</html>