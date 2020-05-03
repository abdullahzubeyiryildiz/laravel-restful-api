<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Page</title>
</head>
<body>
<h1> {{ $name }}</h1>
Product Id: {{ $id }}, Type: {{ $r_type }} <br>
@if($id == 1)
    1 Numaralı Ürün Gösterilmektedir
@elseif ($id == 2)
    2 Numaralı Ürün Gösterilmektedir.
@else
    Diğer bir Ürün Gösterilmektedir.
@endif

<div>
    @for($i=1; $i<=10; $i++)
        Döngü Değeri {{ $i  }} <br>
    @endfor
</div>
<br>
<div>
    @foreach($categories as $category)
        {{$category}} <br>
    @endforeach
</div>
{{-- Deneme --}}
</body>
</html>
