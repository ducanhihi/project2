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
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{asset('/customer/home')}}">Home</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="shop.html">Accessories</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="shop.html">Headphones</a></li>
                            <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">Ultra Wireless S50 Headphones S50 with Bluetooth</li>
                        </ol>
                    </nav>
                </div>
                <!-- End breadcrumb -->
            </div>
        </div>
        <!-- End breadcrumb -->

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
                                        <span class="ms-1">4.5</span>
                                    </div>
                                    <span class="text-muted"><i
                                            class="fas fa-shopping-basket fa-sm mx-1"></i>{{$product->quantity}} orders</span>
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
                            @endif
                                <form action="{{ route('cart.add', $product->id) }}" method="GET">
                                    @csrf
                                    <div class="d-md-flex align-items-end mb-3">
                                        <div class="max-width-150 mb-4 mb-md-0">
                                            <h6 class="font-size-14">Quantity</h6>
                                            <!-- Quantity -->
                                            <div class="border rounded-pill py-2 px-3 border-color-1">
                                                <div class="js-quantity row align-items-center">
                                                    <div class="col">
                                                        <input name="quantity" class="js-result form-control h-auto border-0 rounded p-0 shadow-none" type="text" value="1">
                                                    </div>
                                                    <div class="col-auto pr-1">
                                                        <a class="js-minus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                            <small class="fas fa-minus btn-icon__inner"></small>
                                                        </a>
                                                        <a class="js-plus btn btn-icon btn-xs btn-outline-secondary rounded-circle border-0" href="javascript:;">
                                                            <small class="fas fa-plus btn-icon__inner"></small>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Quantity -->
                                        </div>
                                        <div class="ml-md-3">
                                            <button type="submit" class="btn px-5 btn-primary-dark transition-3d-hover">
                                                <i class="ec ec-add-to-cart mr-2 font-size-20"></i> Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </main>
                </div>
            </div>
        </section>
        </div>
    </main>
@endsection
