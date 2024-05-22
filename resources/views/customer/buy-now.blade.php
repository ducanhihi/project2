@extends('layout.customerApp')

@section('content')

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Checkout</h1>
        </div>
        <!-- Accordion -->
        <div id="shopCartAccordion" class="accordion rounded mb-5">



            <form action="{{ route('customer.buy-save', ['product_id' => $product -> id])}}" class="js-validate" novalidate="novalidate" method="post">
                <div class="row">
                    <div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
                        <div class="pl-lg-3 ">
                            <div class="bg-gray-1 rounded-lg">
                                <!-- Order Summary -->
                                <div class="p-4 mb-4 checkout-table">
                                    <!-- Title -->
                                    <div class="border-bottom border-color-1 mb-5">
                                        <h3 class="section-title mb-0 pb-2 font-size-25">Your order</h3>
                                    </div>
                                    <!-- End Title -->

                                    <!-- Product Content -->
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th class="product-name">Sản phẩm</th>
                                            <th class="product-total">Tổng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="cart_item">
                                        <tr class="cart_item">
                                            <td>{{ $product->name }}&nbsp;<strong class="quantity">× {{ $quantity }}</strong></td>
                                            <td>{{ number_format($product->price * $quantity, 0, ',', '.') }} VNĐ</td>
                                        </tr>

                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Tổng phụ</th>
                                            <td>{{ number_format($product->price, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Phí vận chuyển</th>
                                            <td>Giá cố định 30.000VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng cộng</th>
                                            <td>{{ number_format($product->price + 30000, 0, ',', '.') }} VNĐ</td>
                                        </tr>
                                        </tfoot>
                                    </table>


                                    <!-- End Product Content -->
                                    <div class="border-top border-width-3 border-color-1 pt-3 mb-3">
                                        <!-- Basics Accordion -->
                                        <div id="basicsAccordion1">
                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingOne">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="stylishRadio1"
                                                               name="stylishRadio" checked="">
                                                        <label class="custom-control-label form-label" for="stylishRadio1"
                                                               data-toggle="collapse" data-target="#basicsCollapseOnee"
                                                               aria-expanded="true" aria-controls="basicsCollapseOnee">
                                                            Direct bank transfer
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseOnee"
                                                     class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                     aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order will not be shipped
                                                        until the funds have cleared in our account.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingTwo">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                               id="secondStylishRadio1" name="stylishRadio">
                                                        <label class="custom-control-label form-label"
                                                               for="secondStylishRadio1" data-toggle="collapse"
                                                               data-target="#basicsCollapseTwo" aria-expanded="false"
                                                               aria-controls="basicsCollapseTwo">
                                                            Check payments
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseTwo"
                                                     class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                     aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Please send a check to Store Name, Store Street, Store Town, Store
                                                        State / County, Store Postcode.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingThree">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                               id="thirdstylishRadio1" name="stylishRadio">
                                                        <label class="custom-control-label form-label"
                                                               for="thirdstylishRadio1" data-toggle="collapse"
                                                               data-target="#basicsCollapseThree" aria-expanded="false"
                                                               aria-controls="basicsCollapseThree">
                                                            Cash on delivery
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseThree"
                                                     class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                     aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Pay with cash upon delivery.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingFour">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input"
                                                               id="FourstylishRadio1" name="stylishRadio">
                                                        <label class="custom-control-label form-label"
                                                               for="FourstylishRadio1" data-toggle="collapse"
                                                               data-target="#basicsCollapseFour" aria-expanded="false"
                                                               aria-controls="basicsCollapseFour">
                                                            PayPal <a href="#" class="text-blue">What is PayPal?</a>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseFour"
                                                     class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter"
                                                     aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Pay via PayPal; you can pay with your credit card if you don’t have
                                                        a PayPal account.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->
                                        </div>
                                        <!-- End Basics Accordion -->
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between px-3 mb-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck10"
                                                   required="" data-msg="Please agree terms and conditions."
                                                   data-error-class="u-has-error" data-success-class="u-has-success">
                                            <label class="form-check-label form-label" for="defaultCheck10">
                                                I have read and agree to the website <a href="#" class="text-blue">terms and
                                                    conditions </a>
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <form action="{{ route('customer.buy-save', ['product_id' => $product -> id])}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place
                                            order
                                        </button>
                                    </form>
                                    {{--                                <button type="submit"--}}
                                    {{--                                        class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place--}}
                                    {{--                                    order--}}
                                    {{--                                </button>--}}
                                </div>
                                <!-- End Order Summary -->
                            </div>
                        </div>
                    </div>







                    <div class="col-lg-7 order-lg-1">
                        <div class="pb-7 mb-7">
                            <!-- Title -->
                            <div class="border-bottom border-color-1 mb-5">
                                <h3 class="section-title mb-0 pb-2 font-size-25">Chi Tiết Hóa Đơn</h3>
                            </div>
                            <!-- End Title -->

                            <!-- Billing Form -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Họ Và Tên
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name"  required="" data-msg="Hãy nhập họ và tên của bạn."
                                               data-error-class="u-has-error" data-success-class="u-has-success"
                                               autocomplete="off">
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Số điện thoại
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="phone" required="" data-msg="Hãy nhập số điện thoại."
                                               data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Email
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="email" required=""
                                               data-msg="Hãy nhập địa chỉ email."
                                               data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>
                                    <!-- End Input -->
                                </div>

                                <div class="col-md-6">
                                    <!-- Input -->
                                    <div class="js-form-message mb-6">
                                        <label class="form-label">
                                            Địa chỉ
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control" name="address"
                                               required="" data-msg="Hãy nhập địa chỉ."
                                               data-error-class="u-has-error" data-success-class="u-has-success">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection
