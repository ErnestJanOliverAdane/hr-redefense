@extends('theme.layout')
@section('content')
    <div class="page-wrapper bg-light">
        <!-- Page Content -->
        <div class="content container-fluid py-4">
            <!-- Page Header -->
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="page-title">
                            <h3 class="text-primary fw-bold mb-2">Employee Faculty Update Ranks</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html"
                                            class="text-decoration-none">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Employee Faculty Ranks</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    {{-- <div class="col-auto">
                        <button type="button" class="btn btn-primary rounded-pill shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#updateRankModal">
                            <i class="fas fa-plus-circle me-2"></i>Open Update Rank
                        </button>
                    </div> --}}
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Update Rank Modal -->
            <div class="modal fade" id="updateRankModal" tabindex="-1" aria-labelledby="updateRankModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content shadow">
                        <div class="modal-header bg-light">
                            <h5 class="modal-title fw-bold" id="updateRankModalLabel">
                                <i class="fas fa-user-edit me-2"></i>Update Employee Rank
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <form action="{{ route('rank.update') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <input type="hidden" id="employee_id" name="employee_id">
                                <div class="row g-4">
                                    <!-- Employee Input -->
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="r_emp" class="form-label fw-semibold">Employee</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                <input type="text" id="r_emp" name="r_emp" class="form-control"
                                                    autocomplete="off" placeholder="Search employee..." readonly>
                                            </div>
                                            <ul id="r_emp_results"
                                                class="position-absolute w-100 list-unstyled shadow bg-white rounded-3 mt-1"
                                                style="z-index: 1000; display: none;"></ul>
                                        </div>
                                    </div>

                                    <!-- Update Field Input (Field of Study) -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="updateField" class="form-label fw-semibold">Update Field (Field of
                                                Study)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                                <select id="updateField" name="updated_field" class="form-select">
                                                    <option value="">Select Field of Study</option>
                                                    <option value="Accountancy">Accountancy</option>
                                                    <option value="Agriculture">Agriculture</option>
                                                    <option value="Architecture">Architecture</option>
                                                    <option value="Biology">Biology</option>
                                                    <option value="Business Administration">Business Administration</option>
                                                    <option value="Chemistry">Chemistry</option>
                                                    <option value="Computer Science">Computer Science</option>
                                                    <option value="Economics">Economics</option>
                                                    <option value="Education">Education</option>
                                                    <option value="Engineering">Engineering</option>
                                                    <option value="Environmental Science">Environmental Science</option>
                                                    <option value="Finance">Finance</option>
                                                    <option value="Fine Arts">Fine Arts</option>
                                                    <option value="Forestry">Forestry</option>
                                                    <option value="Health Sciences">Health Sciences</option>
                                                    <option value="History">History</option>
                                                    <option value="Hospitality Management">Hospitality Management</option>
                                                    <option value="Information Technology">Information Technology</option>
                                                    <option value="Law">Law</option>
                                                    <option value="Literature">Literature</option>
                                                    <option value="Management">Management</option>
                                                    <option value="Marine Science">Marine Science</option>
                                                    <option value="Mathematics">Mathematics</option>
                                                    <option value="Medicine">Medicine</option>
                                                    <option value="Music">Music</option>
                                                    <option value="Nursing">Nursing</option>
                                                    <option value="Nutrition">Nutrition</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Philosophy">Philosophy</option>
                                                    <option value="Physical Education">Physical Education</option>
                                                    <option value="Physics">Physics</option>
                                                    <option value="Political Science">Political Science</option>
                                                    <option value="Psychology">Psychology</option>
                                                    <option value="Public Administration">Public Administration</option>
                                                    <option value="Social Sciences">Social Sciences</option>
                                                    <option value="Social Work">Social Work</option>
                                                    <option value="Sociology">Sociology</option>
                                                    <option value="Statistics">Statistics</option>
                                                    <option value="Tourism">Tourism</option>
                                                    <option value="Veterinary Medicine">Veterinary Medicine</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Update Qualification Dropdown (Indicator) -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updateQualification" class="form-label fw-semibold">Update
                                                Qualification (Indicator)</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-certificate"></i></span>
                                                <select id="updateQualification" name="updated_qua" class="form-select">
                                                    <option value="">Select Indicator</option>
                                                    <option value="6-12 units earned, Master's Degree">6-12 units earned,
                                                        Master's Degree</option>
                                                    <option value="15-18 units earned, Master's Degree">15-18 units earned,
                                                        Master's Degree</option>
                                                    <option
                                                        value="24-33 units earned, Master's Degree, Engineer, Medical Doctor">
                                                        24-33 units earned, Master's Degree, Engineer, Medical Doctor
                                                    </option>
                                                    <option value="CAR, Master's Degree">CAR, Master's Degree</option>
                                                    <option
                                                        value="Full-fledged Master's Degree with 5 yrs of relevant experience, CPA">
                                                        Full-fledged Master's Degree with 5 yrs of relevant experience, CPA
                                                    </option>
                                                    <option
                                                        value="Full-fledged Master's Degree with at least 9 units in PhD or DM">
                                                        Full-fledged Master's Degree with at least 9 units in PhD or DM
                                                    </option>
                                                    <option value="Full-fledged Doctors, Juris Doctors, Lawyers">
                                                        Full-fledged Doctors, Juris Doctors, Lawyers</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Rank Dropdown (Final Rank) -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updated_rank" class="form-label fw-semibold">Final Rank
                                                Designation</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-award"></i></span>
                                                <select class="form-select" id="updated_rank" name="updated_rank">
                                                    <option value="">Select Final Rank</option>
                                                    <option value="Instructor I">Instructor I</option>
                                                    <option value="Instructor II">Instructor II</option>
                                                    <option value="Instructor III">Instructor III</option>
                                                    <option value="Assistant Professor I">Assistant Professor I</option>
                                                    <option value="Assistant Professor II">Assistant Professor II</option>
                                                    <option value="Assistant Professor III">Assistant Professor III
                                                    </option>
                                                    <option value="Assistant Professor IV">Assistant Professor IV</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mt-4">
                                    <button type="button" class="btn btn-light me-2"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save me-2"></i>Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable-init-export nowrap table table-hover" id="rankTable"
                            data-export-title="Export">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Employee ID</th>
                                    <th>Full Name</th>
                                    <th>Field</th>
                                    <th>Qualification</th>
                                    <th>Rank (A.Y.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($ranks->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">No faculty records found</td>
                                    </tr>
                                @else
                                    @foreach ($ranks as $rank)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rank->employee_id }}</td>
                                            <td>{{ $rank->first_name }} {{ $rank->last_name }}</td>
                                            <td>{{ $rank->field }}</td>
                                            <td>{{ $rank->qualification }}</td>
                                            <td>
                                                @if (isset($rank->status) && $rank->status == 'approved')
                                                    {{ $rank->requested_rank }}
                                                @else
                                                    {{ $rank->rank }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button type="button" class="btn btn-info rounded-pill shadow-sm me-2" onclick="printTable()">
                            <i class="fas fa-print me-2"></i>Print List
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script src="/assets/js/search.js"></script>

    <script>
        $(document).ready(function() {
            $('#r_emp').on('keyup', function() {
                var query = $(this).val();
                var resultsDiv = $('#r_emp_results');

                if (query.length >= 2) {
                    resultsDiv.html(
                        '<li class="text-center"><div class="spinner-border spinner-border-sm" role="status"></div> Searching...</li>'
                    ).show();

                    $.ajax({
                        url: "{{ route('employees.search') }}",
                        type: "GET",
                        data: {
                            'query': query
                        },
                        success: function(data) {
                            resultsDiv.empty();

                            if (data.length > 0) {
                                $.each(data, function(key, value) {
                                    var fullName = value.first_name + ' ' + value
                                        .last_name;
                                    resultsDiv.append(
                                        '<li class="p-2 hover:bg-gray-100" data-id="' +
                                        value.id + '">' +
                                        '<div class="employee-name">' + fullName +
                                        '</div>' +
                                        '<div class="employee-details">' +
                                        (value.job_type ? value.job_type :
                                            'No Position') + ' • ' +
                                        (value.department ? value.department :
                                            'No Department') +
                                        '</div>' +
                                        '</li>'
                                    );
                                });
                            } else {
                                resultsDiv.html(
                                    '<li class="text-center">No results found</li>');
                            }
                            resultsDiv.show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            resultsDiv.html(
                                '<li class="text-center text-danger">Error occurred while searching</li>'
                            ).show();
                        }
                    });
                } else {
                    resultsDiv.hide();
                }
            });
        });

        // Second search implementation
        $(document).ready(function() {
            var searchTimeout;

            $('#m_emp').on('keyup', function() {
                var query = $(this).val();
                var resultsDiv = $('#m_emp_results');

                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    resultsDiv.hide().empty();
                    return;
                }

                resultsDiv.html(
                    '<li class="text-center"><div class="spinner-border spinner-border-sm" role="status"></div> Searching...</li>'
                ).show();

                searchTimeout = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('masterlist.search') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            resultsDiv.empty();

                            if (data.length > 0) {
                                data.forEach(function(employee) {
                                    var fullName = employee.first_name + ' ' +
                                        employee.last_name;
                                    var listItem = $('<li>')
                                        .attr('data-id', employee.id)
                                        .addClass(
                                            'p-2 hover:bg-gray-100 cursor-pointer'
                                        )
                                        .html(
                                            '<div class="employee-name">' +
                                            fullName + '</div>' +
                                            '<div class="employee-details">' +
                                            (employee.job_type ? employee
                                                .job_type : 'No Position') +
                                            ' • ' +
                                            (employee.department ? employee
                                                .department : 'No Department') +
                                            '</div>'
                                        );
                                    resultsDiv.append(listItem);
                                });
                            } else {
                                resultsDiv.html(
                                    '<li class="text-center">No results found</li>');
                            }
                            resultsDiv.show();
                        },
                        error: function(xhr, status, error) {
                            console.error('Search error:', error);
                            resultsDiv.html(
                                '<li class="text-center text-danger">Error occurred while searching</li>'
                            ).show();
                        }
                    });
                }, 300);
            });

            // Click handlers for both search results
            $(document).on('click', '#r_emp_results li', function(e) {
                e.stopPropagation();
                if ($(this).data('id')) {
                    var selectedName = $(this).find('.employee-name').text();
                    var selectedId = $(this).data('id');
                    $('#r_emp').val(selectedName);
                    $('#employee_id').val(selectedId); // Add this line to set the ID
                    $('#r_emp_results').hide();
                }
            });

            $(document).on('click', '#m_emp_results li', function(e) {
                e.stopPropagation();
                if ($(this).data('id')) {
                    var selectedName = $(this).find('.employee-name').text();
                    var selectedId = $(this).data('id');
                    $('#m_emp').val(selectedName);
                    $('#masterlist_id').val(selectedId);
                    $('#m_emp_results').hide();
                }
            });

            // Focus handlers
            $('#r_emp, #m_emp').on('focus', function() {
                var query = $(this).val();
                if (query.length >= 2) {
                    $('#' + this.id + '_results').show();
                }
            });

            // Outside click handler
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.form-control-wrap').length) {
                    $('#r_emp_results, #m_emp_results').hide();
                }
            });
        });
        $(document).ready(function() {
            // ==================================================
            // REQUIRED FIELD HANDLING
            // ==================================================

            // Make sure the field is required in the HTML by adding the attribute
            $('#updated_rank').attr('required', 'required');
            $('#updateQualification').attr('required', 'required');

            // Add visual indication of required fields (asterisks)
            if (!$('label[for="updated_rank"]').find('.text-danger').length) {
                $('label[for="updated_rank"]').append('<span class="text-danger ms-1">*</span>');
            }

            if (!$('label[for="updateQualification"]').find('.text-danger').length) {
                $('label[for="updateQualification"]').append('<span class="text-danger ms-1">*</span>');
            }

            // ==================================================
            // QUALIFICATION HIERARCHY ENFORCEMENT
            // ==================================================

            // Variables to store current qualification and rank
            let currentQualification = '';
            let currentRank = '';

            // Define qualification hierarchy (from lowest to highest)
            const qualificationHierarchy = [
                '6-12 units earned, Master\'s Degree',
                '15-18 units earned, Master\'s Degree',
                '24-33 units earned, Master\'s Degree, Engineer, Medical Doctor',
                'CAR, Master\'s Degree',
                'Full-fledged Master\'s Degree with 5 yrs of relevant experience, CPA',
                'Full-fledged Master\'s Degree with at least 9 units in PhD or DM',
                'Full-fledged Doctors, Juris Doctors, Lawyers'
            ];

            // Define rank hierarchy (from lowest to highest)
            const rankHierarchy = [
                'Instructor I',
                'Instructor II',
                'Instructor III',
                'Assistant Professor I',
                'Assistant Professor II',
                'Assistant Professor III',
                'Assistant Professor IV'
            ];

            // When a table row is clicked, populate the modal
            $('#rankTable tbody tr').on('click', function() {
                // Get data from the clicked row
                const employeeId = $(this).find('td:eq(1)').text().trim();
                const fullName = $(this).find('td:eq(2)').text().trim();
                const field = $(this).find('td:eq(3)').text().trim();
                const qualification = $(this).find('td:eq(4)').text().trim();
                const rankValue = $(this).find('td:eq(5)').text().trim();

                // Store current values for later comparison
                currentQualification = qualification;
                currentRank = rankValue;

                // Fill the modal form with the employee's data
                $('#r_emp').val(fullName);
                $('#employee_id').val(employeeId);

                // Set the field value
                if (field && field !== '') {
                    let fieldOption = $('#updateField option').filter(function() {
                        return $(this).val() === field;
                    });

                    if (fieldOption.length) {
                        fieldOption.prop('selected', true);
                    } else {
                        $('#updateField').append(new Option(field, field, false, true));
                    }
                }

                // Apply the hierarchy filtering with visual enhancements
                disableLowerQualifications(qualification);
                disableLowerRanks(rankValue);

                // Set the qualification value
                if (qualification && qualification !== '') {
                    $('#updateQualification').val(qualification);
                }

                // Set the rank value
                if (rankValue && rankValue !== '') {
                    $('#updated_rank').val(rankValue);
                }

                // Open the modal
                $('#updateRankModal').modal('show');
            });

            // Function to disable qualifications lower than current
            function disableLowerQualifications(currentQual) {
                if (!currentQual || !qualificationHierarchy.includes(currentQual)) return;

                const currentIndex = qualificationHierarchy.indexOf(currentQual);

                $('#updateQualification option').each(function() {
                    const optionValue = $(this).val();
                    if (optionValue === '') return; // Skip empty option

                    const optionIndex = qualificationHierarchy.indexOf(optionValue);
                    if (optionIndex === -1) return; // Skip if not in hierarchy

                    // Disable if lower or equal level
                    if (optionIndex <= currentIndex) {
                        $(this).prop('disabled', true);
                        $(this).css('color', '#aaa'); // Gray out disabled options
                    } else {
                        $(this).prop('disabled', false);
                        $(this).css('color', ''); // Reset color for enabled options

                        // Add visual highlight for available options
                        $(this).css({
                            'background-color': '#e8f4ff',
                            'font-weight': 'bold',
                            'color': '#0066cc'
                        });
                    }
                });

            }

            // Function to disable ranks lower than current
            function disableLowerRanks(currentRankVal) {
                if (!currentRankVal || !rankHierarchy.includes(currentRankVal)) return;

                const currentIndex = rankHierarchy.indexOf(currentRankVal);

                $('#updated_rank option').each(function() {
                    const optionValue = $(this).val();
                    if (optionValue === '') return; // Skip empty option

                    const optionIndex = rankHierarchy.indexOf(optionValue);
                    if (optionIndex === -1) return; // Skip if not in hierarchy

                    // Disable if lower or equal level
                    if (optionIndex <= currentIndex) {
                        $(this).prop('disabled', true);
                        $(this).css('color', '#aaa'); // Gray out disabled options
                    } else {
                        $(this).prop('disabled', false);
                        $(this).css('color', ''); // Reset color for enabled options

                        // Add visual highlight for available options
                        $(this).css({
                            'background-color': '#e8f4ff',
                            'font-weight': 'bold',
                            'color': '#0066cc'
                        });
                    }
                });
            }

            // ==================================================
            // AUTO-SELECT RANK BASED ON QUALIFICATION
            // ==================================================

            // Auto-select rank based on qualification
            $('#updateQualification').on('change', function() {
                const qualification = $(this).val();
                let suggestedRank = '';

                // Map qualifications to appropriate ranks
                switch (qualification) {
                    case '6-12 units earned, Master\'s Degree':
                        suggestedRank = 'Instructor I';
                        break;
                    case '15-18 units earned, Master\'s Degree':
                        suggestedRank = 'Instructor II';
                        break;
                    case '24-33 units earned, Master\'s Degree, Engineer, Medical Doctor':
                        suggestedRank = 'Instructor III';
                        break;
                    case 'CAR, Master\'s Degree':
                        suggestedRank = 'Assistant Professor I';
                        break;
                    case 'Full-fledged Master\'s Degree with 5 yrs of relevant experience, CPA':
                        suggestedRank = 'Assistant Professor II';
                        break;
                    case 'Full-fledged Master\'s Degree with at least 9 units in PhD or DM':
                        suggestedRank = 'Assistant Professor III';
                        break;
                    case 'Full-fledged Doctors, Juris Doctors, Lawyers':
                        suggestedRank = 'Assistant Professor IV';
                        break;
                    default:
                        suggestedRank = '';
                }

                // Set the suggested rank in the dropdown - direct value approach
                if (suggestedRank) {
                    // Direct value setting approach
                    $('#updated_rank').val(suggestedRank);

                    // If the value didn't set (because it might be disabled),
                    // check if we need to find a higher rank
                    if ($('#updated_rank').val() !== suggestedRank) {
                        // Find current suggested rank index
                        const suggestedIndex = rankHierarchy.indexOf(suggestedRank);

                        // Try each higher rank until we find one that's not disabled
                        for (let i = suggestedIndex + 1; i < rankHierarchy.length; i++) {
                            const higherRank = rankHierarchy[i];
                            const rankOption = $('#updated_rank option[value="' + higherRank + '"]');

                            if (rankOption.length && !rankOption.prop('disabled')) {
                                $('#updated_rank').val(higherRank);
                                break;
                            }
                        }
                    }
                } else {
                    // If no qualification selected, clear rank
                    $('#updated_rank').val('');
                }
            });

            // ==================================================
            // ENHANCED FORM VALIDATION
            // ==================================================

            // When modal is closed, reset all options
            $('#updateRankModal').on('hidden.bs.modal', function() {
                // Enable all options and reset styling
                $('#updateQualification option, #updated_rank option').prop('disabled', false).css({
                    'background-color': '',
                    'color': '',
                    'font-weight': ''
                });

                // Reset values
                $('#updateQualification, #updated_rank').val('');

                // Reset current values
                currentQualification = '';
                currentRank = '';

                // Remove any validation styling
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            });

            // Add form validation to prevent submission with invalid values
            $('.needs-validation').on('submit', function(e) {
                // Reset validation styling
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();

                // Flag to track validation status
                let isValid = true;

                // Check required fields
                if ($('#updateQualification').val() === '') {
                    e.preventDefault();
                    $('#updateQualification').addClass('is-invalid');
                    $('#updateQualification').after(
                        '<div class="invalid-feedback">Update Qualification is required</div>');
                    isValid = false;
                }

                if ($('#updated_rank').val() === '') {
                    e.preventDefault();
                    $('#updated_rank').addClass('is-invalid');
                    $('#updated_rank').after(
                        '<div class="invalid-feedback">Final Rank Designation is required</div>');
                    isValid = false;
                }

                // Check if anything has changed
                if (isValid && $('#updateQualification').val() === currentQualification && $(
                        '#updated_rank').val() === currentRank) {
                    e.preventDefault();
                    alert('Please make changes before submitting.');
                    return false;
                }

                // Check promotion hierarchy rules
                if (isValid && currentQualification) {
                    const currentQualIndex = qualificationHierarchy.indexOf(currentQualification);
                    const selectedQualIndex = qualificationHierarchy.indexOf($('#updateQualification')
                        .val());

                    if (selectedQualIndex <= currentQualIndex && currentQualIndex !== -1 &&
                        selectedQualIndex !== -1) {
                        e.preventDefault();
                        $('#updateQualification').addClass('is-invalid');
                        $('#updateQualification').after(
                            '<div class="invalid-feedback">You can only select a higher qualification than the current one.</div>'
                        );
                        isValid = false;
                    }
                }

                if (isValid && currentRank) {
                    const currentRankIndex = rankHierarchy.indexOf(currentRank);
                    const selectedRankIndex = rankHierarchy.indexOf($('#updated_rank').val());

                    if (selectedRankIndex <= currentRankIndex && currentRankIndex !== -1 &&
                        selectedRankIndex !== -1) {
                        e.preventDefault();
                        $('#updated_rank').addClass('is-invalid');
                        $('#updated_rank').after(
                            '<div class="invalid-feedback">You can only select a higher rank than the current one.</div>'
                        );
                        isValid = false;
                    }
                }

                return isValid;
            });

            // Add CSS for validation styling
            if (!$('#validation-styles').length) {
                $('<style id="validation-styles">')
                    .prop('type', 'text/css')
                    .html(`
                .is-invalid {
                    border-color: #dc3545 !important;
                    padding-right: calc(1.5em + 0.75rem) !important;
                    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e") !important;
                    background-repeat: no-repeat !important;
                    background-position: right calc(0.375em + 0.1875rem) center !important;
                    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem) !important;
                }

                .invalid-feedback {
                    display: block;
                    width: 100%;
                    margin-top: 0.25rem;
                    font-size: 80%;
                    color: #dc3545;
                }
            `)
                    .appendTo('head');
            }
        });
    </script>

    <script>
        function printTable() {
            // Create a new window for printing
            const printWindow = window.open('', '_blank');

            // Create the print content with basic styling
            const printContent = `
            <html>
            <head>
                <title></title>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f5f5f5;
                    }
                    h3 {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    @media print {
                        @page {
                            margin: 2cm;
                        }
                    }
                </style>
            </head>
            <body>
                <h3>Employee Faculty Ranks</h3>
                ${document.getElementById('rankTable').outerHTML}
            </body>
            </html>
        `;

            // Write the content to the new window
            printWindow.document.write(printContent);

            // Wait for content to load then print
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.print();
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            };
        }
    </script>


@endsection
