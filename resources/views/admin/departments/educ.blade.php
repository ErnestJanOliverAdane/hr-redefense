@extends('theme.layout')

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Department of Education</h4>
                <div class="nk-block-des">
                    <p>List of employees in the College of Education.</p>
                </div>
            </div>
        </div>
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">#</span></th>
                            <th class="nk-tb-col"><span class="sub-text">First Name</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Last Name</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Phone Number</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr class="nk-tb-item">
                            <td class="nk-tb-col">{{ $loop->iteration }}</td>
                            <td class="nk-tb-col">{{ $employee->emp_first_name }}</td>
                            <td class="nk-tb-col">{{ $employee->emp_last_name }}</td>
                            <td class="nk-tb-col">{{ $employee->emp_email }}</td>
                            <td class="nk-tb-col">{{ $employee->emp_phone_number }}</td>
                            <td class="nk-tb-col">
                                <div class="dropdown">
                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                        <ul class="link-list-plain">
                                            <li><a href="#">View Details</a></li>
                                            <li><a href="#">Edit</a></li>
                                            <li><a href="#">Remove</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
