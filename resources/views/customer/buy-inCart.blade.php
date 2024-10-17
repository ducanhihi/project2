@extends('layout.customerApp')

@section('content')

    <div class="container">
        <div class="mb-5">
            <h1 class="text-center">Checkout</h1>
        </div>
        <!-- Accordion -->
        <div id="shopCartAccordion" class="accordion rounded mb-5">


            <form action="{{ route('customer.order-save')}}" class="js-validate" novalidate="novalidate" method="post">
                @csrf
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
                                        @foreach($selectedCartDetails as $cartDetail)
                                            <tr class="cart_item">
                                            <tr class="cart_item">
                                                <td>{{ $cartDetail->product->name }}&nbsp;<strong class="quantity">× {{ $cartDetail->quantity }}</strong></td>
                                                <td>{{ number_format($cartDetail->product->price * $cartDetail->quantity, 0, ',', '.') }} VNĐ</td>

                                            </tr>

                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Phí vận chuyển</th>
                                            <td>Giá cố định 30.000VNĐ</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng cộng</th>
                                            <td>{{ number_format($totalAmount + 30000, 0, ',', '.') }} VNĐ</td>
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
                                                        <input type="radio" class="custom-control-input" id="stylishRadio1" name="payment" value="Chuyển khoản" checked>
                                                        <label class="custom-control-label form-label" for="stylishRadio1" data-toggle="collapse" data-target="#basicsCollapseOnee" aria-expanded="true" aria-controls="basicsCollapseOnee">
                                                            Chuyển Khoản
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseOnee" class="collapse show border-top border-color-1 border-dotted-top bg-dark-lighter" aria-labelledby="basicsHeadingOne" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Thực hiện thanh toán trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng ghi rõ tên, số điện thoại và số ID đơn hàng của bạn. Đơn đặt hàng của bạn sẽ không được vận chuyển cho đến khi tiền đã được chuyển vào trong tài khoản của chúng tôi.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingTwo">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="secondStylishRadio1" name="payment" value="Thanh toán tại cửa hàng">
                                                        <label class="custom-control-label form-label" for="secondStylishRadio1" data-toggle="collapse" data-target="#basicsCollapseTwo" aria-expanded="false" aria-controls="basicsCollapseTwo">
                                                            Thanh toán tại cửa hàng
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseTwo" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter" aria-labelledby="basicsHeadingTwo" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Đến trực tiếp Tòa A17, Tạ Quang Bửu, Hà Nội để thanh toán và nhận hàng, vui lòng đến nhận hàng trong vòng 7 ngày sau khi đặt hàng.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingThree">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="thirdstylishRadio1" name="payment" value="Thanh toán khi nhận hàng">
                                                        <label class="custom-control-label form-label" for="thirdstylishRadio1" data-toggle="collapse" data-target="#basicsCollapseThree" aria-expanded="false" aria-controls="basicsCollapseThree">
                                                            Thanh toán khi nhận hàng
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseThree" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter" aria-labelledby="basicsHeadingThree" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Thanh toán trước tiền cọc 30% giá trị sản phẩm.
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Card -->

                                            <!-- Card -->
                                            <div class="border-bottom border-color-1 border-dotted-bottom">
                                                <div class="p-3" id="basicsHeadingFour">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" id="FourstylishRadio1" name="payment" value="Đặt Trước">
                                                        <label class="custom-control-label form-label" for="FourstylishRadio1" data-toggle="collapse" data-target="#basicsCollapseFour" aria-expanded="false" aria-controls="basicsCollapseFour">
                                                            Đặt Trước
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="basicsCollapseFour" class="collapse border-top border-color-1 border-dotted-top bg-dark-lighter" aria-labelledby="basicsHeadingFour" data-parent="#basicsAccordion1">
                                                    <div class="p-4">
                                                        Thanh toán 50% giá trị sản phẩm: đơn hàng sẽ được giữ tối đa 3 tháng từ lúc đặt hàng.
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
                                                I have read and agree to the website <a href="#" class="text-blue">terms
                                                    and
                                                    conditions </a>
                                                <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                            <!-- End Card -->
                                    @csrf
                                    <input type="hidden" name="selected_products" value="{{ implode(',', $selectedProductIds) }}">
                                    <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3">Place order</button>
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
