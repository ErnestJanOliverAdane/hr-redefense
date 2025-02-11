<!DOCTYPE html>
<html lang="zxx" class="js">
@include('theme.header')

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="nk-app-root">

        <div class="nk-main ">
            @include('theme.sidemenu')
            <div class="nk-wrap ">
                @include('theme.header-top')
                <div class="nk-content ">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
                @extends('theme.footer')
            </div>
        </div>
    </div>

    <script src="/assets/js/bundle.js?ver=3.0.3"></script>
    <script src="/assets/js/scripts.js?ver=3.0.3"></script>
    <script src="/assets/js/charts/chart-ecommerce.js?ver=3.0.3"></script>
    <script src="/assets/js/charts/chart-lms.js?ver=3.0.3"></script>
    <script src="/assets/js/libs/datatable-btns.js?ver=3.0.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script src="/vendor/assets/js/example-sweetalert.js?ver=3.0.3"></script>


    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Saved Successfully',
                // text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <style>
        .autocomplete-list {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            background: #fff;
            border: 1px solid #ccc;
            width: 100%;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
        }

        .autocomplete-list li {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-list li:hover {
            background-color: #f0f0f0;
        }


        .autocomplete-list {
            position: absolute;
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
            background: white;
            border: 1px solid #e5e9f2;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: none;
            margin-top: 5px;
        }

        .autocomplete-list li {
            padding: 10px 15px;
            border-bottom: 1px solid #e5e9f2;
            cursor: pointer;
        }

        .autocomplete-list li:hover {
            background-color: #f5f6fa;
        }

        .employee-name {
            font-weight: 500;
            color: #364a63;
        }

        .employee-details {
            font-size: 12px;
            color: #8094ae;
            margin-top: 3px;
        }
    </style>


</body>

</html>
