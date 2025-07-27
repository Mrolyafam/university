<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>edit university form</h2>
   <form action="{{url('/university/update')}}" method="post">
      @csrf
      <input type="hidden" name="id" value="{{$uni->id}}">
      <label for="uni-name">university:</label>
      <input type="text" name="name" id="uni-name" value="{{$uni->name}}">
      <label for="city-name">city:</label>
      <input type="text" name="city" id="city-name" value="{{$uni->city}}">
      <input type="submit" value="submit">
   </form>
</body>

</html>