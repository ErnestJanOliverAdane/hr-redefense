<!DOCTYPE html>
<html lang="zxx" class="js">
@include('employee_theme.header')

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <div class="nk-main ">
            @include('employee_theme.sidemenu')
            <div class="nk-wrap ">
                @include('employee_theme.header-top')
                <div class="nk-content ">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @extends('employee_theme.footer')
            </div>
        </div>
    </div>
    <script src="/assets/js/bundle.js?ver=3.0.3"></script>
    <script src="/assets/js/scripts.js?ver=3.0.3"></script>
    <script src="./assets/js/charts/chart-ecommerce.js?ver=3.0.3"></script>

</body>

</html>
