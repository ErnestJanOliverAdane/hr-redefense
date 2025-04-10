@extends('theme.layout')

@section('content')
    <h4 class="header">Manage Approved SO Request</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>List of approved SO requests.</p>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-inner">
                        <table class="datatable-init table table-hover">
                            <thead>
                                <tr>
                                    <th width="20">#</th>
                                    <th>Employee ID</th>
                                    <th>Email</th>
                                    <th>TIN</th>
                                    <th>Purpose</th>
                                    <th>Issue Date</th>
                                    <th>Status</th>
                                    <th width="100" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($so_requests as $key => $so_request)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $so_request->employee_id }}</td>
                                        <td>{{ $so_request->Email }}</td>
                                        <td>{{ $so_request->tin }}</td>
                                        <td>{{ $so_request->purpose }}</td>
                                        <td>{{ \Carbon\Carbon::parse($so_request->created_at)->format('F d, Y') }}</td>
                                        <td>
                                            <span class="badge badge-sm badge-dot has-bg bg-success">
                                                Approved
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-center">
                                            <a href="{{ route('so_request.view', $so_request->soreqid) }}" class="btn btn-primary my-3 text-white">
                                                View
                                            </a>
                                        </td>
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
