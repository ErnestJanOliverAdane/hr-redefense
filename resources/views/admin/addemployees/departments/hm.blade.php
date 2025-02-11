@extends('theme.layout')

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Department of Information Technology</h4>
                <div class="nk-block-des">
                    <p>List of employees in the College of Information Technology.</p>
                </div>
            </div>
        </div>
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                    <thead>
                        <tr class="nk-tb-item nk-tb-head">
                            <th class="nk-tb-col"><span class="sub-text">First Name</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Last Name</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Email</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Phone Number</span></th>
                            <th class="nk-tb-col"><span class="sub-text">Department</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr class="nk-tb-item">
                                <td class="nk-tb-col">{{ $employee->emp_first_name }}</td>
                                <td class="nk-tb-col">{{ $employee->emp_last_name }}</td>
                                <td class="nk-tb-col">{{ $employee->emp_email }}</td>
                                <td class="nk-tb-col">{{ $employee->emp_phone_number }}</td>
                                <td class="nk-tb-col">{{ $employee->department->depart_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
