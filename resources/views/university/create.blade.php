<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>create university form</h2>
   <form action="{{url('/university/store')}}" method="post">
      @csrf
      <label for="uni-name">university:</label>
      <input type="text" name="name" id="uni-name">
      <label for="city-name">city:</label>
      <input type="text" name="city" id="city-name">
      <input type="submit" value="submit">
   </form>
</body>

</html>