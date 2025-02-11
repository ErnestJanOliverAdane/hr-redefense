@extends('theme.layout')
@section('content')


<div class="container-fluid mt-5">
    <!-- Main Overview Card -->
    

            <!-- Main Activity Table -->
            <div class="card card-bordered">
    <div class="card-inner border-bottom">
        <div class="card-title-group">
            <div class="card-title">
                <h6 class="title">User Activity Log</h6>
            </div>
            <div class="card-tools">
                <div class="form-inline flex-nowrap gx-3">
                    <div class="form-wrap w-150px">
                        <select class="form-select js-select2">
                            <option value="all">All Activities</option>
                        </select>
                    </div>
                    <div class="btn-wrap">
                        <button class="btn btn-icon btn-outline-light">
                            <em class="icon ni ni-calendar"></em>
                        </button>
                    </div>
                    <div class="btn-wrap">
                        <button class="btn btn-icon btn-outline-light">
                            <em class="icon ni ni-download"></em>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-inner">
        <table class="table">
            <thead>
                <tr>
                    <th>EmpID</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="user-avatar xs bg-primary">JD</div>
                            <span class="ms-2">John Doe</span>
                        </div>
                    </td>
                    <td>Login</td>
                    <td>10:32 AM</td>
                    <td>
                        <span class="badge bg-success">Active</span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-icon btn-trigger" data-bs-toggle="dropdown">
                                <em class="icon ni ni-more-h"></em>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt">
                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-send"></em><span>Send Message</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
    <div class="card-inner">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">Showing 1 to 10 of 50 entries</div>
            <ul class="pagination pagination-sm justify-content-center justify-content-md-start">
                <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>
    </div>
</div>
         
@endsection
                    