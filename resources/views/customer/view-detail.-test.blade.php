<header>
    <style>
        .icon-hover:hover {
            border-color: #3b71ca !important;
            background-color: white !important;
            color: #3b71ca !important;
        }

        .icon-hover:hover i {
            color: #3b71ca !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/css/bootstrap.min.css')}}">

    <!-- Header -->
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                <img style="height: 50px; width: 50px"
                     src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkfpGUONUycXOWZB2sQR0zMIEUAh_vpN7_wCLS6ch37A&s"
                     alt="">
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse"
                    data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <form class="col-12 col-md-4 col-lg-2" method="POST" action="/search">
            @csrf
            <input name="keyword" class="form-control form-control-dark" type="text" placeholder="Search"
                   aria-label="Search">
            <button hidden type="submit" class="btn btn-primary">tommm</button>
        </form>

        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">


            <div class="dropdown">
                @guest
                    <div>
                        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    </div>
                @endguest
                @auth
                    <button class="btn btn-secondary dropdown-toggle"
                            style="height: 70px; color: white; background-color: #333333 " type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                        <p class="me-2">
                            {{ \Illuminate\Support\Facades\Auth::user()->name ?? 'Guest' }}
                        </p>
                    </button>
                @endauth
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Messages</a></li>
                    <li>
                        <form method="post" action="{{route('logout')}}">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Heading -->
</header>
<body>
<h1>Xem chi tiết sản phẩm</h1>

<div class="col-md-10 ml-sm-auto col-lg-12 px-md-4 py-4">
    <nav aria-label="breadcrumb dark">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('customer.home')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Overview</li>
        </ol>
    </nav>
    <!-- content -->
    <section class="py-5">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image"
                           href="{{ asset('image/'.$product->image) }}">
                            <img style="max-width: 100%; max-height: 1000vh; margin: auto;" class="rounded-4 fit"
                                 src="{{ asset('image/'.$product->image) }}"/>
                        </a>
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        @if($product)
                            <h4 class="title text-dark">
                                {{ $product->name }}
                            </h4>
                            <div class="d-flex flex-row my-3">
                                <div class="text-warning mb-1 me-2">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="ms-1">
                4.5
              </span>
                                </div>
                                <span class="text-muted"><i
                                        class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
                                <span class="text-success ms-2">In stock</span>
                            </div>

                            <div class="mb-3">
                                <span class="h5">{{ $product->price }}VNĐ</span>
                                <span class="text-muted">/per box</span>
                            </div>

                            <p>
                                {{ $product->description }}
                            </p>

                            <div class="row">
                                <dt class="col-3">Mã sản phẩm:</dt>
                                <dd class="col-9">{{$product->product_code}}</dd>

                                <dt class="col-3">Thể loại</dt>
                                <dd class="col-9">{{ $product->category_name }}</dd>

                                <dt class="col-3">Thương hiệu</dt>
                                <dd class="col-9">{{ $product->brand_name }}</dd>
                            </div>

                            <hr/>

                            <div class="row mb-4">
                                @endif
                                <div class="col-md-4 col-6 mb-3"><label class="mb-2 d-block">Quantity</label>
                                    <div class="input-group mb-3" style="width: 170px;">
                                        <button class="btn btn-white border border-secondary px-3 decrement-btn"
                                                type="button" id="button-addon1" data-mdb-ripple-color="dark"><i
                                                class="fas fa-minus"></i></button>
                                        <input type="text"
                                               class="form-control text-center border border-secondary quantity-input"
                                               value="1" aria-label="Example text with button addon"
                                               aria-describedby="button-addon1"/>
                                        <button class="btn btn-white border border-secondary px-3 increment-btn"
                                                type="button" id="button-addon2" data-mdb-ripple-color="dark"><i
                                                class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-warning shadow-0"> Buy now </a>
                            {{--                            <a href="{{route('customer.cart')}}" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i>--}}
                            {{--                                Add--}}
                            {{--                                to cart </a>--}}
                    </div>
                </main>
            </div>
        </div>
    </section>
</div>
</body>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous">
</script>
<script> const decrementBtn = document.querySelector('.decrement-btn');
    const incrementBtn = document.querySelector('.increment-btn');
    const quantityInput = document.querySelector('.quantity-input');
    let quantity = 1;
    decrementBtn.addEventListener('click', () => {
        if (quantity > 1) {
            quantity--;
            quantityInput.value = quantity;
        }
    });
    incrementBtn.addEventListener('click', () => {
        quantity++;
        quantityInput.value = quantity;
    });
</script>
<!-- content -->
