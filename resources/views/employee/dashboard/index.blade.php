@extends('employee_theme.layout')
@section('content')
    <div class="container-fluid mt-5">
        <div class="nk-container-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">

                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                <em class="icon ni ni-menu-alt-r"></em>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="nk-block">
                <div class="card">
                    <div class="card-inner">
                        <div class="text-center">
                            <!-- Profile Picture -->
                            {{-- <div class="user-avatar xl mb-4">
                                <img src="{{ asset('images/default-avatar.jpg') }}" alt="Profile Picture"
                                    class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            </div> --}}

                            <!-- Employee Details -->
                            <div class="user-info mt-3">
                                <h4 class="text-center mb-1">{{ auth()->user()->full_name ?? 'Employee Name' }}</h4>
                                <span class="text-muted">ID: {{ auth()->user()->employee_id ?? 'null' }}</span>
                            </div>

                            <!-- Quick Stats -->
                            <div class="row g-4 mt-4">
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-inner">
                                            <h6 class="card-title">Department</h6>
                                            <span class="fs-15px">{{ auth()->user()->department ?? 'IT Department' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-inner">
                                            <h6 class="card-title">Position</h6>
                                            <span
                                                class="fs-15px">{{ auth()->user()->job_title ?? 'Software Engineer' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-inner">
                                            <h6 class="card-title">Status</h6>
                                            @if (auth()->user()->employment_type === 'disabled')
                                                <span class="badge bg-danger">Disabled</span>
                                            @else
                                                <span class="badge bg-success">Active</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Additional Details -->
                            <div class="row g-4 mt-4">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-inner">
                                            <h6 class="card-title">Contact Information</h6>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <i class="ni ni-mail me-2"></i>
                                                    {{ auth()->user()->contact_information ?? 'employee@example.com' }}
                                                </li>
                                                <li class="list-group-item">
                                                    <i class="ni ni-call me-2"></i>
                                                    {{ $personalInformation->mobile_no ?? '+1234567890' }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-inner">
                                            <h6 class="card-title">Work Information</h6>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <span class="text-muted">Join Date:</span>
                                                    {{ auth()->user()->join_date ?? '01/01/2023' }}
                                                </li>
                                                <li class="list-group-item">
                                                    <span class="text-muted">Employee Type:</span>
                                                    {{ auth()->user()->employment_status ?? 'Full Time' }}
                                                </li>
                                            </ul>
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
@endsection
