<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>teacher list</h2>
   <table border="1" style="border-collapse: collapse;">
      <thead>
         <tr>
            <th>id</th>
            <th>teacher name</th>
            <th>lesson</th>
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
            <td>{{$info['teacher']?->id}}</td>
            <td>{{$info['teacher']?->name}}</td>
            <td>{{$info['lesson']?->name}}</td>
            <td>{{$info['lesson']?->unit}}</td>
            <td>{{$info['lesson']?->term}}</td>
            <td>{{$info['major']?->name}}</td>
            <td>{{$info['college']?->name}}</td>
            <td>{{$info['uni']?->name}} {{$info['uni']?->city}}</td>
            <td>
               <a href="{{url('/teacher/show/' . $info['teacher']?->id . '/row/' . $info['rowId'] )}}">show</a>
               <a href="{{url('/teacher/edit/' . $info['teacher']?->id . '/row/' . $info['rowId'] )}}">edit</a>
               <a href="{{url('/teacher/delete/' . $info['teacher']?->id . '/row/' . $info['rowId'] )}}">delete</a>
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</body>

</html>