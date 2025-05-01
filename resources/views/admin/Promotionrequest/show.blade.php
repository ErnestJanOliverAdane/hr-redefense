@extends('theme.layout')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Promotion Request Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.promotion.index') }}">Promotion Requests</a></li>
            <li class="breadcrumb-item active">Request Details</li>
        </ol>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user me-1"></i>
                        Employee Information
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Full Name:</div>
                            <div class="col-md-8">{{ $employee->full_name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Employee ID:</div>
                            <div class="col-md-8">{{ $employee->employee_id }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Department:</div>
                            <div class="col-md-8">{{ $employee->department }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Position:</div>
                            <div class="col-md-8">{{ $employee->job_title }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Date of Hiring:</div>
                            <div class="col-md-8">{{ $employee->created_at->format('F d, Y') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-graduation-cap me-1"></i>
                        Promotion Request Details
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Current Academic Rank:</div>
                            <div class="col-md-8">{{ $request->previous_rank ?? $request->current_rank }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Requested Academic Rank:</div>
                            <div class="col-md-8">{{ $request->requested_rank }}</div>
                        </div>
                        {{-- <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Date of Last Promotion:</div>
                            <div class="col-md-8">
                                {{ $request->last_promotion_date ? date('F d, Y', strtotime($request->last_promotion_date)) : 'N/A' }}
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Status:</div>
                            <div class="col-md-8">
                                @if ($request->status == 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($request->status == 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($request->status == 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Date Submitted:</div>
                            <div class="col-md-8">{{ $request->created_at->format('F d, Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Justification:</div>
                            <div class="col-md-8">{{ $request->justification ?? 'No justification provided' }}</div>
                        </div>
                        @if ($request->remarks)
                            <div class="row mb-3">
                                <div class="col-md-4 fw-bold">Admin Remarks:</div>
                                <div class="col-md-8">{{ $request->remarks }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-file me-1"></i>
                        Attachments <span class="text-danger">*</span>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Important:</strong> Please review all available attachments before approving or
                            rejecting the
                            promotion request.
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="fw-bold">Certificate of Completion:</p>
                                @if ($request->certificate_path)
                                    <a href="{{ asset('storage/' . $request->certificate_path) }}" target="_blank"
                                        class="btn btn-outline-primary attachment-link" data-attachment="certificate">
                                        <i class="fas fa-file-pdf"></i> View Certificate
                                    </a>
                                @else
                                    <p class="text-muted">No certificate uploaded</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <p class="fw-bold">Certificate Of Earning Units:</p>
                                @if ($request->cert_earning_units_path)
                                    <a href="{{ asset('storage/' . $request->cert_earning_units_path) }}" target="_blank"
                                        class="btn btn-outline-primary attachment-link" data-attachment="earning-units">
                                        <i class="fas fa-file-pdf"></i> View Certificate
                                    </a>
                                @else
                                    <p class="text-muted">No certificate uploaded</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <p class="fw-bold">Transcript of Records (TOR):</p>
                                @if ($request->tor_path)
                                    <a href="{{ asset('storage/' . $request->tor_path) }}" target="_blank"
                                        class="btn btn-outline-primary attachment-link" data-attachment="tor">
                                        <i class="fas fa-file-alt"></i> View Transcript
                                    </a>
                                @else
                                    <p class="text-muted">No transcript uploaded</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="progress mb-3" id="review-progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0%"
                                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                </div>
                                <div id="review-status" class="text-center mb-3 text-danger">
                                    Please review all attachments before approving or rejecting
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @if ($request->status == 'pending')
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <i class="fas fa-check-circle me-1"></i>
                            Approve Request
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.promotion.approve', $request->id) }}" method="POST"
                                id="approvalForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="remarks" class="form-label">Remarks/Comments</label>
                                    <textarea name="remarks" id="remarks" class="form-control" rows="4"
                                        placeholder="Enter any comments regarding this approval"></textarea>
                                </div>
                                <input type="hidden" name="attachments_reviewed" id="attachments_reviewed"
                                    value="false">
                                <button type="submit" class="btn btn-success w-100" id="approve-btn" disabled
                                    onclick="return confirm('Are you sure you want to approve this promotion request?')">
                                    Approve Promotion
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header bg-danger text-white">
                            <i class="fas fa-times-circle me-1"></i>
                            Reject Request
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.promotion.reject', $request->id) }}" method="POST"
                                id="rejectForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="reject_remarks" class="form-label">Reason for Rejection</label>
                                    <textarea name="remarks" id="reject_remarks" class="form-control" rows="4"
                                        placeholder="Enter reason for rejection" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger w-100" id="reject-btn" disabled
                                    onclick="return confirm('Are you sure you want to reject this promotion request?')">
                                    Reject Promotion
                                </button>
                            </form>
                        </div>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-cog me-1"></i>
                        Actions
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.promotion.index') }}" class="btn btn-outline-secondary w-100 mb-2">
                            <i class="fas fa-arrow-left me-1"></i> Back to Pending Requests
                        </a>
                        <a href="{{ route('admin.promotion.approved') }}" class="btn btn-outline-success w-100 mb-2">
                            <i class="fas fa-check me-1"></i> View Approved Requests
                        </a>
                        <a href="{{ route('admin.promotion.rejected') }}" class="btn btn-outline-danger w-100">
                            <i class="fas fa-times me-1"></i> View Rejected Requests
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle attachment review tracking -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Track which attachments have been reviewed
            const reviewedAttachments = {
                'certificate': {{ $request->certificate_path ? 'false' : 'true' }},
                'earning-units': {{ $request->cert_earning_units_path ? 'false' : 'true' }},
                'tor': {{ $request->tor_path ? 'false' : 'true' }}
            };

            // Count total available attachments (excluding non-uploaded)
            const totalAttachments = Object.values(reviewedAttachments).filter(value => value === false).length;
            const attachmentLinks = document.querySelectorAll('.attachment-link');

            // Get both approval and rejection buttons
            const approveBtn = document.getElementById('approve-btn');
            const rejectBtn = document.getElementById('reject-btn');

            // No attachments available, enable buttons immediately
            if (totalAttachments === 0) {
                approveBtn.disabled = false;
                rejectBtn.disabled = false;
                document.getElementById('attachments_reviewed').value = 'true';
                document.getElementById('review-status').textContent = 'No attachments to review';
                document.getElementById('review-status').classList.remove('text-danger');
                document.getElementById('review-status').classList.add('text-success');
                document.querySelector('#review-progress .progress-bar').style.width = '100%';
                document.querySelector('#review-progress .progress-bar').textContent = '100%';
            }

            // When an attachment is clicked, mark it as reviewed
            attachmentLinks.forEach(link => {
                link.addEventListener('click', function() {
                    const attachmentType = this.getAttribute('data-attachment');
                    reviewedAttachments[attachmentType] = true;
                    this.classList.remove('btn-outline-primary');
                    this.classList.add('btn-success');

                    // Update progress
                    updateProgress();
                });
            });

            function updateProgress() {
                // Count reviewed attachments
                const reviewedCount = Object.values(reviewedAttachments).filter(value => value === true).length;
                const percentComplete = Math.round((reviewedCount / Object.keys(reviewedAttachments).length) * 100);

                // Update progress bar
                document.querySelector('#review-progress .progress-bar').style.width = percentComplete + '%';
                document.querySelector('#review-progress .progress-bar').textContent = percentComplete + '%';

                // If all available attachments are reviewed, enable both buttons
                if (reviewedCount === Object.keys(reviewedAttachments).length) {
                    approveBtn.disabled = false;
                    rejectBtn.disabled = false;
                    document.getElementById('attachments_reviewed').value = 'true';
                    document.getElementById('review-status').textContent = 'All attachments reviewed';
                    document.getElementById('review-status').classList.remove('text-danger');
                    document.getElementById('review-status').classList.add('text-success');
                } else {
                    const remaining = Object.keys(reviewedAttachments).length - reviewedCount;
                    document.getElementById('review-status').textContent =
                        `${remaining} attachment(s) left to review`;
                }
            }

            // Form submission validation for approval
            document.getElementById('approvalForm').addEventListener('submit', function(e) {
                if (document.getElementById('attachments_reviewed').value !== 'true') {
                    e.preventDefault();
                    alert('Please review all attachments before approving the promotion request.');
                }
            });

            // Form submission validation for rejection
            document.getElementById('rejectForm').addEventListener('submit', function(e) {
                if (document.getElementById('attachments_reviewed').value !== 'true') {
                    e.preventDefault();
                    alert('Please review all attachments before rejecting the promotion request.');
                }
            });
        });
    </script>
@endsection
