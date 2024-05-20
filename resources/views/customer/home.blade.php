@extends('layout.customerApp')

@section('content')
<div class="card">
    <div class="row justify-content-between my-4">
        @foreach($allProducts->chunk(4) as $chunk)
            @foreach($chunk as $product)
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <div class="card" style="margin-left: 10px; margin-right: 10px">
                        <img class="card-img-top" src="{{ asset('image/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 230px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            {{--                                <p class="card-text">{{ $product->description }}</p>--}}
                            <p class="card-text">Price: {{ $product->price }}VNĐ</p>
                            {{--                            @if(auth('customer') ->check())--}}
                            <a title="Thêm vào giỏ hàng" href="{{route('cart.add', $product -> id)}}"><i class="fa fa-shopping-cart"></i></a>
                            <a href="#" class="btn btn-dark">
                                <i class="fas fa-cart-shopping" style="color: #91959c;"></i> Buy Now
                            </a>
                            <a href="{{ route('customer.view-detail', ['id' => $product->id]) }}" class="btn btn-outline-dark" style="margin-right:10px">View Details</a>
                            {{--                            @else--}}
                            {{--                                <a title="Thêm vào giỏ hàng" href="{{route('login')}}" onclick="alert('Vui long dang nhap de tiep tuc')"><i class="fa fa-shopping-cart"></i></a>--}}
                            {{--                                <a href="#" class="btn btn-dark">--}}
                            {{--                                    <i class="fas fa-cart-shopping" style="color: #91959c;"></i> Buy Now--}}
                            {{--                                </a>--}}
                            {{--                                <a href="{{ route('login') }}" onclick="alert('Vui long dang nhap de tiep tuc')" class="btn btn-outline-dark" style="margin-right:10px">View Details</a>--}}
                            {{--                            @endif--}}

                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
@endsection
