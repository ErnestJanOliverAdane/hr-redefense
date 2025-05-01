@extends('employee_theme.layout')

@section('content')
    <?php $employee = Auth::user(); ?>

    <div class="container my-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Faculty Reranking Request Status</h4>
            </div>

            <div class="card-body">
                @if (!$rankInfo)
                    <div class="alert alert-info fade show" role="alert">
                        <div class="d-flex justify-content-center align-items-center">
                            <em class="icon ni ni-note-add" style="font-size: 3em;"></em>
                        </div>

                        <h4 class="text-center"><span style="font-size: 1.5em; font-weight: bold;">NO REQUEST YET!</span>
                        </h4>
                        <p class="text-center">Employee ID: {{ $employee->employee_id }}</p>
                        <p class="text-center">You haven't submitted any reranking requests.</p>
                        <div class="text-center mt-3">
                            <a href="{{ url('/promotion') }}" class="btn btn-primary">Submit a Request</a>
                        </div>
                    </div>
                @else
                    @if ($rankInfo->status == 'approved')
                        <div class="alert alert-success fade show" role="alert">
                            <div class="d-flex justify-content-center align-items-center">
                                <em class="icon ni ni-check-circle text-success" style="font-size: 3em;"></em>
                            </div>

                            <h4 class="text-center mt-3">
                                <span style="font-size: 1.5em; font-weight: bold;">APPROVED!</span>
                            </h4>
                            <p class="text-center">Your reranking request has been approved.</p>
                            <p class="text-center"><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                            <p class="text-center"><strong>Requested Rank:</strong> {{ $rankInfo->requested_rank }}</p>
                            <p class="text-center"><strong>Submission Date:</strong>
                                {{ $rankInfo->created_at->format('M d, Y') }}</p>
                            <p class="text-center"><strong>Approval Date:</strong>
                                {{ $rankInfo->updated_at->format('M d, Y') }}</p>
                            <hr>
                            <p class="text-center mt-3" style="font-size: 1.2em; font-weight: bold; color: #155724;">
                                Your new academic rank will be effective immediately.
                            </p>
                        </div>
                    @elseif($rankInfo->status == 'pending')
                        <div class="alert alert-warning fade show" role="alert">
                            <div class="d-flex justify-content-center align-items-center">
                                <em class="icon ni ni-alert-circle" style="font-size: 3em;"></em>
                            </div>

                            <h4 class="text-center"><span style="font-size: 1.5em; font-weight: bold;">PENDING!</span></h4>
                            <p class="text-center">Your reranking request is currently under review</p>
                            <p class="text-center"><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                            <p class="text-center"><strong>Current Rank:</strong> {{ $rankInfo->current_rank }}</p>
                            <p class="text-center"><strong>Requested Rank:</strong> {{ $rankInfo->requested_rank }}</p>
                            <p class="text-center"><strong>Submission Date:</strong>
                                {{ $rankInfo->created_at->format('M d, Y') }}</p>
                            <hr>
                            <p class="text-center mt-3" style="font-size: 1.2em; font-weight: bold; color: #856404;">
                                Please wait for confirmation from the HR Department.
                            </p>
                        </div>
                    @else
                        <div class="alert alert-danger fade show" role="alert">
                            <div class="d-flex justify-content-center align-items-center">
                                <em class="icon ni ni-cross-circle" style="font-size: 3em;"></em>
                            </div>

                            <h4 class="text-center"><span style="font-size: 1.5em; font-weight: bold;">REJECTED!</span></h4>
                            <p class="text-center">Your reranking request has been rejected.</p>
                            <p class="text-center"><strong>Employee ID:</strong> {{ $employee->employee_id }}</p>
                            <p class="text-center"><strong>Current Rank:</strong> {{ $rankInfo->current_rank }}</p>
                            <p class="text-center"><strong>Requested Rank:</strong> {{ $rankInfo->requested_rank }}</p>
                            <p class="text-center"><strong>Submission Date:</strong>
                                {{ $rankInfo->created_at->format('M d, Y') }}</p>
                            <p class="text-center"><strong>Response Date:</strong>
                                {{ $rankInfo->updated_at->format('M d, Y') }}</p>
                            @if ($rankInfo->rejection_reason)
                                <p class="text-center"><strong>Reason:</strong> {{ $rankInfo->rejection_reason }}</p>
                            @endif
                            <hr>
                            <p class="text-center mt-3" style="font-size: 1.2em; font-weight: bold; color: #721c24;">
                                Please contact the HR Department for more information.
                            </p>
                            <div class="text-center mt-3">
                                <a href="{{ url('/promotion') }}" class="btn btn-primary">Submit New Request</a>
                            </div>
                        </div>
                    @endif

                    <div class="card mt-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Request Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Full Name:</strong> {{ $employeeInfo->full_name }}</p>
                                    <p><strong>Employee ID:</strong> {{ $employeeInfo->employee_id }}</p>
                                    <p><strong>Department:</strong> {{ $employeeInfo->department }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Current Position:</strong> {{ $employeeInfo->job_title }}</p>
                                    <p><strong>Current Rank:</strong> {{ $rankInfo->current_rank }}</p>
                                    <p><strong>Qualification:</strong> {{ $rankInfo->current_qua }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <p><strong>Requested Rank:</strong> {{ $rankInfo->requested_rank }}</p>
                                    @if ($rankInfo->justification)
                                        <p><strong>Justification:</strong> {{ $rankInfo->justification }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    @if ($rankInfo->certificate_path)
                                        <p><strong>Certificate:</strong> <a
                                                href="{{ Storage::url($rankInfo->certificate_path) }}" target="_blank">View
                                                Certificate</a></p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($rankInfo->tor_path)
                                        <p><strong>Transcript of Records:</strong> <a
                                                href="{{ Storage::url($rankInfo->tor_path) }}" target="_blank">View TOR</a>
                                        </p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    @if ($rankInfo->cert_earning_units_path)
                                        <p><strong>Certificate Of Earning Units:</strong> <a
                                                href="{{ Storage::url($rankInfo->cert_earning_units_path) }}"
                                                target="_blank">View Earning Units</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
