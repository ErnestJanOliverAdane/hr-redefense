@extends('employee_theme.layout')

@section('content')
    <?php $employee = Auth::user(); ?>

    @if (!$request)
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <div class="d-flex justify-content-center align-items-center">
                <em class="icon ni ni-note-add" style="font-size: 3em;"></em>
            </div>

            <h4 class="text-center"><span style="font-size: 1.5em; font-weight: bold;">NO REQUEST YET!</span></h4>
            <p class="text-center">Employee ID: {{ $employee->employee_id }}</p>
            <p class="text-center">You haven't submitted any requests.</p>
        </div>
    @else
        @if ($request->isApproved())
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex justify-content-center align-items-center">
                    <em class="icon ni ni-check-circle text-success" style="font-size: 3em;"></em>
                </div>

                <h4 class="text-center mt-3">
                    <span style="font-size: 1.5em; font-weight: bold;">APPROVED!</span>
                </h4>
                <p class="text-center">Your request has been approved.</p>
                <p class="text-center"><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                <hr>
                <p class="text-center mt-3" style="font-size: 1.2em; font-weight: bold; color: #155724;">
                    You may collect your request COE at the HR Office.
                </p>
            </div>
        @elseif($request->isPending())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <div class="d-flex justify-content-center align-items-center">
                    <em class="icon ni ni-alert-circle" style="font-size: 3em;"></em>
                </div>

                <h4 class="text-center"><span style="font-size: 1.5em; font-weight: bold;">PENDING!</span></h4>
                <p class="text-center">Wait for Confirmation</p>
                <p class="text-center">Employee ID: {{ $employee->employee_id }}</p>
            </div>
        @else
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div class="d-flex justify-content-center align-items-center">
                    <em class="icon ni ni-cross-circle" style="font-size: 3em;"></em>
                </div>

                <h4 class="text-center"><span style="font-size: 1.5em; font-weight: bold;">REJECTED!</span></h4>
                <p class="text-center">Your request has been rejected.</p>
                <p class="text-center">Employee ID: {{ $employee->employee_id }}</p>
            </div>
        @endif
    @endif
@endsection
