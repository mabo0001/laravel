<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
</head>
<body>
 <form method="post" enctype="multipart/form-data" action = "upload">
     <input type="hidden" name="_token" value="{{ csrf_token() }}" />
     <input type="file" name="picture">
     <button type="submit"> 提交 </button>
 </form>

</body>
</html>
