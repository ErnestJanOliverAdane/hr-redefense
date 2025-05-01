@extends('theme.layout')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Manage Faculty Accounts</h4>
                        </div>
                    </div>

                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <table class="table table-orders">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Employee ID</th>
                                            <th>Full Name</th>
                                            <th>Department</th>
                                            <th>Status</th>
                                            <th>Disabled Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($faculty as $index => $user)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $user->employee_id }}</td>
                                                <td>{{ $user->full_name }}</td>
                                                <td>{{ $user->department }}</td>
                                                <td>
                                                    @if ($user->employment_type === 'disabled')
                                                        <span class="badge badge-dot bg-danger">Disabled</span>
                                                    @else
                                                        <span class="badge badge-dot bg-success">Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($user->disabled_at)
                                                        {{ $user->disabled_at->format('F d, Y \a\t H:i') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td>
                                                    <form method="POST" action="{{ route('faculty.toggle', $user->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-{{ $user->employment_type === 'disabled' ? 'success' : 'danger' }}">
                                                            {{ $user->employment_type === 'disabled' ? 'Enable' : 'Disable' }}
                                                        </button>

                                                    </form>
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
        </div>
    </div>
@endsection
