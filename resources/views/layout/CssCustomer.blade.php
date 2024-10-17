<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Css Customer</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../../favicon.png">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/font-awesome/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/css/font-electro.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/animate.css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/hs-megamenu/src/hs.megamenu.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/ion-rangeslider/css/ion.rangeSlider.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/fancybox/jquery.fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/slick-carousel/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">

    <!-- CSS Electro Template -->
    <link rel="stylesheet" href="{{asset('/Css_Customer/assets/css/theme.css')}}">
</head>
<body>

<style>
    .custom-checkbox {
        position: relative;
    }
    .custom-checkbox input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        margin: 5px 0 0 3px;
        z-index: 9;
    }
    .custom-checkbox label:before{
        width: 18px;
        height: 18px;
    }
    .custom-checkbox label:before {
        content: '';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        background: white;
        border: 1px solid #bbb;
        border-radius: 2px;
        box-sizing: border-box;
        z-index: 2;
    }
    .custom-checkbox input[type="checkbox"]:checked + label:after {
        content: '';
        position: absolute;
        left: 6px;
        top: 3px;
        width: 6px;
        height: 11px;
        border: solid #000;
        border-width: 0 3px 3px 0;
        transform: inherit;
        z-index: 3;
        transform: rotateZ(45deg);
    }
    .custom-checkbox input[type="checkbox"]:checked + label:before {
        border-color: #03A9F4;
        background: #03A9F4;
    }
    .custom-checkbox input[type="checkbox"]:checked + label:after {
        border-color: #fff;
    }
    .custom-checkbox input[type="checkbox"]:disabled + label:before {
        color: #b8b8b8;
        cursor: auto;
        box-shadow: none;
        background: #ddd;
    }
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-toggle {
        cursor: pointer;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
    .btn-purple {
        background-color: #6f42c1;
        color: #fff;
    }
</style>


<!-- End Go to Top -->

<!-- JS Global Compulsory -->
<script src="{{asset('/Css_Customer/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/bootstrap/bootstrap.min.js')}}"></script>

<!-- JS Implementing Plugins -->
<script src="{{asset('/Css_Customer/assets/vendor/appear.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/hs-megamenu/src/hs.megamenu.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/svg-injector/dist/svg-injector.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/typed.js/lib/typed.min.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/slick-carousel/slick/slick.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/appear.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>

<!-- JS Electro -->
<script src="{{asset('/Css_Customer/assets/js/hs.core.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.countdown.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.header.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.hamburgers.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.unfold.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.focus-state.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.malihu-scrollbar.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.validation.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.fancybox.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.onscroll-animation.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.slick-carousel.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.quantity-counter.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.range-slider.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.show-animation.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.svg-injector.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.scroll-nav.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.go-to.js')}}"></script>
<script src="{{asset('/Css_Customer/assets/js/components/hs.selectpicker.js')}}"></script>

<!-- JS Plugins Init. -->
<script>
    $(window).on('load', function () {
        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
            event: 'hover',
            direction: 'horizontal',
            pageContainer: $('.container'),
            breakpoint: 767.98,
            hideTimeOut: 0
        });

        // initialization of svg injector module
        $.HSCore.components.HSSVGIngector.init('.js-svg-injector');
    });

    $(document).on('ready', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#header'));

        // initialization of animation
        $.HSCore.components.HSOnScrollAnimation.init('[data-animation]');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            afterOpen: function () {
                $(this).find('input[type="search"]').focus();
            }
        });

        // initialization of HSScrollNav component
        $.HSCore.components.HSScrollNav.init($('.js-scroll-nav'), {
            duration: 700
        });

        // initialization of quantity counter
        $.HSCore.components.HSQantityCounter.init('.js-quantity');


        // initialization of popups
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of countdowns
        var countdowns = $.HSCore.components.HSCountdown.init('.js-countdown', {
            yearsElSelector: '.js-cd-years',
            monthsElSelector: '.js-cd-months',
            daysElSelector: '.js-cd-days',
            hoursElSelector: '.js-cd-hours',
            minutesElSelector: '.js-cd-minutes',
            secondsElSelector: '.js-cd-seconds'
        });

        // initialization of malihu scrollbar
        $.HSCore.components.HSMalihuScrollBar.init($('.js-scrollbar'));

        // initialization of forms
        $.HSCore.components.HSFocusState.init();

        // initialization of form validation
        $.HSCore.components.HSValidation.init('.js-validate', {
            rules: {
                confirmPassword: {
                    equalTo: '#signupPassword'
                }
            }
        });

        // initialization of show animations
        $.HSCore.components.HSShowAnimation.init('.js-animation-link');

        // initialization of fancybox
        $.HSCore.components.HSFancyBox.init('.js-fancybox');

        // initialization of slick carousel
        $.HSCore.components.HSSlickCarousel.init('.js-slick-carousel');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');

        // initialization of hamburgers
        $.HSCore.components.HSHamburgers.init('#hamburgerTrigger');

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'), {
            beforeClose: function () {
                $('#hamburgerTrigger').removeClass('is-active');
            },
            afterClose: function() {
                $('#headerSidebarList .collapse.show').collapse('hide');
            }
        });

        $('#headerSidebarList [data-toggle="collapse"]').on('click', function (e) {
            e.preventDefault();

            var target = $(this).data('target');

            if($(this).attr('aria-expanded') === "true") {
                $(target).collapse('hide');
            } else {
                $(target).collapse('show');
            }
        });

        // initialization of unfold component
        $.HSCore.components.HSUnfold.init($('[data-unfold-target]'));

        // initialization of select picker
        $.HSCore.components.HSSelectPicker.init('.js-select');

    });
    //checkboxx
    $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function(){
            if(this.checked){
                checkbox.each(function(){
                    this.checked = true;
                });
            } else{
                checkbox.each(function(){
                    this.checked = false;
                });
            }
        });
        checkbox.click(function(){
            if(!this.checked){
                $("#selectAll").prop("checked", false);
            }
        });
    });

    function updateSelectedProducts() {
        var selectedProducts = [];
        $('.product-checkbox:checked').each(function() {
            selectedProducts.push($(this).data('product-id'));
        });
        $('input[name="selected_products"]').val(selectedProducts.join(','));
    }
</script>
<script src="{{asset('/adminCSS/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/quill/quill.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('/adminCSS/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('/adminCSS/assets/js/main.js')}}"></script>
<!-- Mirrored from transvelo.github.io/electro-html/2.0/html/home/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 16 Apr 2024 03:25:10 GMT -->
</body>
</html>
