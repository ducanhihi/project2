<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page</title>
    <link rel="stylesheet" href="/bootstrap-5.3.3/css/bootstrap.min.css">
</head>
<body>
    <table class="table table-bordered table-hover">
        <tr class="table-active text-center">
            <th>Code</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        @forelse($allProducts as $products)
            <tr>
                <td class="text-center">{{$products->isbn_code}}</td>
                <td class="fw-bold text-center">{{$products->name}}</td>
                <td class="text-center">{{$products->price}}</td>
            </tr>

        @empty
        @endforelse
    </table>
</body>
</html>
