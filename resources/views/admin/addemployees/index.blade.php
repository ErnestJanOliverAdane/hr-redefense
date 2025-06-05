@extends('theme.layout')
@section('content')
    <h4 class="header">Manage Employee</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>List of employeess added.</p>
        </div>
    </div>


    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-inner">
                        <span style="float: right">
                            <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#registration">
                                <em class="icon ni ni-plus-circle"></em>&ensp;
                                Register New Employee

                            </button>

                        </span>
                        <table class="datatable-init-export nowrap table" data-export-title="Export">
                            <thead>
                                <tr>
                                    <th width="20">#</th>
                                    <th>Employee's ID</th>
                                    <th>Employee Name</th>
                                    <th>Email Address</th>
                                    <th>Job Title</th>
                                    <th>Department/Designation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterlists as $key => $masterlist)
                                    <tr style="cursor: pointer" data-role="{{ $masterlist->role }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $masterlist->employee_id }}</td>
                                        <td>{{ $masterlist->full_name }}</td>
                                        <td>{{ $masterlist->contact_information }}</td>
                                        <td>{{ $masterlist->job_title }}</td>
                                        <td>{{ $masterlist->department }}</td>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="registration">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <a href="#" class="close" data-bs-dismiss="modal">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body">
                    <h1 class="nk-block-title page-title">Register New Employee</h1>
                    <hr class="mt-2 mb-2">

                    {{-- Display success message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Display error messages --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Registration Form --}}
                    <form action="{{ route('addemployees.save') }}" method="POST">
                        @csrf
                        <!-- First Name -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="first_name">First Name <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Specify the First Name here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Enter First Name here..." required value="{{ old('first_name') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="last_name">Last Name <b class="text-danger">*</b></label>
                                    <span class="form-note">Specify the Last Name here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Enter Last Name here..." required value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Middle Initial -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="middle_initial">Middle Initial</label>
                                    <span class="form-note">Specify the Middle Initial here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="middle_initial" name="middle_initial"
                                        placeholder="Enter Middle Initial here..." maxlength="1"
                                        value="{{ old('middle_initial') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information (Email) -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="contact_information">Email Address <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Specify the contact email here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="contact_information"
                                        name="contact_information" placeholder="Enter Email Address here..." required
                                        value="{{ old('contact_information') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Employment Status -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="employment_status">Employment Status <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Select employment status.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" id="employment_status" name="employment_status" required>
                                    <option value="">Select Status</option>
                                    @foreach ($employmentStatuses as $status)
                                        <option value="{{ $status }}">{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Employee Type -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="job_title">Employee Type <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Specify the employee Type here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" id="job_type" name="job_type" required>
                                    <option value="">Select Employee Type</option>
                                    @foreach ($jobTypes as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Job Title (Text Input) -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="job_title">Job Title <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Specify the job title here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="job_title" name="job_title"
                                        placeholder="Enter Job Title here..." required value="{{ old('job_title') }}">
                                </div>
                            </div>
                        </div>


                        <!-- Department (Dropdown) -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="department">Department <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Select the department here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" id="department" name="department" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->depart_name }}">{{ $department->depart_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <!-- Updated Faculty Fields Section -->
                        <div id="faculty-fields" style="display: none;">
                            <!-- Update Field Input (Field of Study) -->
                            <div class="row mt-2 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="current_field">Field (Field of Study) <b
                                                class="text-danger">*</b></label>
                                        <span class="form-note">Specify the field of study.</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <select id="current_field" name="current_field" class="form-control">
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

                            <!-- Update Qualification Dropdown (Indicator) -->
                            <div class="row mt-2 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="current_qual">Qualification (Indicator) <b
                                                class="text-danger">*</b></label>
                                        <span class="form-note">Specify the qualification.</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <select id="current_qual" name="current_qual" class="form-control">
                                        <option value="">Select Indicator</option>
                                        <option value="6-12 units earned, Master's Degree">6-12 units earned, Master's
                                            Degree</option>
                                        <option value="15-18 units earned, Master's Degree">15-18 units earned, Master's
                                            Degree</option>
                                        <option value="24-33 units earned, Master's Degree, Engineer, Medical Doctor">24-33
                                            units earned, Master's Degree, Engineer, Medical Doctor</option>
                                        <option value="CAR, Master's Degree">CAR, Master's Degree</option>
                                        <option
                                            value="Full-fledged Master's Degree with 5 yrs of relevant experience, CPA">
                                            Full-fledged Master's Degree with 5 yrs of relevant experience, CPA</option>
                                        <option value="Full-fledged Master's Degree with at least 9 units in PhD or DM">
                                            Full-fledged Master's Degree with at least 9 units in PhD or DM</option>
                                        <option value="Full-fledged Doctors, Juris Doctors, Lawyers">Full-fledged Doctors,
                                            Juris Doctors, Lawyers</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Current Rank -->
                            <div class="row mt-2 align-center">
                                <div class="col-lg-5">
                                    <div class="form-group">
                                        <label class="form-label" for="current_rank">Final Rank Designation <b
                                                class="text-danger">*</b></label>
                                        <span class="form-note">Select the rank.</span>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <select class="form-control" id="current_rank" name="current_rank">
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


                        <!-- Submit Button -->
                        <div class="row mt-4">
                            <div class="col-lg-5"></div>
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <em class="icon ni ni-save"></em>&ensp;
                                    Submit New Employee
                                </button>
                            </div>
                        </div>
                    </form>


                    <!-- Add auto-select rank based on qualification JavaScript -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Auto-select rank based on qualification
                            document.getElementById('current_qual').addEventListener('change', function() {
                                const qualification = this.value;
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

                                // Set the suggested rank in the dropdown
                                if (suggestedRank) {
                                    const rankDropdown = document.getElementById('current_rank');
                                    for (let i = 0; i < rankDropdown.options.length; i++) {
                                        if (rankDropdown.options[i].value === suggestedRank) {
                                            rankDropdown.options[i].selected = true;
                                            break;
                                        }
                                    }
                                }
                            });
                        });
                    </script>

                    <script>
                        function filterPositionOptions() {
                            const role = document.getElementById("role").value;
                            const staffOptions = document.querySelectorAll(".staff-option");
                            const facultyOptions = document.querySelectorAll(".faculty-option");

                            if (role === "staff") {
                                staffOptions.forEach(option => option.style.display = "block");
                                facultyOptions.forEach(option => option.style.display = "none");
                            } else if (role === "faculty") {
                                staffOptions.forEach(option => option.style.display = "none");
                                facultyOptions.forEach(option => option.style.display = "block");
                            } else {
                                staffOptions.forEach(option => option.style.display = "none");
                                facultyOptions.forEach(option => option.style.display = "none");
                            }
                        }
                    </script>


                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Get the job type select element
                            const jobTypeSelect = document.getElementById('job_type');
                            if (!jobTypeSelect) {
                                console.error("Job type select element not found!");
                                return;
                            }

                            // Function to update form fields visibility
                            function updateFieldsVisibility() {
                                // Get references to all necessary elements
                                const facultyFields = document.getElementById('faculty-fields');
                                const jobTitleRow = document.querySelector('label[for="job_title"]').closest('.row');
                                const departmentRow = document.querySelector('label[for="department"]').closest('.row');

                                // Get references to the actual input elements
                                const jobTitleInput = document.getElementById('job_title');
                                const departmentSelect = document.getElementById('department');

                                // Based on job type selection, show/hide fields
                                if (jobTypeSelect.value === 'Faculty') {
                                    // Show faculty-specific fields
                                    if (facultyFields) {
                                        facultyFields.style.display = 'block';
                                        facultyFields.querySelectorAll('input, select').forEach(input => {
                                            input.setAttribute('required', 'required');
                                        });
                                    }

                                    // Hide job title field
                                    if (jobTitleRow) jobTitleRow.style.cssText = 'display: none !important';

                                    // Since job title is hidden but might be required by backend,
                                    // set a default value to pass validation
                                    if (jobTitleInput) {
                                        jobTitleInput.value = 'Faculty Position'; // Default value for hidden job title
                                    }

                                    // Show department field
                                    if (departmentRow) departmentRow.style.cssText = 'display: flex !important';

                                } else if (jobTypeSelect.value === 'Staff') {
                                    // Hide faculty-specific fields
                                    if (facultyFields) {
                                        facultyFields.style.display = 'none';
                                        facultyFields.querySelectorAll('input, select').forEach(input => {
                                            input.removeAttribute('required');
                                            input.value = '';
                                        });
                                    }

                                    // Show job title field
                                    if (jobTitleRow) jobTitleRow.style.cssText = 'display: flex !important';

                                    // Hide department field
                                    if (departmentRow) departmentRow.style.cssText = 'display: none !important';

                                    // Since department is hidden but still required by backend,
                                    // select the first option or set a default value
                                    if (departmentSelect && departmentSelect.options.length > 0) {
                                        // Select the first non-empty option to satisfy the backend validation
                                        for (let i = 0; i < departmentSelect.options.length; i++) {
                                            if (departmentSelect.options[i].value) {
                                                departmentSelect.selectedIndex = i;
                                                break;
                                            }
                                        }
                                    }

                                } else {
                                    // Default case (no selection)
                                    if (facultyFields) {
                                        facultyFields.style.display = 'none';
                                        facultyFields.querySelectorAll('input, select').forEach(input => {
                                            input.removeAttribute('required');
                                            input.value = '';
                                        });
                                    }

                                    // Show both fields
                                    if (jobTitleRow) jobTitleRow.style.cssText = 'display: flex !important';
                                    if (departmentRow) departmentRow.style.cssText = 'display: flex !important';
                                }
                            }

                            // Set up the change event handler
                            jobTypeSelect.addEventListener('change', updateFieldsVisibility);

                            // Run it immediately if there's a value already selected
                            updateFieldsVisibility();

                            // Also run just before form submission to ensure hidden fields have values
                            const form = jobTypeSelect.closest('form');
                            if (form) {
                                form.addEventListener('submit', function(e) {
                                    // Update field values one last time before submitting
                                    updateFieldsVisibility();
                                });
                            }
                        });
                    </script>


                </div>
            @endsection
