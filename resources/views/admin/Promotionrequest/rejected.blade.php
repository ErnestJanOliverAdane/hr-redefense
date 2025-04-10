@extends('theme.layout')


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Rejected Promotion Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Rejected Promotion Requests</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Rejected Promotion Requests
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Previous Rank</th>
                            <th>Requested Rank</th>
                            <th>Rejection Date</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->employee_name }}</td>
                                <td>{{ $request->department }}</td>
                                <td>{{ $request->current_rank }}</td>
                                <td>{{ $request->requested_rank }}</td>
                                <td>{{ $request->updated_at->format('M d, Y') }}</td>
                                <td>{{ Str::limit($request->remarks, 30) }}</td>
                                <td>
                                    <a href="{{ route('admin.promotion.show', $request->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No rejected promotion requests found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
