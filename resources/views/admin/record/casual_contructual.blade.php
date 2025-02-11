@extends('theme.layout')
@section('content')
    <h4 class="header">Manage Employee</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>LIST OF CASUAL/CONTRACTUAL PERSONNEL</p>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-inner">
                        <div class="mb-3">
                            <a href="{{ route('employee.export.excel') }}" class="btn btn-primary">
                                <em class="icon ni ni-file-download"></em>
                                <span>Export to Excel</span>
                            </a>
                        </div>
                        <table id="employeeTable" class="datatable-init-export nowrap table" data-export-title="Export">
                            <thead>
                                <tr>
                                    <th width="20">#</th>
                                    <th>Employee's ID</th>
                                    <th>Employee Name</th>
                                    <th>Email Address</th>
                                    <th>Job Title</th>
                                    <th>Department/Designation</th>
                                    <th>Work Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterlists as $key => $masterlist)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $masterlist['employee_id'] }}</td>
                                        <td>{{ $masterlist['full_name'] }}</td>
                                        <td>{{ $masterlist['contact_information'] }}</td>
                                        <td>{{ $masterlist['job_title'] }}</td>
                                        <td>{{ $masterlist['department'] }}</td>
                                        <td>{{ $masterlist['employment_status'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
