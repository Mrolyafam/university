<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   @include("menu")
   <h2>edit major form</h2>
   <form action="{{url('/major/update')}}" method="post">
      @csrf
      <input type="hidden" name="row_id" value="{{$major['ids']['rowId']}}">
      <input type="hidden" name="major_id" value="{{$major->id}}">
      <label style="font-weight: bold;" for="major-name">major: {{$major->name}}</label>
      <div>
         <label>universities and colleges:</label>
         @foreach($unis as $uni)
         <div>
            <label for="{{$uni->id}}">{{$uni->name}} {{$uni->city}}</label>
            <input type="checkbox" name="uni_ids[]" value="{{$uni->id}}" id="{{$uni->id}}" @if($major['ids']['uniId']==$uni->id) checked @endif>
            @foreach($data as $uniId=>$value)
            @if($uniId == $uni->id)
            @foreach($value as $collegeId=>$collegeName)
            <label>{{$collegeName}}</label>
            <input type="radio" name="{{$uni->id}}" value="{{$collegeId}}" @if($major['ids']['collegeId']==$collegeId) checked @endif>
            @endforeach
            @endif
            @endforeach
         </div>
         @endforeach
      </div>
      <input type="submit" value="submit">
   </form>
</body>

</html>