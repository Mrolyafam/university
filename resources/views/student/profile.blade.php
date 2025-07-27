<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>find student</h2>
   <form action="{{url('/student/information')}}" method="post">
      @csrf
      <label for="stu-code">code:</label>
      <input type="text" name="code" id="stu-code">
      <input type="submit" value="submit">
   </form>
</body>

</html>