@extends('employee_theme.layout')

@section('content')
    <div class="container my-5">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Faculty Reranking Request Form</h4>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ url('/promotion/store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Personal Info -->
                    <h5 class="mb-3">Personal Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control"
                                value="{{ $employeeInfo->full_name ?? '' }}" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Employee ID</label>
                            <input type="text" name="employee_id" class="form-control"
                                value="{{ $employeeInfo->employee_id ?? '' }}" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Department</label>
                            <input type="text" name="department" class="form-control"
                                value="{{ $employeeInfo->department ?? '' }}" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control"
                                value="{{ $employeeInfo->job_title ?? '' }}" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Hiring</label>
                            <input type="date" name="date_of_hiring" class="form-control"
                                value="{{ $employeeInfo->created_at ? $employeeInfo->created_at->format('Y-m-d') : '' }}"
                                required readonly>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Rank Info -->
                    <h5 class="mb-3">Academic Rank Information</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Current Academic Rank</label>
                            <input type="text" name="current_rank" class="form-control"
                                value="{{ $rankInfo && $rankInfo->status == 'approved'
                                    ? $rankInfo->requested_rank
                                    : ($rankInfo && $rankInfo->current_rank
                                        ? $rankInfo->current_rank
                                        : '') }}"
                                required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Date of Last Promotion</label>
                            <input type="date" name="last_promotion_date" class="form-control"
                                value="{{ $rankInfo->created_at ? $rankInfo->updated_at->format('Y-m-d') : '' }}" required
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label"> Qualification</label>
                            <select name="current_qua" id="qualificationSelect" class="form-control" required>
                                <option value="">Select Qualification</option>
                                <option value="6-12 units earned, Master's Degree">6-12 units earned, Master's Degree
                                </option>
                                <option value="15-18 units earned, Master's Degree">15-18 units earned, Master's Degree
                                </option>
                                <option value="24-33 units earned, Master's Degree, Engineer, Medical Doctor">24-33 units
                                    earned, Master's Degree, Engineer, Medical Doctor</option>
                                <option value="CAR, Master's Degree">CAR, Master's Degree</option>
                                <option value="Full-fledged Master's Degree with 5 yrs of relevant experience, CPA">
                                    Full-fledged Master's Degree with 5 yrs of relevant experience, CPA</option>
                                <option value="Full-fledged Master's Degree with at least 9 units in PhD or DM">Full-fledged
                                    Master's Degree with at least 9 units in PhD or DM</option>
                                <option value="Full-fledged Doctors, Juris Doctors, Lawyers">Full-fledged Doctors, Juris
                                    Doctors, Lawyers</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Requested Academic Rank</label>
                            <select name="requested_rank" id="requestedRankSelect" class="form-control" required>
                                <option value="">Select Requested Academic Rank</option>
                                <option value="Instructor I">Instructor I</option>
                                <option value="Instructor II">Instructor II</option>
                                <option value="Instructor III">Instructor III</option>
                                <option value="Assistant Professor I">Assistant Professor I</option>
                                <option value="Assistant Professor II">Assistant Professor II</option>
                                <option value="Assistant Professor III">Assistant Professor III</option>
                                <option value="Assistant Professor IV">Assistant Professor IV</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Justification</label>
                            <textarea name="justification" class="form-control" rows="4"></textarea>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Uploads -->
                    <h5 class="mb-3">Attachments</h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Certificate of Completion</label>
                            <input type="file" name="certificate" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Transcript of Records (TOR)</label>
                            <input type="file" name="tor" class="form-control">
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-success">Submit Request</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qualificationSelect = document.getElementById('qualificationSelect');
            const requestedRankSelect = document.getElementById('requestedRankSelect');

            qualificationSelect.addEventListener('change', function() {
                const qualification = this.value;
                let suggestedRank = '';

                // Use includes() for partial string matching
                if (qualification.includes('6-12 units earned, Master\'s Degree')) {
                    suggestedRank = 'Instructor I';
                } else if (qualification.includes('15-18 units earned, Master\'s Degree')) {
                    suggestedRank = 'Instructor II';
                } else if (qualification.includes('24-33 units earned, Master\'s Degree')) {
                    suggestedRank = 'Instructor III';
                } else if (qualification.includes('CAR, Master\'s Degree')) {
                    suggestedRank = 'Assistant Professor I';
                } else if (qualification.includes('Full-fledged Master\'s Degree with 5 yrs of relevant')) {
                    suggestedRank = 'Assistant Professor II';
                } else if (qualification.includes('Full-fledged Master\'s Degree with at least 9 units')) {
                    suggestedRank = 'Assistant Professor III';
                } else if (qualification.includes('Full-fledged Doctors, Juris Doctors')) {
                    suggestedRank = 'Assistant Professor IV';
                }

                // Set the suggested rank
                if (suggestedRank) {
                    for (let i = 0; i < requestedRankSelect.options.length; i++) {
                        if (requestedRankSelect.options[i].value === suggestedRank) {
                            requestedRankSelect.selectedIndex = i;
                            break;
                        }
                    }
                }
            });
        });
    </script>
@endsection
