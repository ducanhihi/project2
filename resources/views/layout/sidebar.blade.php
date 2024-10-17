
    <link rel="stylesheet" href="{{asset('bootstrap-5.3.3/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
<nav id="sidebar" class="col-md-3 col-lg-1 d-md-block bg-light sidebar collapse" >
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.home')}}">
                    <i class="bi bi-grid"></i>
                    <span>Báo cáo</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.products')}}">
                    <i class="fa-brands fa-product-hunt"></i>
                    <span>Quản lý sản phẩm</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.categories')}}">
                    <i class="fa-solid fa-list"></i>
                    <span>Quản lý danh mục</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.brands')}}">
                    <i class="fa-solid fa-list"></i>
                    <span>Quản lý thương hiệu</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.users')}}">
                    <i class="fa-solid fa-list"></i>
                    <span>Danh sách người dùng</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('admin.orders')}}">
                    <i class="fa-solid fa-list"></i>
                    <span>Quản lý đơn hàng</span>
                </a>
            </li><!-- End Dashboard Nav -->

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link collapsed" href="{{route('admin.orders')}}">--}}
{{--                    <i class="bi bi-person"></i>--}}
{{--                    <span>Profile</span>--}}
{{--                </a>--}}
{{--            </li><!-- End Profile Page Nav -->--}}





{{--            <li class="nav-heading">Pages</li>--}}

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link collapsed" href="{{route('admin.orders')}}">--}}
{{--                    <i class="bi bi-person"></i>--}}
{{--                    <span>Profile</span>--}}
{{--                </a>--}}
{{--            </li><!-- End Profile Page Nav -->--}}

        </ul>
    </aside><!-- End Sidebar-->
</nav>
<script>
    // hiển thị xem minh dag ở trang nao
    // Lấy URL của trang hiện tại
    var currentUrl = window.location.href;

    // Lặp qua các liên kết trong menu để tìm liên kết tương ứng với trang hiện tại
    var menuLinks = document.querySelectorAll('.nav-link');
    menuLinks.forEach(function(link) {
        // So sánh URL của liên kết với URL của trang hiện tại
        if (link.href === currentUrl) {
            // Thêm một lớp CSS hoặc thay đổi kiểu để làm cho liên kết này hiển thị sáng
            link.parentElement.classList.add('active');
        }
    });
</script>
