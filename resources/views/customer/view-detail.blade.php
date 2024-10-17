@extends('layout.customerApp')

@section('content')
    <main id="content" role="main">
        <!-- breadcrumb -->
        <div class="bg-gray-13 bg-md-transparent">
            <div class="container">
                <!-- breadcrumb -->
                <div class="my-md-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                    href="{{asset('/customer/home')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                    href="shop.html">Accessories</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a
                                    href="shop.html">Headphones</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Ultra
                                Wireless S50 Headphones S50 with Bluetooth
                            </li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->
        <section class="py-5">
            <div class="container">
                <div class="mb-xl-14 mb-6">
                    <div class="row">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <div id="sliderSyncingNav" class="js-slick-carousel u-slick mb-2" data-infinite="true"
                                 data-arrows-classes="d-none d-lg-inline-block u-slick__arrow-classic u-slick__arrow-centered--y rounded-circle"
                                 data-arrow-left-classes="fas fa-arrow-left u-slick__arrow-classic-inner u-slick__arrow-classic-inner--left ml-lg-2 ml-xl-4"
                                 data-arrow-right-classes="fas fa-arrow-right u-slick__arrow-classic-inner u-slick__arrow-classic-inner--right mr-lg-2 mr-xl-4"
                                 data-nav-for="#sliderSyncingThumb">
                                <div class="js-slide">
                                    <img class="img-fluid" src="{{ asset('image/' . $product->image) }}"
                                         alt="Image Description">
                                </div>
                                @foreach($product->images as $items)
                                    <div class="js-slide">
                                        <img class="img-fluid" src="{{ asset('image/' . $items->URL) }}"
                                             alt="Image Description">
                                    </div>
                                @endforeach
                            </div>

                            <div id="sliderSyncingThumb"
                                 class="js-slick-carousel u-slick u-slick--slider-syncing u-slick--slider-syncing-size u-slick--gutters-1 u-slick--transform-off"
                                 data-infinite="true" data-slides-show="5" data-is-thumbs="true"
                                 data-nav-for="#sliderSyncingNav">
                                <div class="js-slide" style="cursor: pointer;">
                                    <img class="img-fluid" src="{{ asset('image/' . $product->image) }}"
                                         alt="Image Description">
                                </div>
                                @foreach($product->images as $items)
                                    <div class="js-slide" style="cursor: pointer;">
                                        <img class="img-fluid" src="{{ asset('image/' . $items->URL) }}"
                                             alt="Image Description">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if($product)
                            <div class="col-md-7 mb-md-6 mb-lg-0">
                                <div class="mb-2">
                                    <div class="border-bottom mb-3 pb-md-1 pb-3">
                                        <a href="#"
                                           class="font-size-12 text-gray-5 mb-2 d-inline-block">{{ $product->category_name }}</a>
                                        <h2 class="font-size-25 text-lh-1dot2">{{ $product->name }}</h2>
                                        <div class="mb-2">
                                            <a class="d-inline-flex align-items-center small font-size-15 text-lh-1"
                                               href="#">
                                                <div class="text-warning mr-2">
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="fas fa-star"></small>
                                                    <small class="far fa-star text-muted"></small>
                                                </div>
                                                <span class="text-secondary font-size-13">(3 customer reviews)</span>
                                            </a>
                                        </div>
                                        <div class="d-md-flex align-items-center">
                                            <div class="ml-md-3 text-gray-9 font-size-14">Availability: <span
                                                    class="text-green font-weight-bold">{{$product->quantity}} orders</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-horizontal-center flex-wrap mb-4">
                                        <a href="#" class="text-gray-6 font-size-13 mr-2"><i
                                                class="ec ec-favorites mr-1 font-size-15"></i> Wishlist</a>
                                        <a href="#" class="text-gray-6 font-size-13 ml-2"><i
                                                class="ec ec-compare mr-1 font-size-15"></i> Compare</a>
                                    </div>
                                    <div class="mb-2">
                                        <ul class="font-size-14 pl-3 ml-1 text-gray-110">
                                            {{ $product->description}}
                                        </ul>
                                    </div>
                                    <div class="row">
                                        <dt class="col-3">Mã sản phẩm:</dt>
                                        <dd class="col-9">{{$product->product_code}}</dd>

                                        <dt class="col-3">Thể loại</dt>
                                        <dd class="col-9">{{ $product->category_name }}</dd>

                                        <dt class="col-3">Thương hiệu</dt>
                                        <dd class="col-9">{{ $product->brand_name }}</dd>
                                    </div>
                                    <div class="mb-4">
                                        <div class="d-flex align-items-baseline">
                                            <ins class="font-size-36 text-decoration-none">{{ number_format($product->price),0, ',', '.'}}VNĐ</ins>
                                        </div>
                                    </div>
                                    @endif

                                    @if($product->quantity > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="GET" id="frmQuantity">
                                        @csrf
                                        <input type="hidden"  value="ADD_TO_CART" name="type" id="type" />

                                        <div class="d-md-flex align-items-end mb-3">
                                            <div class="max-width-150 mb-4 mb-md-0">
                                                <h6 class="font-size-14">Quantity</h6>
                                                <!-- Quantity -->
                                                <div class="border rounded-pill py-2 px-3 border-color-1">
                                                    <div class="js-quantity row align-items-center">
                                                        <div class="col">
                                                            <input name="quantity" class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1" data-max-quantity="{{ $product->quantity }}">
                                                        </div>
                                                        <div class="col-auto pr-1">
                                                            <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="#">
                                                                <small class="fas fa-minus btn-icon__inner"></small>
                                                            </a>
                                                            <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="#" data-max-quantity="{{ $product->quantity }}">
                                                                <small class="fas fa-plus btn-icon__inner"></small>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- End Quantity -->
                                            </div>
                                            <div class="ml-md-3">
                                                <button type="submit" id="btnAddToCart" class="btn px-5 btn-primary-dark transition-3d-hover">
                                                    <i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart
                                                </button>
                                                <button type="button" id="btnDatHang" class="btn px-5 btn-primary-dark transition-3d-hover">
                                                    <i class="ec ec-add-to-cart mr-2 font-size-20"></i> Đặt hàng
                                                </button>
                                                <script>
                                                    $(function () {
                                                        $("#btnDatHang").click(function () {

                                                            $("#type").val("DAT_HANG");
                                                            $("#frmQuantity").submit();
                                                        });
                                                    })

                                                    $(function () {
                                                        $("#btnAddToCart").click(function () {

                                                            $("#type").val("ADD_TO_CART");
                                                            $("#frmQuantity").submit();
                                                        });
                                                    })
                                                </script>
                                            </div>
                                        </div>
                                        @else
                                            <button type="submit" class="btn btn-danger" disabled>Hết hàng</button>

                                    </form>
                                    @endif
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>





@endsection
