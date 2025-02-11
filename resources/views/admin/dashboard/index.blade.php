@extends('theme.layout')
@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title"></h3>
                                <div class="nk-block-des text-soft">
                                    <p></p>
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
                                                
                                                    
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Stats -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            
                            <!-- Total Employees -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <div class="card" style="background-color: #9cabff; color: white;">
                                    <div class="card-inner text-center">
                                        <h6 class="title" style="font-weight: bold; font-size: 1.2em;">Total Employees</h6>
                                        <div class="data mt-3">
                                            <span class="amount" style="font-size: 2.5em; font-weight: bold;">{{ $totalemployeescount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Faculties -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <div class="card" style="background-color: #ffa9ce; color: white;">
                                    <div class="card-inner text-center">
                                        <h6 class="title" style="font-weight: bold; font-size: 1.2em;">Total Faculties</h6>
                                        <div class="data mt-3">
                                            <span class="amount" style="font-size: 2.5em; font-weight: bold;">{{ $totalfacultycount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Staffs -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <div class="card" style="background-color: #b8acff; color: white;">
                                    <div class="card-inner text-center">
                                        <h6 class="title" style="font-weight: bold; font-size: 1.2em;">Total Staffs</h6>
                                        <div class="data mt-3">
                                            <span class="amount" style="font-size: 2.5em; font-weight: bold;">{{ $totalstaffcount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pending Request COE -->
                            <div class="col-xxl-3 col-lg-6 col-sm-6">
                                <div class="card" style="background-color: #bababa; color: white;">
                                    <div class="card-inner text-center">
                                        <h6 class="title" style="font-weight: bold; font-size: 1.2em;">Pending Request COE</h6>
                                        <div class="data mt-3">
                                            <span class="amount" style="font-size: 2.5em; font-weight: bold;">{{ $totalcoereqcount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-md-12">
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-2">
                                        <div class="card-title">
                                            <h6 class="title">Employee Added</h6>
                                            <p>In the last 30 days, employees added to the system.</p>
                                        </div>
                                        <div class="card-tools">
                                            <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Employee Enrolment"></em>
                                        </div>
                                    </div>
                                    <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                        <div class="nk-sale-data-group flex-md-nowrap g-4">
                                            <div class="nk-sale-data">
                                                <span class="amount">{{ $thisMonth }} 
                                                    <span class="change down text-danger">
                                                        <em class="icon ni ni-arrow-long-down"></em>16.93%
                                                    </span>
                                                </span>
                                                <span class="sub-title">This Month</span>
                                            </div>
                                            <div class="nk-sale-data">
                                                <span class="amount">{{ $thisWeek }}
                                                    <span class="change up text-success">
                                                        <em class="icon ni ni-arrow-long-up"></em>4.26%
                                                    </span>
                                                </span>
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


                        <!-- <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ctx = document.getElementById('enrolement').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['This Week', 'This Month', 'Last 30 Days'],
                                datasets: [{
                                    label: 'Employees Added',
                                    data: [{{ $thisWeek }}, {{ $thisMonth }}, {{ $last30Days }}],
                                    borderColor: '#4caf50',
                                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                                    pointBackgroundColor: '#4caf50',
                                    tension: 0.3,
                                    fill: true,
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                        ticks: {
                                            color: '#6c757d'
                                        }
                                    },
                                    y: {
                                        grid: {
                                            color: 'rgba(108, 117, 125, 0.1)'
                                        },
                                        ticks: {
                                            color: '#6c757d'
                                        }
                                    }
                                }
                            }
                        });
                    });
                </script>

                </div>
            </div>
        </div>
    </div> -->



@endsection
