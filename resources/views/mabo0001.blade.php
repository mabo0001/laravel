<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
</head>
<body>
<br/>
<div>
 <form method="post" enctype="multipart/form-data" action = "uploadMobileMag">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
     <input type="file" name="picture">
     <button type="submit"> mobile提交 </button>
 </form>
 </div>



<br/>
<div>
 <form method="post" enctype="multipart/form-data" action = "uploadBaseMag">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
     <input type="file" name="picture">
     <button type="submit"> base提交 </button>
 </form>
</div>


<br/>
<div>
 <form method="post" enctype="multipart/form-data" action = "uploadCord">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
     <input type="file" name="picture">
     <button type="submit"> Cord提交 </button>
 </form>
</div>

</body>
</html>
