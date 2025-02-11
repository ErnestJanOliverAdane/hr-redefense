@extends('theme.layout')
@section('content')
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Welcome Admin!</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Welcome to your System.</p>
                                </div>
                            </div>
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-target="pageMenu">
                                        <em class="icon ni ni-menu-alt-r"></em>
                                    </a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">

                                            <li>
                                                <div class="drodown">
                                                    <a href="#"
                                                        class="dropdown-toggle btn btn-white btn-dim btn-outline-light"
                                                        data-bs-toggle="dropdown">
                                                        <em class="d-none d-sm-inline icon ni ni-calender-date"></em>
                                                        <span><span class="d-none d-md-inline">Last</span> 30 Days</span>
                                                        <em class="dd-indc icon ni ni-chevron-right"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>Last 30 Days</span></a></li>
                                                            <li><a href="#"><span>Last 6 Months</span></a></li>
                                                            <li><a href="#"><span>Last 1 Years</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em
                                                        class="icon ni ni-reports"></em><span>Reports</span></a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-md-3">
                                <div class="card is-dark h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Total No. of Employees</h6>
                                                {{-- <p class="number">{{ $totalEmployees }}</p> --}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .card .title {
                                    font-size: 18px;
                                    opacity: 0.8;

                                }

                                .card .number {
                                    font-size: 150px;
                                    font-weight: bold;
                                    margin-top: 10px;
                                    line-height: 1;
                                    text-align: center;
                                }
                            </style>


                            <div class="col-xxl-5 col-lg-6" style="width: 75%;">
                                <div class="card card-full overflow-hidden">
                                    <div class="nk-ecwg nk-ecwg4 h-100">
                                        <div class="card-inner flex-grow-1">
                                            <div class="card-title-group mb-4">
                                                <div class="card-title">
                                                    <h6 class="title">Total Counts</h6>
                                                </div>
                                            </div>
                                            <div class="data-group">
                                                <div class="nk-ecwg4-ck">
                                                    <canvas class="ecommerce-doughnut-s1" id="trafficSources"></canvas>
                                                </div>
                                                <ul class="nk-ecwg4-legends">
                                                    <li>
                                                        <div class="title">
                                                            <span class="dot dot-lg sq" data-bg="#9cabff"></span>
                                                            <span>Total Employee</span>
                                                        </div>
                                                        <div class="amount amount-xs">4,305</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">
                                                            <span class="dot dot-lg sq" data-bg="#ffa9ce"></span>
                                                            <span>Added</span>
                                                        </div>
                                                        <div class="amount amount-xs">482</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">
                                                            <span class="dot dot-lg sq" data-bg="#b8acff"></span>
                                                            <span>Removed</span>
                                                        </div>
                                                        <div class="amount amount-xs">859</div>
                                                    </li>
                                                    <li>
                                                        <div class="title">
                                                            <span class="dot dot-lg sq" data-bg="#f9db7b"></span>
                                                            <span>Others</span>
                                                        </div>
                                                        <div class="amount amount-xs">138</div>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-inner card-inner-md bg-light">
                                            <div class="card-note">
                                                <em class="icon ni ni-info-fill"></em>
                                                <span>Total counts generating over past days.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-xxl-6" style="width: 100%; height: 100%">
                                <div class="row g-gs">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Employees Added Matrics</h6>
                                                        <p>In last 30 days employee added</p>
                                                    </div>
                                                    <div class="card-tools">
                                                        <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip"
                                                            data-bs-placement="left" title="Employees Matrics"></em>
                                                    </div>
                                                </div>
                                                <div
                                                    class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                        <div class="nk-sale-data">
                                                            <span class="amount">5490 <span
                                                                    class="change down text-danger ">...</span></span>
                                                            <span class="sub-title">This Month</span>
                                                        </div>
                                                        <div class="nk-sale-data">
                                                            <span class="amount">1480<span
                                                                    class="change up text-success">...</span></span>
                                                            <span class="sub-title">This Week</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-sales-ck sales-revenue">
                                                        <canvas class="student-enrole" id="enrolement"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function quarter(type) {
            $.ajax({
                url: '/api/quarter',
                type: 'POST',
                data: {
                    push_type: type
                },
                success: function(data) {
                    console.log(data);
                    //window.location.href = data;
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
