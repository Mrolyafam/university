<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>edit college form</h2>
   <form action="{{url('/college/update')}}" method="post">
      @csrf
      <input type="hidden" name="rowId" value="{{$college->rowId}}">
      <input type="hidden" name="collegeId" value="{{$college->id}}">
      <label for="college">college:</label>
      <input type="text" name="name" id="college" value="{{$college->name}}">
      <select name="uni">
         <option hidden>choose a university</option>
         @foreach($unis as $uni)
         <option value="{{$uni->id}}" @if($uni->id == $college['uniId'])selected @endif >{{$uni->name}} {{$uni->city}}</option>
         @endforeach
      </select>
      <input type="submit" value="submit">
   </form>
</body>

</html>