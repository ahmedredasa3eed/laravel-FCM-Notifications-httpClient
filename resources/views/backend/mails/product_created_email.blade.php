<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estore Alarm</title>
</head>
<body>
<h1>New Product Created</h1>
<p>Product Name : {{$event->name_en}}</p>
<p>Product Price : {{$event->price}}</p>
<p>Product Discount : {{$event->discount}}</p>
<p>Product Brand : {{$event->brand->name_en}}</p>
<p>Product Category : {{$event->category->name_en}}</p>
<p>Thanks.....</p>
</body>
</html>
