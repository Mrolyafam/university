<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>create college form</h2>
   <form action="{{url('/college/store')}}" method="post">
      @csrf
      <label for="college-name">college:</label>
      <input type="text" name="name" id="college-name">
      <label>universities:</label>
      <select name="uni">
         <option hidden >choose a university</option>
         @foreach($unis as $uni)
         <option value="{{$uni->id}}">{{$uni->name}} {{$uni->city}}</option>
         @endforeach
      </select>
      <input type="submit" value="submit">
   </form>
</body>

</html>