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
                        <div class="col-md-4">
                            <label class="form-label">Certificate of Completion</label>
                            <input type="file" name="certificate" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Certificate Of Earning Units</label>
                            <input type="file" name="cert_earning_units" class="form-control">
                        </div>

                        <div class="col-md-4">
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
            const currentRankInput = document.querySelector('input[name="current_rank"]');

            // Define the mapping between qualifications and ranks
            const qualificationRankMap = {
                '6-12 units earned, Master\'s Degree': 'Instructor I',
                '15-18 units earned, Master\'s Degree': 'Instructor II',
                '24-33 units earned, Master\'s Degree, Engineer, Medical Doctor': 'Instructor III',
                'CAR, Master\'s Degree': 'Assistant Professor I',
                'Full-fledged Master\'s Degree with 5 yrs of relevant experience, CPA': 'Assistant Professor II',
                'Full-fledged Master\'s Degree with at least 9 units in PhD or DM': 'Assistant Professor III',
                'Full-fledged Doctors, Juris Doctors, Lawyers': 'Assistant Professor IV'
            };

            // Define qualification hierarchy for easy comparison
            const qualificationHierarchy = [
                '6-12 units earned, Master\'s Degree',
                '15-18 units earned, Master\'s Degree',
                '24-33 units earned, Master\'s Degree, Engineer, Medical Doctor',
                'CAR, Master\'s Degree',
                'Full-fledged Master\'s Degree with 5 yrs of relevant experience, CPA',
                'Full-fledged Master\'s Degree with at least 9 units in PhD or DM',
                'Full-fledged Doctors, Juris Doctors, Lawyers'
            ];

            // Create reverse mapping from rank to qualification
            const rankQualificationMap = {};
            for (const [qualification, rank] of Object.entries(qualificationRankMap)) {
                rankQualificationMap[rank] = qualification;
            }

            // Function to disable qualification options based on current rank with visual indicators
            function updateQualificationOptions() {
                const currentRank = currentRankInput.value.trim();

                // If current rank exists, disable qualifications that match or are below that rank
                if (currentRank && Object.values(qualificationRankMap).includes(currentRank)) {
                    // Get the corresponding qualification for the current rank
                    const currentQual = rankQualificationMap[currentRank];
                    const currentQualIndex = qualificationHierarchy.indexOf(currentQual);

                    // First, reset all options
                    Array.from(qualificationSelect.options).forEach(option => {
                        option.disabled = false;
                        option.style = '';
                    });

                    // Then disable and style options based on hierarchy
                    Array.from(qualificationSelect.options).forEach(option => {
                        if (option.value === '') return; // Skip the placeholder option

                        const optionIndex = qualificationHierarchy.indexOf(option.value);
                        if (optionIndex === -1) return; // Skip if not in hierarchy

                        // Disable if lower or equal level
                        if (optionIndex <= currentQualIndex) {
                            option.disabled = true;
                            option.style.color = '#aaa'; // Gray out disabled options
                        } else {
                            option.disabled = false;
                            // Add visual highlight for available options
                            option.style.backgroundColor = '#e8f4ff';
                            option.style.fontWeight = 'bold';
                            option.style.color = '#0066cc';
                        }
                    });

                    // Reset selection if current selection is disabled
                    if (qualificationSelect.selectedOptions[0] && qualificationSelect.selectedOptions[0].disabled) {
                        qualificationSelect.value = '';
                    }
                }
            }

            // Update requested rank based on qualification with visual indicators
            qualificationSelect.addEventListener('change', function() {
                const qualification = this.value;
                let suggestedRank = qualificationRankMap[qualification] || '';

                // Reset all options styling first
                Array.from(requestedRankSelect.options).forEach(option => {
                    option.style = '';
                });

                // Set the suggested rank
                if (suggestedRank) {
                    for (let i = 0; i < requestedRankSelect.options.length; i++) {
                        if (requestedRankSelect.options[i].value === suggestedRank) {
                            requestedRankSelect.selectedIndex = i;
                            // Highlight the selected option
                            requestedRankSelect.options[i].style.backgroundColor = '#e8f4ff';
                            requestedRankSelect.options[i].style.fontWeight = 'bold';
                            requestedRankSelect.options[i].style.color = '#0066cc';
                            break;
                        }
                    }
                }
            });

            // Initialize qualification validation
            updateQualificationOptions();

            // Function to update requested rank options based on current rank with visual indicators
            function updateRequestedRankOptions() {
                const currentRank = currentRankInput.value.trim();

                // Rank hierarchy for comparison
                const rankHierarchy = [
                    'Instructor I',
                    'Instructor II',
                    'Instructor III',
                    'Assistant Professor I',
                    'Assistant Professor II',
                    'Assistant Professor III',
                    'Assistant Professor IV'
                ];

                // If current rank exists, disable rank options that are equal to or below current rank
                if (currentRank && rankHierarchy.includes(currentRank)) {
                    const currentRankIndex = rankHierarchy.indexOf(currentRank);

                    // First, reset all options
                    Array.from(requestedRankSelect.options).forEach(option => {
                        option.disabled = false;
                        option.style = '';
                    });

                    // Then disable and style options based on hierarchy
                    Array.from(requestedRankSelect.options).forEach(option => {
                        if (option.value === '') return; // Skip the placeholder option

                        const optionRankIndex = rankHierarchy.indexOf(option.value);
                        if (optionRankIndex === -1) return; // Skip if not in hierarchy

                        // Disable if equal or lower rank
                        if (optionRankIndex <= currentRankIndex) {
                            option.disabled = true;
                            option.style.color = '#aaa'; // Gray out disabled options
                        } else {
                            option.disabled = false;
                            // Add visual highlight for available options
                            option.style.backgroundColor = '#e8f4ff';
                            option.style.fontWeight = 'bold';
                            option.style.color = '#0066cc';
                        }
                    });

                    // Reset selection if current selection is disabled
                    if (requestedRankSelect.selectedOptions[0] && requestedRankSelect.selectedOptions[0].disabled) {
                        requestedRankSelect.value = '';
                    }
                }
            }

            // Initialize rank options as well
            updateRequestedRankOptions();

            // Add a note to explain the disabled options
            function addValidationMessage() {
                const currentRank = currentRankInput.value.trim();
                if (!currentRank) return;

                const qualificationHelp = document.createElement('div');
                qualificationHelp.className = 'form-text text-info mt-1';
                qualificationHelp.innerHTML =
                    '<i class="fa fa-info-circle"></i> Options in <strong style="color:#0066cc">blue</strong> are qualifications that would allow you to request a higher rank.';

                // Add after qualification select if not already there
                if (!document.querySelector('.qualification-help')) {
                    qualificationHelp.classList.add('qualification-help');
                    qualificationSelect.parentNode.appendChild(qualificationHelp);
                }
            }

            // Add validation message
            addValidationMessage();
        });
    </script>
@endsection
