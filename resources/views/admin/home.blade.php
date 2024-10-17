@extends('layout.app')

@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{asset('admin/home')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.get-dashboard-data') }}" method="GET">
                                    <h5 class="card-title">Bán hàng <span>| Số đơn hàng bán được</span></h5>
                                    @php
                                        $dashboardData = app('App\Http\Controllers\ProductsController')->getDashboardData();
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>Hôm nay: {{ $dashboardData['todaySales'] }}</h6>
                                            <h6>Hôm qua: {{ $dashboardData['yesterdaySales'] }}</h6>
                                            @if ($dashboardData['salesChangePercentage'] >= 0)
                                                <span class="text-muted small pt-2 ps-1">Tăng</span><span class="text-success small pt-1 fw-bold">{{ $dashboardData['salesChangePercentage'] }}%</span>
                                                <span class="text-success small pt-1 fw-bold">(+ {{ $dashboardData['salesChangeCount'] }} orders)</span>
                                            @else
                                                <span class="text-muted small pt-2 ps-1">Giảm</span><span class="text-danger small pt-1 fw-bold">{{ abs($dashboardData['salesChangePercentage']) }}%</span>
                                                <span class="text-danger small pt-1 fw-bold">(- {{ abs($dashboardData['salesChangeCount']) }} orders)</span>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>








                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Doanh Thu <span>| Tháng này</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($dashboardData['monthSales'], 0, ',', '.') }} VND</h6>
                                        @if ($dashboardData['salesPercentageChange'] >= 0)
                                            <span class="text-muted small pt-2 ps-1">Tăng</span> <span class="text-success small pt-1 fw-bold">{{ $dashboardData['salesPercentageChange'] }}%</span>
                                        @else
                                            <span class="text-muted small pt-2 ps-1">Giảm</span> <span class="text-danger small pt-1 fw-bold">{{ abs($dashboardData['salesPercentageChange']) }}%</span>
                                        @endif
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Khách hàng <span>| Tài khoản</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $dashboardData['currentYearCustomers'] }}</h6>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div><!-- End Customers Card -->

                    <!-- Reports -->
                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Đơn hàng mới nhất <span>| Tất cả</span></h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Khách hàng</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Ngày đặt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dashboardData['recentOrders'] as $order)
                                        <tr>
                                            <th scope="row"><a href="{{ route('admin.order-detail', $order->id) }}">#{{ $order->id }}</a></th>
                                            <td>{{ $order->name ?? '-' }}</td>
                                            <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                            <td> <p class="badge bg {{ app('App\Http\Controllers\OrderController')->getOrderStatusClass($order['status']) }}"
                                                    style="font-family: Arial, sans-serif;">{{ $order['status'] }}</p></td>
                                            <td style="font-size: small">{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>





                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Top Selling -->
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body pb-0">
                                <h5 class="card-title">Bán chạy <span>| Đặt nhiều nhất trong tháng</span></h5>

                                <table class="table table-borderless">
                                    <thead>
                                    <tr>
                                        <th scope="col">Preview</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Sold</th>
                                        <th scope="col">Revenue</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($dashboardData['allProducts'] as $product)
                                        <tr>
                                            <th scope="row"><a href="#"><img src="{{ $product->image }}" alt=""></a></th>
                                            <td><a href="#" class="text-primary fw-bold">{{ $product->name }}</a></td>
                                            <td>{{ number_format($product->price, 0, ',', '.') }}VND</td>
                                            <td class="fw-bold">{{ $product->total_sold }}</td>
                                            <td>{{ number_format($product->total_revenue, 0, ',', '.') }}VND</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div><!-- End Top Selling -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">


                <!-- Website Traffic -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title"> Thể loại <span>| Được đặt nhiều nhất</span></h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                fetch('{{ route("admin.get-dashboard-data") }}')
                                    .then(response => response.json())
                                    .then(data => {
                                        const trafficData = data.trafficData;
                                        const chartData = trafficData.map(item => ({
                                            value: item.value,
                                            name: item.name
                                        }));

                                        echarts.init(document.querySelector("#trafficChart")).setOption({
                                            tooltip: {
                                                trigger: 'item'
                                            },
                                            legend: {
                                                top: '5%',
                                                left: 'center'
                                            },
                                            series: [{
                                                name: 'Access From',
                                                type: 'pie',
                                                radius: ['40%', '70%'],
                                                avoidLabelOverlap: false,
                                                label: {
                                                    show: false,
                                                    position: 'center'
                                                },
                                                emphasis: {
                                                    label: {
                                                        show: true,
                                                        fontSize: '18',
                                                        fontWeight: 'bold'
                                                    }
                                                },
                                                labelLine: {
                                                    show: false
                                                },
                                                data: chartData
                                            }]
                                        });
                                    });
                            });

                        </script>


                    </div>
                </div><!-- End Website Traffic -->

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>Electro</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="">BKACADelectroMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script>
    $.ajax({
        url: "{{ route('admin.get-dashboard-data') }}",
        method: 'GET',
        success: function(response) {
            $('#todaySales').text(response.todaySales);
            $('#salesPercentageIncrease').text(response.salesPercentageIncrease + '%');
        },
        error: function() {
            alert('Đã xảy ra lỗi khi lấy dữ liệu thống kê.');
        }
    });
</script>
@endsection
