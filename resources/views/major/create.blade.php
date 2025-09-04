<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>create major form</h2>
   <form action="{{url('/major/store')}}" method="post">
      @csrf
      <label for="major">major:</label>
      <input type="text" name="name" id="major">
      <div>
         <label>universities and colleges:</label>
         @foreach($info as $uniId=>$data)
         <div>
            <label for="{{$uniId}}">{{$data['uniData']?->name}} {{$data['uniData']?->city}}</label>
            <input type="checkbox" name="uni_ids[]" value="{{$uniId}}" id="{{$uniId}}">
            @foreach($data['colleges'] as $college)
            <label>{{$college?->name}}</label>
            <input type="radio" name="{{$uniId}}" value="{{$college?->id}}">
            @endforeach
         </div>
         @endforeach
      </div>
      <input type="submit" value="submit">
   </form>
</body>

</html>