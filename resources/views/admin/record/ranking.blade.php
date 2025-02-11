@extends('theme.layout')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Employee Faculty Update Ranks</h3>
                        <ul class="breadcrumb">
                            {{-- <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li> --}}
                            <li class="breadcrumb-item active">Employee Faculty Ranks</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Search Form -->
            {{-- <form action="{{ route('admin.record.daily') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="full_name" class="form-control" placeholder="Enter Full Name"
                            value="{{ request('full_name') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form> --}}

            @if ($masterlistId)
                <div class="alert alert-success">
                    Masterlist ID for "<strong>{{ request('full_name') }}</strong>" is: <strong>{{ $masterlistId }}</strong>
                </div>
            @elseif(request('full_name'))
                <div class="alert alert-danger">
                    No record found for "<strong>{{ request('full_name') }}</strong>".
                </div>
            @endif
            {{-- <div class="mb-3">
                <button class="btn btn-primary" onclick="printTable()"><em class="icon ni ni-printer-fill"></em>Print
                    Table</button>
            </div> --}}
            <!-- Ranks Table -->
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init-export nowrap table" data-export-title="Export">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Field</th>
                                <th>Current Qualification</th>
                                <th>Current Rank (A.Y.)</th>
                                <th>Updated Field</th>
                                <th>Updated Qualification</th>
                                <th>Updated Rank (A.Y.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ranks as $rank)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $rank->masterlist->first_name ?? '' }} {{ $rank->masterlist->last_name ?? '' }}
                                    </td>
                                    <td>{{ $rank->field }}</td>
                                    <td>{{ $rank->current_qua }}</td>
                                    <td>{{ $rank->current_rank }}</td>
                                    <td>{{ $rank->updated_field }}</td>
                                    <td>{{ $rank->updated_qua }}</td>
                                    <td>{{ $rank->updated_rank }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="printTable()"><em class="icon ni ni-printer-fill"></em>Print Table</button>
    </div>
@endsection
