@extends('theme.layout')

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="card card-bordered">
            <div class="card-inner">
                <h5 class="title">Register New Department</h5>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('department.store') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="depart_name">Department Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control @error('depart_name') is-invalid @enderror"
                                id="depart_name" name="depart_name" value="{{ old('depart_name') }}"
                                placeholder="Enter department name" required>
                            @error('depart_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
