<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/css/bootstrap.min.css')}}">
    <style>
        /* Google Fonts Import Link */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #c1f7f5;
        }
        .nav-links{
            display: flex;
            align-items: center;
            background: #fff;
            padding: 20px 15px;
            border-radius: 12px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        }
        .nav-links li{
            list-style: none;
            margin: 0 12px;
        }
        .nav-links li a{
            position: relative;
            color: #333;
            font-size: 20px;
            font-weight: 500;
            padding: 6px 0;
            text-decoration: none;
        }
        .nav-links li a:before{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 0%;
            background: #34efdf;
            border-radius: 12px;
            transition: all 0.4s ease;
        }
        .nav-links li a:hover:before{
            width: 100%;
        }
        .nav-links li.center a:before{
            left: 50%;
            transform: translateX(-50%);
        }
        .nav-links li.upward a:before{
            width: 100%;
            bottom: -5px;
            opacity: 0;
        }
        .nav-links li.upward a:hover:before{
            bottom: 0px;
            opacity: 1;
        }
        .nav-links li.forward a:before{
            width: 100%;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.4s ease;
        }
        .nav-links li.forward a:hover:before{
            transform: scaleX(1);
            transform-origin: left;
        }
    </style>
</head>
<body>

<div class="container">
    @yield('content')
    <ul class="nav-links">
        <li><a href="#">Dashboard</a></li>
        <li class="center"><a href="#">Portfolio</a></li>
        <li class="upward"><a href="#">Services</a></li>
        <li class="forward"><a href="#">Feedback</a></li>
    </ul>
</div>

</body>
</html>
