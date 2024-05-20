<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer App</title>
</head>
<body>
<div>
    @include('layout.CssCustomer')
</div>
<div>
    @include('layout.header-customer')
</div>
<div>
    @yield('content')
</div>
<div>
    @include('layout.footer-customer')
</div>
</body>
</html>
