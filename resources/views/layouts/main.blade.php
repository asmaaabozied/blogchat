<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.__head')
    @stack('css')
</head>

<body class="sidebar-noneoverflow">

@include('layouts.partials.__nav')

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

@include('layouts.partials.__sidebar')

<!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing" id="root">

            <!-- CONTENT AREA -->
        @yield('content')
        <!-- CONTENT AREA -->
        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © {{now()->format('Y')}} <a target="_blank" href="https://designreset.com">Q8Intouch</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with
                    <i data-feather="heart"></i>
                </p>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

@include('layouts.partials.__footer')
@stack('javascript')
@include('sweetalert::alert')
<script type="text/javascript">
    feather.replace();
</script>
</body>
</html>
