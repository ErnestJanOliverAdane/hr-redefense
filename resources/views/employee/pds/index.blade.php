@extends('employee_theme.layout')
@section('content')

    <div class="container">
        <h2 class="text-center mb-4">PERSONAL DATA SHEET</h2>

        <!-- Auto-save Indicator -->
        <div class="auto-save-indicator" id="autoSaveIndicator">
            <i class="fas fa-check-circle"></i> Auto-saved
        </div>

        <!-- Loading Overlay -->
        <div class="loading-overlay" id="loadingOverlay">
            <div class="loading-spinner"></div>
        </div>

        <!-- Error and Success Messages -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Progress Bar -->
        <div class="progress-wrapper">
            <div class="progress-bar-nav">
                <div class="progress-line" id="progressLine"></div>
                <div class="progress-step active" data-step="1" onclick="goToStep(1)">
                    <div class="progress-step-icon">1</div>
                    <div class="progress-step-title">Personal Info</div>
                </div>
                <div class="progress-step" data-step="2" onclick="goToStep(2)">
                    <div class="progress-step-icon">2</div>
                    <div class="progress-step-title">Family</div>
                </div>
                <div class="progress-step" data-step="3" onclick="goToStep(3)">
                    <div class="progress-step-icon">3</div>
                    <div class="progress-step-title">Education</div>
                </div>
                <div class="progress-step" data-step="4" onclick="goToStep(4)">
                    <div class="progress-step-icon">4</div>
                    <div class="progress-step-title">Eligibility</div>
                </div>
                <div class="progress-step" data-step="5" onclick="goToStep(5)">
                    <div class="progress-step-icon">5</div>
                    <div class="progress-step-title">Work</div>
                </div>
                <div class="progress-step" data-step="6" onclick="goToStep(6)">
                    <div class="progress-step-icon">6</div>
                    <div class="progress-step-title">Others</div>
                </div>
                <div class="progress-step" data-step="7" onclick="goToStep(7)">
                    <div class="progress-step-icon">7</div>
                    <div class="progress-step-title">Review</div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form method="POST"
            action="{{ isset($personalInfo) ? route('personal.data.sheet.update', ['personal_information_id' => $personalInfo->personal_information_id]) : route('personal.data.sheet.store') }}"
            id="multiStepForm">
            @csrf

            <!-- Step 1: Personal Information -->
            <div class="step-content active" id="step-1">
                <h4 class="mb-3">I. PERSONAL INFORMATION <span class="step-badge" style="display: none;">Complete</span>
                </h4>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Surname <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="surname" readonly required
                                    value="{{ old('surname', $personalInfo->surname ?? (auth()->user()->last_name ?? '')) }}">
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" readonly required
                                    value="{{ old('first_name', $personalInfo->first_name ?? (auth()->user()->first_name ?? '')) }}">
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middle_name" readonly
                                    value="{{ old('middle_name', $personalInfo->middle_name ?? (auth()->user()->middle_initial ?? '')) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name Extension (Jr., Sr.)</label>
                                <input type="text" class="form-control" name="name_extension"
                                    value="{{ old('name_extension', $personalInfo->name_extension ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date_of_birth" required
                                    value="{{ old('date_of_birth', $personalInfo->date_of_birth ?? '') }}">
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Place of Birth <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="place_of_birth" required
                                    value="{{ old('place_of_birth', $personalInfo->place_of_birth ?? '') }}">
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sex <span class="text-danger">*</span></label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" value="Male"
                                            required {{ old('sex', $personalInfo->sex ?? '') == 'Male' ? 'checked' : '' }}>
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="sex" value="Female"
                                            required
                                            {{ old('sex', $personalInfo->sex ?? '') == 'Female' ? 'checked' : '' }}>
                                        <label class="form-check-label">Female</label>
                                    </div>
                                </div>
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Civil Status <span class="text-danger">*</span></label>
                                <select class="form-select" name="civil_status" required>
                                    <option value="">Select Status</option>
                                    @foreach (['Single', 'Married', 'Widowed', 'Separated'] as $status)
                                        <option value="{{ $status }}"
                                            {{ old('civil_status', $personalInfo->civil_status ?? '') == $status ? 'selected' : '' }}>
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Height (m)</label>
                                <input type="number" step="0.01" class="form-control" name="height"
                                    value="{{ old('height', $personalInfo->height ?? '') }}" placeholder="e.g., 1.75">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Weight (kg)</label>
                                <input type="number" step="0.1" class="form-control" name="weight"
                                    value="{{ old('weight', $personalInfo->weight ?? '') }}" placeholder="e.g., 65.5">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Blood Type</label>
                                <select class="form-select" name="blood_type">
                                    <option value="">Select Blood Type</option>
                                    @foreach (['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodType)
                                        <option value="{{ $bloodType }}"
                                            {{ old('blood_type', $personalInfo->blood_type ?? '') == $bloodType ? 'selected' : '' }}>
                                            {{ $bloodType }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">GSIS ID No.</label>
                                <input type="text" class="form-control" name="gsis_no"
                                    value="{{ old('gsis_no', $personalInfo->gsis_no ?? '') }}"
                                    placeholder="XX-XXXXXXX-X">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">PAG-IBIG ID No.</label>
                                <input type="text" class="form-control" name="pagibig_no"
                                    value="{{ old('pagibig_no', $personalInfo->pagibig_no ?? '') }}"
                                    placeholder="XXXX-XXXX-XXXX">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">PHILHEALTH No.</label>
                                <input type="text" class="form-control" name="philhealth_no"
                                    value="{{ old('philhealth_no', $personalInfo->philhealth_no ?? '') }}"
                                    placeholder="XX-XXXXXXXXX-X">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">SSS No.</label>
                                <input type="text" class="form-control" name="sss_no"
                                    value="{{ old('sss_no', $personalInfo->sss_no ?? '') }}" placeholder="XX-XXXXXXX-X">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">TIN No.</label>
                                <input type="text" class="form-control" name="tin_no"
                                    value="{{ old('tin_no', $personalInfo->tin_no ?? '') }}" placeholder="XXX-XXX-XXX">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Agency Employee No.</label>
                                <input type="text" class="form-control" name="agency_employee_no"
                                    value="{{ old('agency_employee_no', $personalInfo->agency_employee_no ?? '') }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Citizenship <span class="text-danger">*</span></label>
                                <select class="form-select" name="citizenship" required
                                    onchange="toggleCitizenshipType()">
                                    <option value="">Select Citizenship</option>
                                    <option value="Filipino"
                                        {{ old('citizenship', $personalInfo->citizenship ?? '') == 'Filipino' ? 'selected' : '' }}>
                                        Filipino</option>
                                    <option value="Dual Citizenship"
                                        {{ old('citizenship', $personalInfo->citizenship ?? '') == 'Dual Citizenship' ? 'selected' : '' }}>
                                        Dual Citizenship</option>
                                </select>
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-12 mb-3" id="citizenshipTypeDiv" style="display: none;">
                                <label class="form-label">If holder of dual citizenship:</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="citizenship_type"
                                            value="by birth"
                                            {{ old('citizenship_type', $personalInfo->citizenship_type ?? '') == 'by birth' ? 'checked' : '' }}>
                                        <label class="form-check-label">By birth</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="citizenship_type"
                                            value="by naturalization"
                                            {{ old('citizenship_type', $personalInfo->citizenship_type ?? '') == 'by naturalization' ? 'checked' : '' }}>
                                        <label class="form-check-label">By naturalization</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Residential Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control mb-2" name="residential_address" required
                                    value="{{ old('residential_address', $personalInfo->residential_address ?? '') }}"
                                    placeholder="House/Block/Lot No., Street, Subdivision/Village">
                                <input type="text" class="form-control" name="residential_zip_code" required
                                    value="{{ old('residential_zip_code', $personalInfo->residential_zip_code ?? '') }}"
                                    placeholder="ZIP Code">
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Permanent Address</label>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="sameAsResidential"
                                        onchange="copyResidentialAddress()">
                                    <label class="form-check-label" for="sameAsResidential">
                                        Same as Residential Address
                                    </label>
                                </div>
                                <input type="text" class="form-control mb-2" name="permanent_address"
                                    value="{{ old('permanent_address', $personalInfo->permanent_address ?? '') }}"
                                    placeholder="House/Block/Lot No., Street, Subdivision/Village">
                                <input type="text" class="form-control" name="permanent_zip_code"
                                    value="{{ old('permanent_zip_code', $personalInfo->permanent_zip_code ?? '') }}"
                                    placeholder="ZIP Code">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Telephone No.</label>
                                <input type="text" class="form-control" name="telephone_no"
                                    value="{{ old('telephone_no', $personalInfo->telephone_no ?? '') }}"
                                    placeholder="(XXX) XXX-XXXX">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="mobile_no" required
                                    value="{{ old('mobile_no', $personalInfo->mobile_no ?? '') }}"
                                    placeholder="09XX-XXX-XXXX">
                                <div class="error-message"></div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">E-mail Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" required
                                    value="{{ old('email', $personalInfo->email ?? '') }}"
                                    placeholder="example@email.com">
                                <div class="error-message"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step 2: Family Background -->
            <div class="step-content" id="step-2">
                <h4 class="mb-3">II. FAMILY BACKGROUND <span class="step-badge" style="display: none;">Complete</span>
                </h4>
                <div class="card">
                    <div class="card-body">
                        <!-- Spouse Information -->
                        <h6 class="mb-3 text-primary">Spouse Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Spouse's Surname</label>
                                <input type="text" class="form-control" name="spouse_surname"
                                    value="{{ old('spouse_surname', $personalInfo->familyBackground->spouse_surname ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="spouse_first_name"
                                    value="{{ old('spouse_first_name', $personalInfo->familyBackground->spouse_first_name ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="spouse_middle_name"
                                    value="{{ old('spouse_middle_name', $personalInfo->familyBackground->spouse_middle_name ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name Extension (Jr., Sr.)</label>
                                <input type="text" class="form-control" name="spouse_name_extension"
                                    value="{{ old('spouse_name_extension', $personalInfo->familyBackground->spouse_name_extension ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Occupation</label>
                                <input type="text" class="form-control" name="spouse_occupation"
                                    value="{{ old('spouse_occupation', $personalInfo->familyBackground->spouse_occupation ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employer/Business Name</label>
                                <input type="text" class="form-control" name="spouse_employer"
                                    value="{{ old('spouse_employer', $personalInfo->familyBackground->spouse_employer ?? '') }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Business Address</label>
                                <input type="text" class="form-control" name="spouse_business_address"
                                    value="{{ old('spouse_business_address', $personalInfo->familyBackground->spouse_business_address ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telephone No.</label>
                                <input type="text" class="form-control" name="spouse_telephone"
                                    value="{{ old('spouse_telephone', $personalInfo->familyBackground->spouse_telephone ?? '') }}"
                                    placeholder="(XXX) XXX-XXXX">
                            </div>
                        </div>

                        <!-- Children Information -->
                        <h6 class="mb-3 text-primary mt-4">Children Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name of Children (Write full name and list all)</th>
                                        <th>Date of Birth</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="childrenContainer">
                                    @if (old('children'))
                                        @foreach (old('children') as $index => $child)
                                            <tr class="child-row">
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="children[{{ $index }}][name]"
                                                        value="{{ $child['name'] ?? '' }}"
                                                        placeholder="Child's full name">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control"
                                                        name="children[{{ $index }}][dob]"
                                                        value="{{ $child['dob'] ?? '' }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeChild(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(isset($personalInfo) && $personalInfo->children && $personalInfo->children->count() > 0)
                                        @foreach ($personalInfo->children as $index => $child)
                                            <tr class="child-row">
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="children[{{ $index }}][name]"
                                                        value="{{ $child->name ?? '' }}" placeholder="Child's full name">
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control"
                                                        name="children[{{ $index }}][dob]"
                                                        value="{{ $child->date_of_birth ?? '' }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeChild(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="child-row">
                                            <td>
                                                <input type="text" class="form-control" name="children[0][name]"
                                                    placeholder="Child's full name">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" name="children[0][dob]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeChild(this)">×</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="mb-4">
                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addChild()">
                                    <i class="fas fa-plus"></i> Add Another Child
                                </button>
                            </div>
                        </div>

                        <!-- Father's Information -->
                        <h6 class="mb-3 text-primary mt-4">Father's Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Father's Surname</label>
                                <input type="text" class="form-control" name="father_surname"
                                    value="{{ old('father_surname', $personalInfo->familyBackground->father_surname ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="father_first_name"
                                    value="{{ old('father_first_name', $personalInfo->familyBackground->father_first_name ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="father_middle_name"
                                    value="{{ old('father_middle_name', $personalInfo->familyBackground->father_middle_name ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name Extension (Jr., Sr.)</label>
                                <input type="text" class="form-control" name="father_name_extension"
                                    value="{{ old('father_name_extension', $personalInfo->familyBackground->father_name_extension ?? '') }}">
                            </div>
                        </div>

                        <!-- Mother's Information -->
                        <h6 class="mb-3 text-primary mt-4">Mother's Information</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mother's Maiden Name</label>
                                <input type="text" class="form-control" name="mother_maiden_name"
                                    value="{{ old('mother_maiden_name', $personalInfo->familyBackground->mother_maiden_name ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mother's Surname</label>
                                <input type="text" class="form-control" name="mother_surname"
                                    value="{{ old('mother_surname', $personalInfo->familyBackground->mother_surname ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="mother_first_name"
                                    value="{{ old('mother_first_name', $personalInfo->familyBackground->mother_first_name ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="mother_middle_name"
                                    value="{{ old('mother_middle_name', $personalInfo->familyBackground->mother_middle_name ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step 3: Educational Background -->
            <div class="step-content" id="step-3">
                <h4 class="mb-3">III. EDUCATIONAL BACKGROUND <span class="step-badge"
                        style="display: none;">Complete</span></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Level</th>
                                        <th>Name of School</th>
                                        <th>Basic Education/Degree/Course</th>
                                        <th>Period of Attendance</th>
                                        <th>Highest Level/Units Earned</th>
                                        <th>Year Graduated</th>
                                        <th>Scholarship/Academic Honors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Elementary -->
                                    <tr>
                                        <td><strong>Elementary</strong></td>
                                        <td>
                                            <input type="text" class="form-control" name="elementary_school"
                                                value="{{ old('elementary_school', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->school_name ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="elementary_degree"
                                                value="{{ old('elementary_degree', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->degree_course ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="elementary_from"
                                                    value="{{ old('elementary_from', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->period_from ?? '' : '') }}"
                                                    placeholder="From">
                                                <input type="text" class="form-control" name="elementary_to"
                                                    value="{{ old('elementary_to', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->period_to ?? '' : '') }}"
                                                    placeholder="To">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="elementary_highest_level"
                                                value="{{ old('elementary_highest_level', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->highest_level_earned ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="elementary_year_graduated"
                                                value="{{ old('elementary_year_graduated', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->year_graduated ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="elementary_honors"
                                                value="{{ old('elementary_honors', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->academic_honors ?? '' : '') }}">
                                        </td>
                                    </tr>

                                    <!-- Secondary -->
                                    <tr>
                                        <td><strong>Secondary</strong></td>
                                        <td>
                                            <input type="text" class="form-control" name="secondary_school"
                                                value="{{ old('secondary_school', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->school_name ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="secondary_degree"
                                                value="{{ old('secondary_degree', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->degree_course ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="secondary_from"
                                                    value="{{ old('secondary_from', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->period_from ?? '' : '') }}"
                                                    placeholder="From">
                                                <input type="text" class="form-control" name="secondary_to"
                                                    value="{{ old('secondary_to', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->period_to ?? '' : '') }}"
                                                    placeholder="To">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="secondary_highest_level"
                                                value="{{ old('secondary_highest_level', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->highest_level_earned ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="secondary_year_graduated"
                                                value="{{ old('secondary_year_graduated', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->year_graduated ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="secondary_honors"
                                                value="{{ old('secondary_honors', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->academic_honors ?? '' : '') }}">
                                        </td>
                                    </tr>

                                    <!-- Vocational/Trade Course -->
                                    <tr>
                                        <td><strong>Vocational/Trade Course</strong></td>
                                        <td>
                                            <input type="text" class="form-control" name="vocational_school"
                                                value="{{ old('vocational_school', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->school_name ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="vocational_degree"
                                                value="{{ old('vocational_degree', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->degree_course ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="vocational_from"
                                                    value="{{ old('vocational_from', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->period_from ?? '' : '') }}"
                                                    placeholder="From">
                                                <input type="text" class="form-control" name="vocational_to"
                                                    value="{{ old('vocational_to', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->period_to ?? '' : '') }}"
                                                    placeholder="To">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="vocational_highest_level"
                                                value="{{ old('vocational_highest_level', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->highest_level_earned ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="vocational_year_graduated"
                                                value="{{ old('vocational_year_graduated', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->year_graduated ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="vocational_honors"
                                                value="{{ old('vocational_honors', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Vocational')->first()->academic_honors ?? '' : '') }}">
                                        </td>
                                    </tr>

                                    <!-- College -->
                                    <tr>
                                        <td><strong>College</strong></td>
                                        <td>
                                            <input type="text" class="form-control" name="college_school"
                                                value="{{ old('college_school', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->school_name ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="college_degree"
                                                value="{{ old('college_degree', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->degree_course ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="college_from"
                                                    value="{{ old('college_from', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->period_from ?? '' : '') }}"
                                                    placeholder="From">
                                                <input type="text" class="form-control" name="college_to"
                                                    value="{{ old('college_to', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->period_to ?? '' : '') }}"
                                                    placeholder="To">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="college_highest_level"
                                                value="{{ old('college_highest_level', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->highest_level_earned ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="college_year_graduated"
                                                value="{{ old('college_year_graduated', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->year_graduated ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="college_honors"
                                                value="{{ old('college_honors', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'College')->first()->academic_honors ?? '' : '') }}">
                                        </td>
                                    </tr>

                                    <!-- Graduate Studies -->
                                    <tr>
                                        <td><strong>Graduate Studies</strong></td>
                                        <td>
                                            <input type="text" class="form-control" name="graduate_school"
                                                value="{{ old('graduate_school', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->school_name ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="graduate_degree"
                                                value="{{ old('graduate_degree', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->degree_course ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <input type="text" class="form-control" name="graduate_from"
                                                    value="{{ old('graduate_from', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->period_from ?? '' : '') }}"
                                                    placeholder="From">
                                                <input type="text" class="form-control" name="graduate_to"
                                                    value="{{ old('graduate_to', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->period_to ?? '' : '') }}"
                                                    placeholder="To">
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="graduate_highest_level"
                                                value="{{ old('graduate_highest_level', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->highest_level_earned ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="graduate_year_graduated"
                                                value="{{ old('graduate_year_graduated', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->year_graduated ?? '' : '') }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="graduate_honors"
                                                value="{{ old('graduate_honors', isset($personalInfo) && $personalInfo->educationalBackground ? $personalInfo->educationalBackground->where('level', 'Graduate')->first()->academic_honors ?? '' : '') }}">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Civil Service Eligibility -->
            <div class="step-content" id="step-4">
                <h4 class="mb-3">IV. CIVIL SERVICE ELIGIBILITY <span class="step-badge"
                        style="display: none;">Complete</span></h4>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Eligibility</th>
                                        <th>Rating</th>
                                        <th>Date of Examination</th>
                                        <th>Place of Examination</th>
                                        <th>License Number</th>
                                        <th>Date of Release</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="civilServiceTable">
                                    @if (old('eligibility'))
                                        @foreach (old('eligibility') as $key => $eligibility)
                                            <tr>
                                                <td>
                                                    <input type="text" name="eligibility[]" class="form-control"
                                                        value="{{ $eligibility }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="rating[]" class="form-control"
                                                        value="{{ old('rating.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="exam_date[]" class="form-control"
                                                        value="{{ old('exam_date.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="exam_place[]" class="form-control"
                                                        value="{{ old('exam_place.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="license_number[]" class="form-control"
                                                        value="{{ old('license_number.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="release_date[]" class="form-control"
                                                        value="{{ old('release_date.' . $key) }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(isset($personalInfo) && $personalInfo->civilServiceEligibility)
                                        @foreach ($personalInfo->civilServiceEligibility as $eligibility)
                                            <tr>
                                                <td>
                                                    <input type="text" name="eligibility[]" class="form-control"
                                                        value="{{ $eligibility->eligibility }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="rating[]" class="form-control"
                                                        value="{{ $eligibility->rating }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="exam_date[]" class="form-control"
                                                        value="{{ $eligibility->exam_date }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="exam_place[]" class="form-control"
                                                        value="{{ $eligibility->exam_place }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="license_number[]" class="form-control"
                                                        value="{{ $eligibility->license_number }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="release_date[]" class="form-control"
                                                        value="{{ $eligibility->release_date }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="text" name="eligibility[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="rating[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="date" name="exam_date[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="exam_place[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="license_number[]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="date" name="release_date[]" class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeRow(this)">×</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addCivilService()">
                                <i class="fas fa-plus"></i> Add Civil Service Eligibility
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 5: Work Experience -->
            <div class="step-content" id="step-5">
                <h4 class="mb-3">V. WORK EXPERIENCE <span class="step-badge" style="display: none;">Complete</span>
                </h4>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Inclusive Dates</th>
                                        <th>Position Title</th>
                                        <th>Department/Agency/Office/Company</th>
                                        <th>Monthly Salary</th>
                                        <th>Salary Grade</th>
                                        <th>Status of Appointment</th>
                                        <th>Gov't Service</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="workExperienceTable">
                                    @if (old('work'))
                                        @foreach (old('work.position_title') as $key => $position)
                                            <tr>
                                                <td>
                                                    <input type="date" class="form-control mb-2"
                                                        name="work[from_date][]"
                                                        value="{{ old('work.from_date.' . $key) }}" placeholder="From">
                                                    <input type="date" class="form-control" name="work[to_date][]"
                                                        value="{{ old('work.to_date.' . $key) }}" placeholder="To">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[position_title][]" value="{{ $position }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="work[department][]"
                                                        value="{{ old('work.department.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[monthly_salary][]"
                                                        value="{{ old('work.monthly_salary.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[salary_grade][]"
                                                        value="{{ old('work.salary_grade.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[status_of_appointment][]"
                                                        value="{{ old('work.status_of_appointment.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="work[gov_service][]"
                                                        value="{{ old('work.gov_service.' . $key) }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(isset($personalInfo) && $personalInfo->workExperience)
                                        @foreach ($personalInfo->workExperience as $work)
                                            <tr>
                                                <td>
                                                    <input type="date" class="form-control mb-2"
                                                        name="work[from_date][]" value="{{ $work->from_date }}"
                                                        placeholder="From">
                                                    <input type="date" class="form-control" name="work[to_date][]"
                                                        value="{{ $work->to_date }}" placeholder="To">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[position_title][]"
                                                        value="{{ $work->position_title }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="work[department][]"
                                                        value="{{ $work->department }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[monthly_salary][]"
                                                        value="{{ $work->monthly_salary }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[salary_grade][]" value="{{ $work->salary_grade }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="work[status_of_appointment][]"
                                                        value="{{ $work->status_of_appointment }}">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="work[gov_service][]"
                                                        value="{{ $work->govt_service }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="date" class="form-control mb-2" name="work[from_date][]"
                                                    placeholder="From">
                                                <input type="date" class="form-control" name="work[to_date][]"
                                                    placeholder="To">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="work[position_title][]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="work[department][]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="work[monthly_salary][]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="work[salary_grade][]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    name="work[status_of_appointment][]">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="work[gov_service][]">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeRow(this)">×</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addWork()">
                                <i class="fas fa-plus"></i> Add Work Experience
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 6: Other Information -->
            <div class="step-content" id="step-6">
                <h4 class="mb-3">VI. OTHER INFORMATION <span class="step-badge" style="display: none;">Complete</span>
                </h4>
                <div class="card">
                    <div class="card-body">
                        <!-- Voluntary Work -->
                        <h6 class="mb-3 text-primary">Voluntary Work or Involvement in
                            Civic/Non-Government/People/Voluntary Organizations</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name of Organization</th>
                                        <th>Inclusive Dates</th>
                                        <th>Number of Hours</th>
                                        <th>Position/Nature of Work</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="voluntaryTable">
                                    @if (old('voluntary'))
                                        @foreach (old('voluntary.organization_name') as $key => $org)
                                            <tr>
                                                <td>
                                                    <input type="text" name="voluntary[organization_name][]"
                                                        class="form-control" value="{{ $org }}"
                                                        placeholder="Name of Organization">
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <input type="date" name="voluntary[from_date][]"
                                                            class="form-control"
                                                            value="{{ old('voluntary.from_date.' . $key) }}">
                                                        <input type="date" name="voluntary[to_date][]"
                                                            class="form-control"
                                                            value="{{ old('voluntary.to_date.' . $key) }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="voluntary[number_of_hours][]"
                                                        class="form-control"
                                                        value="{{ old('voluntary.number_of_hours.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="voluntary[position][]"
                                                        class="form-control"
                                                        value="{{ old('voluntary.position.' . $key) }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(isset($personalInfo) && $personalInfo->voluntaryWork)
                                        @foreach ($personalInfo->voluntaryWork as $voluntary)
                                            <tr>
                                                <td>
                                                    <input type="text" name="voluntary[organization_name][]"
                                                        class="form-control" value="{{ $voluntary->organization_name }}"
                                                        placeholder="Name of Organization">
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <input type="date" name="voluntary[from_date][]"
                                                            class="form-control" value="{{ $voluntary->from_date }}">
                                                        <input type="date" name="voluntary[to_date][]"
                                                            class="form-control" value="{{ $voluntary->to_date }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="voluntary[number_of_hours][]"
                                                        class="form-control" value="{{ $voluntary->hours }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="voluntary[position][]"
                                                        class="form-control" value="{{ $voluntary->position }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="text" name="voluntary[organization_name][]"
                                                    class="form-control" placeholder="Name of Organization">
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <input type="date" name="voluntary[from_date][]"
                                                        class="form-control">
                                                    <input type="date" name="voluntary[to_date][]"
                                                        class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" name="voluntary[number_of_hours][]"
                                                    class="form-control" placeholder="Number of Hours">
                                            </td>
                                            <td>
                                                <input type="text" name="voluntary[position][]" class="form-control"
                                                    placeholder="Position / Nature of Work">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeRow(this)">×</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addVoluntary()">
                                <i class="fas fa-plus"></i> Add Voluntary Work
                            </button>
                        </div>

                        <!-- Learning & Development -->
                        <h6 class="mb-3 text-primary">Learning and Development (L&D) Interventions/Training Programs
                            Attended</h6>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Title of Learning and Development Interventions/Training Programs</th>
                                        <th>Inclusive Dates of Attendance</th>
                                        <th>Number of Hours</th>
                                        <th>Type of LD</th>
                                        <th>Conducted/Sponsored By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="learningTable">
                                    @if (old('learning'))
                                        @foreach (old('learning.title') as $key => $title)
                                            <tr>
                                                <td>
                                                    <input type="text" name="learning[title][]" class="form-control"
                                                        value="{{ $title }}">
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <input type="date" name="learning[from_date][]"
                                                            class="form-control"
                                                            value="{{ old('learning.from_date.' . $key) }}">
                                                        <input type="date" name="learning[to_date][]"
                                                            class="form-control"
                                                            value="{{ old('learning.to_date.' . $key) }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="learning[number_of_hours][]"
                                                        class="form-control"
                                                        value="{{ old('learning.number_of_hours.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="learning[type_of_ld][]"
                                                        class="form-control"
                                                        value="{{ old('learning.type_of_ld.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="learning[conducted_by][]"
                                                        class="form-control"
                                                        value="{{ old('learning.conducted_by.' . $key) }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(isset($personalInfo) && $personalInfo->learningDevelopment)
                                        @foreach ($personalInfo->learningDevelopment as $learning)
                                            <tr>
                                                <td>
                                                    <input type="text" name="learning[title][]" class="form-control"
                                                        value="{{ $learning->title }}">
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <input type="date" name="learning[from_date][]"
                                                            class="form-control" value="{{ $learning->from_date }}">
                                                        <input type="date" name="learning[to_date][]"
                                                            class="form-control" value="{{ $learning->to_date }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="number" name="learning[number_of_hours][]"
                                                        class="form-control" value="{{ $learning->hours }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="learning[type_of_ld][]"
                                                        class="form-control" value="{{ $learning->type }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="learning[conducted_by][]"
                                                        class="form-control" value="{{ $learning->conducted_by }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="text" name="learning[title][]" class="form-control">
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <input type="date" name="learning[from_date][]"
                                                        class="form-control">
                                                    <input type="date" name="learning[to_date][]"
                                                        class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" name="learning[number_of_hours][]"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="learning[type_of_ld][]" class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="learning[conducted_by][]"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeRow(this)">×</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addLearning()">
                                <i class="fas fa-plus"></i> Add Learning & Development
                            </button>
                        </div>

                        <!-- Other Information -->
                        <h6 class="mb-3 text-primary">Other Information</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Special Skills and Hobbies</th>
                                        <th>Non-Academic Distinctions/Recognition</th>
                                        <th>Membership in Association/Organization</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="otherInfoTable">
                                    @if (old('other'))
                                        @foreach (old('other.special_skills') as $key => $skill)
                                            <tr>
                                                <td>
                                                    <input type="text" name="other[special_skills][]"
                                                        class="form-control" value="{{ $skill }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="other[distinctions][]"
                                                        class="form-control"
                                                        value="{{ old('other.distinctions.' . $key) }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="other[membership][]"
                                                        class="form-control"
                                                        value="{{ old('other.membership.' . $key) }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @elseif(isset($personalInfo) && $personalInfo->otherInformation)
                                        @foreach ($personalInfo->otherInformation as $other)
                                            <tr>
                                                <td>
                                                    <input type="text" name="other[special_skills][]"
                                                        class="form-control" value="{{ $other->special_skills }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="other[distinctions][]"
                                                        class="form-control" value="{{ $other->distinctions }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="other[membership][]"
                                                        class="form-control" value="{{ $other->membership }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        onclick="removeRow(this)">×</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>
                                                <input type="text" name="other[special_skills][]"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="other[distinctions][]"
                                                    class="form-control">
                                            </td>
                                            <td>
                                                <input type="text" name="other[membership][]" class="form-control">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="removeRow(this)">×</button>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="addOtherInfo()">
                                <i class="fas fa-plus"></i> Add Other Information
                            </button>
                        </div>

                        <!-- Additional Questions Section -->
                        <h6 class="mb-3 text-primary mt-4">Additional Questions</h6>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Are you related by consanguinity or affinity to the appointing
                                    or recommending authority, or to the chief of bureau or office or to the person who has
                                    immediate supervision over you in the Office, Bureau or Department where you will be
                                    appointed?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="related_to_authority"
                                            value="Yes"
                                            {{ old('related_to_authority', $personalInfo->additionalQuestions->related_to_authority ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="related_to_authority"
                                            value="No"
                                            {{ old('related_to_authority', $personalInfo->additionalQuestions->related_to_authority ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="related_to_authority_details"
                                        value="{{ old('related_to_authority_details', $personalInfo->additionalQuestions->related_to_authority_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Have you ever been found guilty of any administrative
                                    offense?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="found_guilty_administrative" value="Yes"
                                            {{ old('found_guilty_administrative', $personalInfo->additionalQuestions->found_guilty_administrative ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio"
                                            name="found_guilty_administrative" value="No"
                                            {{ old('found_guilty_administrative', $personalInfo->additionalQuestions->found_guilty_administrative ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control"
                                        name="found_guilty_administrative_details"
                                        value="{{ old('found_guilty_administrative_details', $personalInfo->additionalQuestions->found_guilty_administrative_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Have you ever been criminally charged before any court?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="criminally_charged"
                                            value="Yes"
                                            {{ old('criminally_charged', $personalInfo->additionalQuestions->criminally_charged ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="criminally_charged"
                                            value="No"
                                            {{ old('criminally_charged', $personalInfo->additionalQuestions->criminally_charged ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="criminally_charged_details"
                                        value="{{ old('criminally_charged_details', $personalInfo->additionalQuestions->criminally_charged_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Have you ever been convicted of any crime or violation of any
                                    law, decree, ordinance or regulation by any court or tribunal?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="convicted_crime"
                                            value="Yes"
                                            {{ old('convicted_crime', $personalInfo->additionalQuestions->convicted_crime ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="convicted_crime"
                                            value="No"
                                            {{ old('convicted_crime', $personalInfo->additionalQuestions->convicted_crime ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="convicted_crime_details"
                                        value="{{ old('convicted_crime_details', $personalInfo->additionalQuestions->convicted_crime_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Have you ever been separated from the service in any of the
                                    following modes: resignation, retirement, dropped from the rolls, dismissal,
                                    termination, end of term, finished contract or phased out (abolition) in the public or
                                    private sector?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="separated_from_service"
                                            value="Yes"
                                            {{ old('separated_from_service', $personalInfo->additionalQuestions->separated_from_service ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="separated_from_service"
                                            value="No"
                                            {{ old('separated_from_service', $personalInfo->additionalQuestions->separated_from_service ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="separated_from_service_details"
                                        value="{{ old('separated_from_service_details', $personalInfo->additionalQuestions->separated_from_service_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Are you a candidate for an elective office in the next election
                                    or have you been a candidate in any previous election?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="candidate_for_election"
                                            value="Yes"
                                            {{ old('candidate_for_election', $personalInfo->additionalQuestions->candidate_for_election ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="candidate_for_election"
                                            value="No"
                                            {{ old('candidate_for_election', $personalInfo->additionalQuestions->candidate_for_election ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="candidate_for_election_details"
                                        value="{{ old('candidate_for_election_details', $personalInfo->additionalQuestions->candidate_for_election_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Have you resigned from the government service during the three
                                    (3) month period before the last election to promote/actively campaign for a national or
                                    local candidate?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="resigned_to_campaign"
                                            value="Yes"
                                            {{ old('resigned_to_campaign', $personalInfo->additionalQuestions->resigned_to_campaign ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="resigned_to_campaign"
                                            value="No"
                                            {{ old('resigned_to_campaign', $personalInfo->additionalQuestions->resigned_to_campaign ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="resigned_to_campaign_details"
                                        value="{{ old('resigned_to_campaign_details', $personalInfo->additionalQuestions->resigned_to_campaign_details ?? '') }}"
                                        placeholder="If YES, give details">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Have you acquired the status of an immigrant or permanent
                                    resident of another country?</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="immigrant_status"
                                            value="Yes"
                                            {{ old('immigrant_status', $personalInfo->additionalQuestions->immigrant_status ?? '') == 'Yes' ? 'checked' : '' }}>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="immigrant_status"
                                            value="No"
                                            {{ old('immigrant_status', $personalInfo->additionalQuestions->immigrant_status ?? '') == 'No' ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="immigrant_status_details"
                                        value="{{ old('immigrant_status_details', $personalInfo->additionalQuestions->immigrant_status_details ?? '') }}"
                                        placeholder="If YES, give details (country)">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pursuant to: (a) Indigenous People's Act (RA 8371); (b) Magna
                                    Carta for Disabled Persons (RA 7277); and (c) Solo Parents Welfare Act of 2000 (RA
                                    8972), please answer the following items:</label>

                                <div class="mt-3">
                                    <label class="form-label">a. Are you a member of any indigenous group?</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="indigenous_group_member" value="Yes"
                                                {{ old('indigenous_group_member', $personalInfo->additionalQuestions->indigenous_group_member ?? '') == 'Yes' ? 'checked' : '' }}>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="indigenous_group_member" value="No"
                                                {{ old('indigenous_group_member', $personalInfo->additionalQuestions->indigenous_group_member ?? '') == 'No' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="indigenous_group_details"
                                            value="{{ old('indigenous_group_details', $personalInfo->additionalQuestions->indigenous_group_details ?? '') }}"
                                            placeholder="If YES, please specify">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">b. Are you a person with disability?</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="person_with_disability" value="Yes"
                                                {{ old('person_with_disability', $personalInfo->additionalQuestions->person_with_disability ?? '') == 'Yes' ? 'checked' : '' }}>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"
                                                name="person_with_disability" value="No"
                                                {{ old('person_with_disability', $personalInfo->additionalQuestions->person_with_disability ?? '') == 'No' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="disability_details"
                                            value="{{ old('disability_details', $personalInfo->additionalQuestions->disability_details ?? '') }}"
                                            placeholder="If YES, please specify">
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">c. Are you a solo parent?</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="solo_parent"
                                                value="Yes"
                                                {{ old('solo_parent', $personalInfo->additionalQuestions->solo_parent ?? '') == 'Yes' ? 'checked' : '' }}>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="solo_parent"
                                                value="No"
                                                {{ old('solo_parent', $personalInfo->additionalQuestions->solo_parent ?? '') == 'No' ? 'checked' : '' }}>
                                            <label class="form-check-label">No</label>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="solo_parent_details"
                                            value="{{ old('solo_parent_details', $personalInfo->additionalQuestions->solo_parent_details ?? '') }}"
                                            placeholder="If YES, please specify">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Step 7: Review and Submit -->
            <div class="step-content" id="step-7">
                <h4 class="mb-3">VII. REVIEW AND SUBMIT</h4>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Please review your information before submitting.
                </div>

                <div id="reviewContent">
                    <!-- This will be populated dynamically -->
                </div>

                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="certifyInfo" required>
                    <label class="form-check-label" for="certifyInfo">
                        I certify that all information provided above is true and correct to the best of my knowledge.
                    </label>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="form-navigation">
                <div class="progress-info">
                    Step <span id="currentStepNum">1</span> of <span id="totalStepNum">7</span>
                </div>
                <div class="nav-buttons">
                    <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)"
                        style="display: none;">
                        <i class="fas fa-arrow-left"></i> Previous
                    </button>
                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                        Next <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                        <i class="fas fa-check"></i> Submit
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 7;
        let completedSteps = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showStep(currentStep);
            updateProgressLine();
            toggleCitizenshipType();

            // Auto-save functionality
            if (typeof(Storage) !== "undefined") {
                loadFormData();
                setInterval(saveFormData, 30000); // Auto-save every 30 seconds
            }

            // Add form submit handler
            document.getElementById('multiStepForm').addEventListener('submit', function(e) {
                e.preventDefault();
                if (validateStep(7)) {
                    showLoading();
                    this.submit();
                }
            });
        });

        function showStep(step) {
            // Hide all steps with animation
            document.querySelectorAll('.step-content').forEach(content => {
                content.classList.remove('active', 'slide-out-left', 'slide-in-right');
            });

            // Show current step with animation
            setTimeout(() => {
                document.getElementById(`step-${step}`).classList.add('active');
            }, 100);

            // Update progress bar
            document.querySelectorAll('.progress-step').forEach((progressStep, index) => {
                if (index + 1 < step) {
                    progressStep.classList.add('completed');
                    progressStep.classList.remove('active');
                } else if (index + 1 === step) {
                    progressStep.classList.add('active');
                    progressStep.classList.remove('completed');
                } else {
                    progressStep.classList.remove('active', 'completed');
                }
            });

            // Update navigation buttons
            document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'block';
            document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'block';
            document.getElementById('submitBtn').style.display = step === totalSteps ? 'block' : 'none';

            // Update step counter
            document.getElementById('currentStepNum').textContent = step;
            document.getElementById('totalStepNum').textContent = totalSteps;

            // Generate review if on last step
            if (step === 7) {
                generateReview();
            }

            updateProgressLine();
        }

        function changeStep(direction) {
            const newStep = currentStep + direction;

            if (direction > 0) {
                // Moving forward - validate current step
                if (!validateStep(currentStep)) {
                    return;
                }
                markStepComplete(currentStep);
            }

            if (newStep >= 1 && newStep <= totalSteps) {
                currentStep = newStep;
                showStep(currentStep);
                window.scrollTo(0, 0);
                saveFormData();
            }
        }

        function goToStep(step) {
            // Only allow going to completed steps or current step
            if (step <= currentStep || completedSteps.includes(step)) {
                currentStep = step;
                showStep(currentStep);
                window.scrollTo(0, 0);
            }
        }

        function validateStep(step) {
            let isValid = true;
            const stepContent = document.getElementById(`step-${step}`);

            // Clear previous errors
            stepContent.querySelectorAll('.field-error').forEach(field => {
                field.classList.remove('field-error');
            });
            stepContent.querySelectorAll('.error-message').forEach(msg => {
                msg.textContent = '';
            });

            // Validate required fields
            const requiredFields = stepContent.querySelectorAll('[required]');
            requiredFields.forEach(field => {
                if (!field.value || (field.type === 'radio' && !stepContent.querySelector(
                        `input[name="${field.name}"]:checked`))) {
                    isValid = false;
                    field.classList.add('field-error');
                    const errorMsg = field.closest('.mb-3')?.querySelector('.error-message');
                    if (errorMsg) {
                        errorMsg.textContent = 'This field is required';
                    }
                }
            });

            // Step-specific validations
            switch (step) {
                case 1:
                    // Validate email format
                    const email = stepContent.querySelector('input[name="email"]');
                    if (email && email.value && !isValidEmail(email.value)) {
                        isValid = false;
                        email.classList.add('field-error');
                        email.closest('.mb-3').querySelector('.error-message').textContent =
                            'Please enter a valid email address';
                    }

                    // Validate mobile number format
                    const mobile = stepContent.querySelector('input[name="mobile_no"]');
                    if (mobile && mobile.value && !isValidMobile(mobile.value)) {
                        isValid = false;
                        mobile.classList.add('field-error');
                        mobile.closest('.mb-3').querySelector('.error-message').textContent =
                            'Please enter a valid mobile number';
                    }
                    break;

                case 7:
                    // Validate certification checkbox
                    const certify = document.getElementById('certifyInfo');
                    if (!certify.checked) {
                        isValid = false;
                        alert('Please certify that all information is true and correct.');
                    }
                    break;
            }

            if (!isValid) {
                // Scroll to first error
                const firstError = stepContent.querySelector('.field-error');
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            }

            return isValid;
        }

        function markStepComplete(step) {
            if (!completedSteps.includes(step)) {
                completedSteps.push(step);
            }
            // Show completion badge for the step
            const stepContent = document.getElementById(`step-${step}`);
            const badge = stepContent.querySelector('.step-badge');
            if (badge) {
                badge.style.display = 'inline-block';
            }
        }

        function updateProgressLine() {
            const progressLine = document.getElementById('progressLine');
            const percentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
            progressLine.style.width = percentage + '%';
        }

        // Utility Functions
        function isValidEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        function isValidMobile(mobile) {
            const regex = /^(09|\+639)\d{9}$/;
            return regex.test(mobile.replace(/\D/g, ''));
        }

        function toggleCitizenshipType() {
            const citizenship = document.querySelector('select[name="citizenship"]');
            const citizenshipTypeDiv = document.getElementById('citizenshipTypeDiv');

            if (citizenship && citizenship.value === 'Dual Citizenship') {
                citizenshipTypeDiv.style.display = 'block';
            } else {
                citizenshipTypeDiv.style.display = 'none';
            }
        }

        function copyResidentialAddress() {
            const checkbox = document.getElementById('sameAsResidential');
            if (checkbox.checked) {
                document.querySelector('input[name="permanent_address"]').value =
                    document.querySelector('input[name="residential_address"]').value;
                document.querySelector('input[name="permanent_zip_code"]').value =
                    document.querySelector('input[name="residential_zip_code"]').value;
            }
        }

        // Auto-save Functions
        function saveFormData() {
            const formData = new FormData(document.getElementById('multiStepForm'));
            const data = {};

            for (let [key, value] of formData.entries()) {
                if (data[key]) {
                    if (Array.isArray(data[key])) {
                        data[key].push(value);
                    } else {
                        data[key] = [data[key], value];
                    }
                } else {
                    data[key] = value;
                }
            }

            localStorage.setItem('pdsFormData', JSON.stringify(data));
            localStorage.setItem('pdsCurrentStep', currentStep);
            localStorage.setItem('pdsCompletedSteps', JSON.stringify(completedSteps));

            // Show auto-save indicator
            const indicator = document.getElementById('autoSaveIndicator');
            indicator.style.display = 'block';
            setTimeout(() => {
                indicator.style.display = 'none';
            }, 2000);
        }

        function loadFormData() {
            const savedData = localStorage.getItem('pdsFormData');
            const savedStep = localStorage.getItem('pdsCurrentStep');
            const savedCompleted = localStorage.getItem('pdsCompletedSteps');

            if (savedData) {
                const data = JSON.parse(savedData);
                const form = document.getElementById('multiStepForm');

                // Restore form data
                Object.keys(data).forEach(key => {
                    const field = form.querySelector(`[name="${key}"]`);
                    if (field) {
                        if (field.type === 'radio' || field.type === 'checkbox') {
                            const radioField = form.querySelector(`[name="${key}"][value="${data[key]}"]`);
                            if (radioField) radioField.checked = true;
                        } else {
                            field.value = data[key];
                        }
                    }
                });

                // Restore step progress
                if (savedStep) {
                    currentStep = parseInt(savedStep);
                    showStep(currentStep);
                }

                if (savedCompleted) {
                    completedSteps = JSON.parse(savedCompleted);
                }
            }
        }

        function clearFormData() {
            localStorage.removeItem('pdsFormData');
            localStorage.removeItem('pdsCurrentStep');
            localStorage.removeItem('pdsCompletedSteps');
        }

        // Loading Functions
        function showLoading() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        // Generate Review
        function generateReview() {
            const reviewContent = document.getElementById('reviewContent');
            const formData = new FormData(document.getElementById('multiStepForm'));

            let reviewHTML = '';

            // Personal Information
            reviewHTML += `
        <div class="review-section">
            <h6>Personal Information</h6>
            <div class="review-item">
                <span class="review-label">Full Name:</span>
                <span class="review-value">${formData.get('first_name')} ${formData.get('middle_name')} ${formData.get('surname')} ${formData.get('name_extension')}</span>
            </div>
            <div class="review-item">
                <span class="review-label">Date of Birth:</span>
                <span class="review-value">${formData.get('date_of_birth')}</span>
            </div>
            <div class="review-item">
                <span class="review-label">Sex:</span>
                <span class="review-value">${formData.get('sex')}</span>
            </div>
            <div class="review-item">
                <span class="review-label">Civil Status:</span>
                <span class="review-value">${formData.get('civil_status')}</span>
            </div>
            <div class="review-item">
                <span class="review-label">Email:</span>
                <span class="review-value">${formData.get('email')}</span>
            </div>
            <div class="review-item">
                <span class="review-label">Mobile No:</span>
                <span class="review-value">${formData.get('mobile_no')}</span>
            </div>
        </div>
    `;

            // Add more sections as needed...

            reviewContent.innerHTML = reviewHTML;
        }

        // Dynamic Row Functions (keeping the same as before)
        function addChild() {
            const container = document.getElementById('childrenContainer');
            const childCount = container.querySelectorAll('.child-row').length;
            const newRow = document.createElement('div');
            newRow.className = 'row child-row mb-2';
            newRow.innerHTML = `
        <div class="col-md-8">
            <input type="text" class="form-control" name="children[${childCount}][name]" placeholder="Child's full name">
        </div>
        <div class="col-md-3">
            <input type="date" class="form-control" name="children[${childCount}][dob]">
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-sm btn-danger" onclick="removeChild(this)">×</button>
        </div>
    `;
            container.appendChild(newRow);
        }

        function removeChild(button) {
            button.closest('.child-row').remove();
        }

        function addCivilService() {
            const table = document.getElementById('civilServiceTable');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td><input type="text" name="eligibility[]" class="form-control"></td>
        <td><input type="text" name="rating[]" class="form-control"></td>
        <td><input type="date" name="exam_date[]" class="form-control"></td>
        <td><input type="text" name="exam_place[]" class="form-control"></td>
        <td><input type="text" name="license_number[]" class="form-control"></td>
        <td><input type="date" name="release_date[]" class="form-control"></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
    `;
            table.appendChild(newRow);
        }

        function addWork() {
            const table = document.getElementById('workExperienceTable');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td>
            <input type="date" class="form-control mb-1" name="work[from_date][]">
            <input type="date" class="form-control" name="work[to_date][]">
        </td>
        <td><input type="text" class="form-control" name="work[position_title][]"></td>
        <td><input type="text" class="form-control" name="work[department][]"></td>
        <td><input type="text" class="form-control" name="work[monthly_salary][]"></td>
        <td><input type="text" class="form-control" name="work[salary_grade][]"></td>
        <td><input type="text" class="form-control" name="work[status_of_appointment][]"></td>
        <td><input type="text" class="form-control" name="work[gov_service][]"></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
    `;
            table.appendChild(newRow);
        }

        function addVoluntary() {
            const table = document.getElementById('voluntaryTable');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td><input type="text" name="voluntary[organization_name][]" class="form-control"></td>
        <td>
            <div class="d-flex">
                <input type="date" name="voluntary[from_date][]" class="form-control me-1">
                <input type="date" name="voluntary[to_date][]" class="form-control">
            </div>
        </td>
        <td><input type="number" name="voluntary[number_of_hours][]" class="form-control"></td>
        <td><input type="text" name="voluntary[position][]" class="form-control"></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
    `;
            table.appendChild(newRow);
        }

        function addLearning() {
            const table = document.getElementById('learningTable');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td><input type="text" name="learning[title][]" class="form-control"></td>
        <td>
            <div class="d-flex">
                <input type="date" name="learning[from_date][]" class="form-control me-1">
                <input type="date" name="learning[to_date][]" class="form-control">
            </div>
        </td>
        <td><input type="number" name="learning[number_of_hours][]" class="form-control"></td>
        <td><input type="text" name="learning[type_of_ld][]" class="form-control"></td>
        <td><input type="text" name="learning[conducted_by][]" class="form-control"></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
    `;
            table.appendChild(newRow);
        }

        function addOtherInfo() {
            const table = document.getElementById('otherInfoTable');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
        <td><input type="text" name="other[special_skills][]" class="form-control"></td>
        <td><input type="text" name="other[distinctions][]" class="form-control"></td>
        <td><input type="text" name="other[membership][]" class="form-control"></td>
        <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">×</button></td>
    `;
            table.appendChild(newRow);
        }

        function removeRow(button) {
            button.closest('tr').remove();
        }

        // Keyboard Navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                const activeElement = document.activeElement;
                if (activeElement.tagName !== 'TEXTAREA' && activeElement.type !== 'submit') {
                    e.preventDefault();
                    const nextBtn = document.getElementById('nextBtn');
                    const submitBtn = document.getElementById('submitBtn');

                    if (nextBtn.style.display !== 'none') {
                        nextBtn.click();
                    } else if (submitBtn.style.display !== 'none') {
                        submitBtn.click();
                    }
                }
            }
        });

        // Clear form data on successful submission
        window.addEventListener('beforeunload', function(e) {
            const form = document.getElementById('multiStepForm');
            if (form.dataset.submitted === 'true') {
                clearFormData();
            }
        });
    </script>

    <!-- Include the remaining steps (2-6) content here -->
    <!-- Steps 2-6 would be the same as in the previous artifact, but I'll add them if needed -->

@endsection
