@extends('employee_theme.layout')
@section('content')
    <div class="container">
        <h2 class="text-center">PROFILE</h2>

        <!-- Error and Success Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Action -->
        <form method="POST" 
        action="{{ isset($personalInfo) ? route('personal.data.sheet.update', ['personal_information_id' => $personalInfo->personal_information_id]) : route('personal.data.sheet.store') }}" 
        onsubmit="return validateForm()">
        @csrf

            <h5>I. PERSONAL INFORMATION</h5>
            <table class="table table-bordered">
                <tbody>
                    <!-- Surname, First Name -->
                    <tr>
                        <td>2. Surname</td>
                        <td>
                            <input type="text" class="form-control" readonly
                                value="{{ old('surname', $personalInfo->surname ?? (auth()->user()->last_name ?? '')) }}"
                                name="surname">
                        </td>
                        <td>1. First Name</td>
                        <td>
                            <input type="text" class="form-control" readonly
                                value="{{ old('first_name', $personalInfo->first_name ?? (auth()->user()->first_name ?? '')) }}"
                                name="first_name">
                        </td>
                    </tr>

                    <!-- Middle Name, Name Extension -->
                    <tr>
                        <td>Middle Name</td>
                        <td>
                            <input type="text" class="form-control" readonly
                                value="{{ old('middle_name', $personalInfo->middle_name ?? (auth()->user()->middle_initial ?? '')) }}"
                                name="middle_name">
                        </td>
                        <td>Name Extension (Jr., Sr.)</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('name_extension', $personalInfo->name_extension ?? '') }}"
                                name="name_extension">
                        </td>
                    </tr>

                    <!-- Date of Birth, Place of Birth -->
                    <tr>
                        <td>3. Date of Birth</td>
                        <td>
                            <input type="date" class="form-control"
                                value="{{ old('date_of_birth', $personalInfo->date_of_birth ?? '') }}" name="date_of_birth">
                        </td>
                        <td>4. Place of Birth</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('place_of_birth', $personalInfo->place_of_birth ?? '') }}"
                                name="place_of_birth">
                        </td>
                    </tr>

                    <!-- Sex, Civil Status -->
                    <tr>
                        <td>5. Sex</td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="sex" value="Male"
                                    {{ old('sex', $personalInfo->sex ?? '') == 'Male' ? 'checked' : '' }}> Male
                            </div>
                            <div class="form-check">
                                <input type="radio" name="sex" value="Female"
                                    {{ old('sex', $personalInfo->sex ?? '') == 'Female' ? 'checked' : '' }}> Female
                            </div>
                        </td>
                        <td>6. Civil Status</td>
                        <td>
                            <select class="form-select" name="civil_status">
                                @foreach (['Single', 'Married', 'Widowed', 'Separated'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('civil_status', $personalInfo->civil_status ?? '') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>

                    <!-- Height, Weight -->
                    <tr>
                        <td>7. Height (m)</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('height', $personalInfo->height ?? '') }}" name="height">
                        </td>
                        <td>8. Weight (kg)</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('weight', $personalInfo->weight ?? '') }}" name="weight">
                        </td>
                    </tr>

                    <!-- Blood Type -->
                    <tr>
                        <td>9. Blood Type</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('blood_type', $personalInfo->blood_type ?? '') }}" name="blood_type">
                        </td>
                    </tr>

                    <!-- GSIS, PAG-IBIG -->
                    <tr>
                        <td>10. GSIS ID No.</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('gsis_no', $personalInfo->gsis_no ?? '') }}" name="gsis_no">
                        </td>
                        <td>11. PAG-IBIG ID No.</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('pagibig_no', $personalInfo->pagibig_no ?? '') }}" name="pagibig_no">
                        </td>
                    </tr>

                    <!-- PHILHEALTH, SSS -->
                    <tr>
                        <td>12. PHILHEALTH No.</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('philhealth_no', $personalInfo->philhealth_no ?? '') }}"
                                name="philhealth_no">
                        </td>
                        <td>13. SSS No.</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('sss_no', $personalInfo->sss_no ?? '') }}" name="sss_no">
                        </td>
                    </tr>

                    <!-- TIN, Agency Employee No. -->
                    <tr>
                        <td>14. TIN No.</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('tin_no', $personalInfo->tin_no ?? '') }}" name="tin_no">
                        </td>
                        <td>15. Agency Employee No.</td>
                        <td>
                            <input type="text" class="form-control"
                                value="{{ old('agency_employee_no', $personalInfo->agency_employee_no ?? '') }}"
                                name="agency_employee_no">
                        </td>
                    </tr>

                    <!-- Citizenship -->
                    <tr>
                        <td>16. Citizenship</td>
                        <td>
                            <select class="form-select" name="citizenship">
                                <option value="Filipino"
                                    {{ old('citizenship', $personalInfo->citizenship ?? '') == 'Filipino' ? 'selected' : '' }}>
                                    Filipino</option>
                                <option value="Dual Citizenship"
                                    {{ old('citizenship', $personalInfo->citizenship ?? '') == 'Dual Citizenship' ? 'selected' : '' }}>
                                    Dual Citizenship</option>
                            </select>
                        </td>
                        <td colspan="2">
                            If holder of dual citizenship:
                            <div class="form-check">
                                <input type="radio" name="citizenship_type" value="by birth"
                                    {{ old('citizenship_type', $personalInfo->citizenship_type ?? '') == 'by birth' ? 'checked' : '' }}>
                                By birth
                            </div>
                            <div class="form-check">
                                <input type="radio" name="citizenship_type" value="by naturalization"
                                    {{ old('citizenship_type', $personalInfo->citizenship_type ?? '') == 'by naturalization' ? 'checked' : '' }}>
                                By naturalization
                            </div>
                        </td>
                    </tr>

                    <!-- Residential Address -->
                    <tr>
                        <td>17. Residential Address</td>
                        <td colspan="3">
                            <input type="text" class="form-control mb-2" name="residential_address"
                                value="{{ old('residential_address', $personalInfo->residential_address ?? '') }}"
                                placeholder="House/Block/Lot No., Street, Subdivision/Village">
                            <input type="text" class="form-control" name="residential_zip_code"
                                value="{{ old('residential_zip_code', $personalInfo->residential_zip_code ?? '') }}"
                                placeholder="ZIP Code">
                        </td>
                    </tr>

                    <!-- Permanent Address -->
                    <tr>
                        <td>18. Permanent Address</td>
                        <td colspan="3">
                            <input type="text" class="form-control mb-2" name="permanent_address"
                                value="{{ old('permanent_address', $personalInfo->permanent_address ?? '') }}"
                                placeholder="House/Block/Lot No., Street, Subdivision/Village">
                            <input type="text" class="form-control" name="permanent_zip_code"
                                value="{{ old('permanent_zip_code', $personalInfo->permanent_zip_code ?? '') }}"
                                placeholder="ZIP Code">
                        </td>
                    </tr>

                    <!-- Contact Information -->
                    <tr>
                        <td>19. Telephone No.</td>
                        <td>
                            <input type="text" class="form-control" name="telephone_no"
                                value="{{ old('telephone_no', $personalInfo->telephone_no ?? '') }}">
                        </td>
                        <td>20. Mobile No.</td>
                        <td>
                            <input type="text" class="form-control" name="mobile_no"
                                value="{{ old('mobile_no', $personalInfo->mobile_no ?? '') }}">
                        </td>
                    </tr>

                    <!-- Email -->
                    <tr>
                        <td>21. E-mail Address</td>
                        <td colspan="3">
                            <input type="email" class="form-control" name="email"
                                value="{{ old('email', $personalInfo->email ?? '') }}">
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Family Background -->
            <h5>II. Family Background</h5>
            <table class="table table-bordered">
                <tbody>
                    <!-- Spouse Information -->
                    <tr>
                        <td>22. Spouse's Surname</td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="spouse_surname"
                                value="{{ old('spouse_surname', $personalInfo->familyBackground->spouse_surname ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>First Name</td>
                        <td>
                            <input type="text" class="form-control" name="spouse_first_name"
                                value="{{ old('spouse_first_name', $personalInfo->familyBackground->spouse_first_name ?? '') }}">
                        </td>
                        <td>Name Extension</td>
                        <td>
                            <input type="text" class="form-control" name="spouse_name_extension"
                                value="{{ old('spouse_name_extension', $personalInfo->familyBackground->spouse_name_extension ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Middle Name</td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="spouse_middle_name"
                                value="{{ old('spouse_middle_name', $personalInfo->familyBackground->spouse_middle_name ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Occupation</td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="spouse_occupation"
                                value="{{ old('spouse_occupation', $personalInfo->familyBackground->spouse_occupation ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Employer/Business Name</td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="spouse_employer"
                                value="{{ old('spouse_employer', $personalInfo->familyBackground->spouse_employer ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Business Address</td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="spouse_business_address"
                                value="{{ old('spouse_business_address', $personalInfo->familyBackground->spouse_business_address ?? '') }}">
                        </td>
                    </tr>
                    <tr>
                        <td>Telephone No.</td>
                        <td colspan="3">
                            <input type="text" class="form-control" name="spouse_telephone"
                                value="{{ old('spouse_telephone', $personalInfo->familyBackground->spouse_telephone ?? '') }}">
                        </td>
                    </tr>

                    <!-- Children Information -->
                    <tr>
                        <th colspan="2">23. Name of Children (Write full name and list all)</th>
                        <th colspan="2">Date of Birth (mm/dd/yyyy)</th>
                    </tr>
                <tbody id="childrenTable">
                    @if (old('children'))
                        @foreach (old('children') as $index => $child)
                            <tr>
                                <td colspan="2">
                                    <input type="text" class="form-control"
                                        name="children[{{ $index }}][name]" value="{{ $child['name'] ?? '' }}"
                                        placeholder="Child's full name">
                                </td>
                                <td colspan="2">
                                    <input type="date" class="form-control" name="children[{{ $index }}][dob]"
                                        value="{{ $child['dob'] ?? '' }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                        onclick="removeChild(this)">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    @elseif(isset($personalInfo) && $personalInfo->children && $personalInfo->children->count() > 0)
                        @foreach ($personalInfo->children as $index => $child)
                            <tr>
                                <td colspan="2">
                                    <input type="text" class="form-control"
                                        name="children[{{ $index }}][name]" value="{{ $child->name ?? '' }}"
                                        placeholder="Child's full name">
                                </td>
                                <td colspan="2">
                                    <input type="date" class="form-control" name="children[{{ $index }}][dob]"
                                        value="{{ $child->date_of_birth ?? '' }}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                        onclick="removeChild(this)">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="2">
                                <input type="text" class="form-control" name="children[0][name]"
                                    placeholder="Child's full name">
                            </td>
                            <td colspan="2">
                                <input type="date" class="form-control" name="children[0][dob]">
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger" onclick="removeChild(this)">Remove</button>
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tr>
                    <td colspan="4">
                        <button type="button" class="btn btn-primary" onclick="addChild()">Add Another Child</button>
                    </td>
                </tr>

                <!-- Father's Information -->
                <tr>
                    <td>24. Father's Surname</td>
                    <td colspan="3">
                        <input type="text" class="form-control" name="father_surname"
                            value="{{ old('father_surname', $personalInfo->familyBackground->father_surname ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td>
                        <input type="text" class="form-control" name="father_first_name"
                            value="{{ old('father_first_name', $personalInfo->familyBackground->father_first_name ?? '') }}">
                    </td>
                    <td>Name Extension (Jr., Sr.)</td>
                    <td>
                        <input type="text" class="form-control" name="father_name_extension"
                            value="{{ old('father_name_extension', $personalInfo->familyBackground->father_name_extension ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td colspan="3">
                        <input type="text" class="form-control" name="father_middle_name"
                            value="{{ old('father_middle_name', $personalInfo->familyBackground->father_middle_name ?? '') }}">
                    </td>
                </tr>

                <!-- Mother's Information -->
                <tr>
                    <td>25. Mother's Maiden Name</td>
                    <td colspan="3">
                        <input type="text" class="form-control" name="mother_maiden_name"
                            value="{{ old('mother_maiden_name', $personalInfo->familyBackground->mother_maiden_name ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>Mother's Surname</td>
                    <td colspan="3">
                        <input type="text" class="form-control" name="mother_surname"
                            value="{{ old('mother_surname', $personalInfo->familyBackground->mother_surname ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td colspan="3">
                        <input type="text" class="form-control" name="mother_first_name"
                            value="{{ old('mother_first_name', $personalInfo->familyBackground->mother_first_name ?? '') }}">
                    </td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td colspan="3">
                        <input type="text" class="form-control" name="mother_middle_name"
                            value="{{ old('mother_middle_name', $personalInfo->familyBackground->mother_middle_name ?? '') }}">
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- Educational Background -->
            <h5>III. Educational Background</h5>
            <table class="table table-bordered">
                <thead>
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
                        <td>Elementary</td>
                        <td>
                            <input type="text" class="form-control" name="elementary_school"
                                value="{{ old(
                                    'elementary_school',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->school_name ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="elementary_degree"
                                value="{{ old(
                                    'elementary_degree',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->degree_course ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="elementary_from"
                                    value="{{ old(
                                        'elementary_from',
                                        isset($personalInfo) && $personalInfo->educationalBackground
                                            ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->period_from ?? ''
                                            : '',
                                    ) }}"
                                    placeholder="From">
                                <input type="text" class="form-control" name="elementary_to"
                                    value="{{ old(
                                        'elementary_to',
                                        isset($personalInfo) && $personalInfo->educationalBackground
                                            ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->period_to ?? ''
                                            : '',
                                    ) }}"
                                    placeholder="To">
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="elementary_highest_level"
                                value="{{ old(
                                    'elementary_highest_level',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->highest_level_earned ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="elementary_year_graduated"
                                value="{{ old(
                                    'elementary_year_graduated',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->year_graduated ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="elementary_honors"
                                value="{{ old(
                                    'elementary_honors',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Elementary')->first()->academic_honors ?? ''
                                        : '',
                                ) }}">
                        </td>
                    </tr>

                    <!-- Secondary -->
                    <tr>
                        <td>Secondary</td>
                        <td>
                            <input type="text" class="form-control" name="secondary_school"
                                value="{{ old(
                                    'secondary_school',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->school_name ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="secondary_degree"
                                value="{{ old(
                                    'secondary_degree',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->degree_course ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <div class="d-flex">
                                <input type="text" class="form-control me-2" name="secondary_from"
                                    value="{{ old(
                                        'secondary_from',
                                        isset($personalInfo) && $personalInfo->educationalBackground
                                            ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->period_from ?? ''
                                            : '',
                                    ) }}"
                                    placeholder="From">
                                <input type="text" class="form-control" name="secondary_to"
                                    value="{{ old(
                                        'secondary_to',
                                        isset($personalInfo) && $personalInfo->educationalBackground
                                            ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->period_to ?? ''
                                            : '',
                                    ) }}"
                                    placeholder="To">
                            </div>
                        </td>
                        <td>
                            <input type="text" class="form-control" name="secondary_highest_level"
                                value="{{ old(
                                    'secondary_highest_level',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->highest_level_earned ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="secondary_year_graduated"
                                value="{{ old(
                                    'secondary_year_graduated',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->year_graduated ?? ''
                                        : '',
                                ) }}">
                        </td>
                        <td>
                            <input type="text" class="form-control" name="secondary_honors"
                                value="{{ old(
                                    'secondary_honors',
                                    isset($personalInfo) && $personalInfo->educationalBackground
                                        ? $personalInfo->educationalBackground->where('level', 'Secondary')->first()->academic_honors ?? ''
                                        : '',
                                ) }}">
                        </td>
                    </tr>
                </tbody>
            </table>
                    <!-- Civil Service Eligibility -->
                    <h5>IV. Civil Service Eligibility</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Eligibility</th>
                                <th>Rating</th>
                                <th>Date of Examination</th>
                                <th>Place of Examination</th>
                                <th>License Number</th>
                                <th>Date of Release</th>
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
                                            <button type="button" class="btn btn-danger"
                                                onclick="removeRow(this)">Remove</button>
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
                                            <button type="button" class="btn btn-danger"
                                                onclick="removeRow(this)">Remove</button>
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
                                        <button type="button" class="btn btn-danger"
                                            onclick="removeRow(this)">Remove</button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary mb-3" onclick="addCivilService()">Add Civil Service
                        Eligibility</button>

                    <!-- Work Experience -->
                    <h5>V. Work Experience</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Inclusive Dates</th>
                                <th>Position Title</th>
                                <th>Department</th>
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
                                            <input type="date" class="form-control mb-2" name="work[from_date][]"
                                                value="{{ old('work.from_date.' . $key) }}">
                                            <input type="date" class="form-control" name="work[to_date][]"
                                                value="{{ old('work.to_date.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[position_title][]"
                                                value="{{ $position }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[department][]"
                                                value="{{ old('work.department.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[monthly_salary][]"
                                                value="{{ old('work.monthly_salary.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[salary_grade][]"
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
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(isset($personalInfo) && $personalInfo->workExperience)
                                @foreach ($personalInfo->workExperience as $work)
                                    <tr>
                                        <td>
                                            <input type="date" class="form-control mb-2" name="work[from_date][]"
                                                value="{{ $work->from_date }}">
                                            <input type="date" class="form-control" name="work[to_date][]"
                                                value="{{ $work->to_date }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[position_title][]"
                                                value="{{ $work->position_title }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[department][]"
                                                value="{{ $work->department }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[monthly_salary][]"
                                                value="{{ $work->monthly_salary }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="work[salary_grade][]"
                                                value="{{ $work->salary_grade }}">
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
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <!-- Default empty row -->
                                    <td>
                                        <input type="date" class="form-control mb-2" name="work[from_date][]">
                                        <input type="date" class="form-control" name="work[to_date][]">
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
                                        <input type="text" class="form-control" name="work[status_of_appointment][]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="work[gov_service][]">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary mb-3" onclick="addWork()">Add Work Experience</button>

                    <!-- Voluntary Work -->
                    <h5>VI. Voluntary Work or Involvement in Civic/Non-Government/People/Voluntary Organizations</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name of the Organization</th>
                                <th>Inclusive Dates</th>
                                <th>Number of Hours</th>
                                <th>Position / Nature of Work</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="VoluntaryTable">
                            @if (old('voluntary'))
                                @foreach (old('voluntary.organization_name') as $key => $org)
                                    <tr>
                                        <td>
                                            <input type="text" name="voluntary[organization_name][]"
                                                class="form-control" value="{{ $org }}"
                                                placeholder="Name of Organization">
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="voluntary[from_date][]"
                                                        class="form-control"
                                                        value="{{ old('voluntary.from_date.' . $key) }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="voluntary[to_date][]"
                                                        class="form-control"
                                                        value="{{ old('voluntary.to_date.' . $key) }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="voluntary[number_of_hours][]"
                                                class="form-control"
                                                value="{{ old('voluntary.number_of_hours.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" name="voluntary[position][]" class="form-control"
                                                value="{{ old('voluntary.position.' . $key) }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
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
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="voluntary[from_date][]"
                                                        class="form-control" value="{{ $voluntary->from_date }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="voluntary[to_date][]"
                                                        class="form-control" value="{{ $voluntary->to_date }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="voluntary[number_of_hours][]"
                                                class="form-control" value="{{ $voluntary->hours }}">
                                        </td>
                                        <td>
                                            <input type="text" name="voluntary[position][]" class="form-control"
                                                value="{{ $voluntary->position }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="voluntary[organization_name][]" class="form-control"
                                            placeholder="Name of Organization">
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="date" name="voluntary[from_date][]" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" name="voluntary[to_date][]" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="voluntary[number_of_hours][]" class="form-control"
                                            placeholder="Number of Hours">
                                    </td>
                                    <td>
                                        <input type="text" name="voluntary[position][]" class="form-control"
                                            placeholder="Position / Nature of Work">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary mb-3" onclick="addVoluntary()">Add Voluntary
                        Work</button>

                    <!-- Learning & Development -->
                    <h5>VII. Learning and Development (L&D) Interventions/Training Programs Attended</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title of Learning and Development Interventions/Training Programs</th>
                                <th>Inclusive Dates of Attendance</th>
                                <th>Number of Hours</th>
                                <th>Type of LD</th>
                                <th>Conducted/Sponsored By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="LearningTable">
                            @if (old('learning'))
                                @foreach (old('learning.title') as $key => $title)
                                    <tr>
                                        <td>
                                            <input type="text" name="learning[title][]" class="form-control"
                                                value="{{ $title }}">
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="learning[from_date][]"
                                                        class="form-control"
                                                        value="{{ old('learning.from_date.' . $key) }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="learning[to_date][]" class="form-control"
                                                        value="{{ old('learning.to_date.' . $key) }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="learning[number_of_hours][]" class="form-control"
                                                value="{{ old('learning.number_of_hours.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" name="learning[type_of_ld][]" class="form-control"
                                                value="{{ old('learning.type_of_ld.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" name="learning[conducted_by][]" class="form-control"
                                                value="{{ old('learning.conducted_by.' . $key) }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
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
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="learning[from_date][]"
                                                        class="form-control" value="{{ $learning->from_date }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="learning[to_date][]" class="form-control"
                                                        value="{{ $learning->to_date }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="number" name="learning[number_of_hours][]" class="form-control"
                                                value="{{ $learning->hours }}">
                                        </td>
                                        <td>
                                            <input type="text" name="learning[type_of_ld][]" class="form-control"
                                                value="{{ $learning->type }}">
                                        </td>
                                        <td>
                                            <input type="text" name="learning[conducted_by][]" class="form-control"
                                                value="{{ $learning->conducted_by }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="learning[title][]" class="form-control">
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="date" name="learning[from_date][]" class="form-control">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="date" name="learning[to_date][]" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="learning[number_of_hours][]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="learning[type_of_ld][]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="learning[conducted_by][]" class="form-control">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary mb-3" onclick="addLearningRow()">Add Learning &
                        Development</button>

                    <!-- Other Information -->
                    <h5>VIII. Other Information</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Special Skills and Hobbies</th>
                                <th>Non-Academic Distinctions/Recognition</th>
                                <th>Membership in Association/Organization</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="OtherInfoTable">
                            @if (old('other'))
                                @foreach (old('other.special_skills') as $key => $skill)
                                    <tr>
                                        <td>
                                            <input type="text" name="other[special_skills][]" class="form-control"
                                                value="{{ $skill }}">
                                        </td>
                                        <td>
                                            <input type="text" name="other[distinctions][]" class="form-control"
                                                value="{{ old('other.distinctions.' . $key) }}">
                                        </td>
                                        <td>
                                            <input type="text" name="other[membership][]" class="form-control"
                                                value="{{ old('other.membership.' . $key) }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @elseif(isset($personalInfo) && $personalInfo->otherInformation)
                                @foreach ($personalInfo->otherInformation as $other)
                                    <tr>
                                        <td>
                                            <input type="text" name="other[special_skills][]" class="form-control"
                                                value="{{ $other->special_skills }}">
                                        </td>
                                        <td>
                                            <input type="text" name="other[distinctions][]" class="form-control"
                                                value="{{ $other->distinctions }}">
                                        </td>
                                        <td>
                                            <input type="text" name="other[membership][]" class="form-control"
                                                value="{{ $other->membership }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="other[special_skills][]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="other[distinctions][]" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="other[membership][]" class="form-control">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary mb-3" onclick="addOtherInfoRow()">Add Other
                        Information</button>

                    <div class="text-center mt-4 mb-4">
                        <button type="submit" class="btn btn-primary">Submit Personal Data Sheet</button>
                    </div>
        </form>
    </div>

    <!-- JavaScript Functions -->
    <script>
        // Function to add child row
        function addChild() {
            const table = document.getElementById('childrenTable');
            const childCount = table.getElementsByTagName('tr').length;
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td colspan="2">
                    <input type="text" class="form-control" name="children[${childCount}][name]" placeholder="Child's full name">
                </td>
                <td colspan="2">
                    <input type="date" class="form-control" name="children[${childCount}][dob]">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeChild(this)">Remove</button>
                </td>
            `;

            table.appendChild(newRow);
        }

        // Function to add civil service eligibility row
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
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
            `;

            table.appendChild(newRow);
        }

        // Function to add work experience row
        function addWork() {
            const table = document.getElementById('workExperienceTable');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <input type="date" class="form-control mb-2" name="work[from_date][]">
                    <input type="date" class="form-control" name="work[to_date][]">
                </td>
                <td><input type="text" class="form-control" name="work[position_title][]"></td>
                <td><input type="text" class="form-control" name="work[department][]"></td>
                <td><input type="text" class="form-control" name="work[monthly_salary][]"></td>
                <td><input type="text" class="form-control" name="work[salary_grade][]"></td>
                <td><input type="text" class="form-control" name="work[status_of_appointment][]"></td>
                <td><input type="text" class="form-control" name="work[gov_service][]"></td>
                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
            `;

            table.appendChild(newRow);
        }

        // Function to add voluntary work row
        function addVoluntary() {
            const table = document.getElementById('VoluntaryTable');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <input type="text" name="voluntary[organization_name][]" class="form-control" placeholder="Name of Organization">
                </td>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="date" name="voluntary[from_date][]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="voluntary[to_date][]" class="form-control">
                        </div>
                    </div>
                </td>
                <td>
                    <input type="number" name="voluntary[number_of_hours][]" class="form-control" placeholder="Number of Hours">
                </td>
                <td>
                    <input type="text" name="voluntary[position][]" class="form-control" placeholder="Position / Nature of Work">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            `;

            table.appendChild(newRow);
        }

        // Function to add learning development row
        function addLearningRow() {
            const table = document.getElementById('LearningTable');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <input type="text" name="learning[title][]" class="form-control">
                </td>
                <td>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="date" name="learning[from_date][]" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="date" name="learning[to_date][]" class="form-control">
                        </div>
                    </div>
                </td>
                <td>
                    <input type="number" name="learning[number_of_hours][]" class="form-control">
                </td>
                <td>
                    <input type="text" name="learning[type_of_ld][]" class="form-control">
                </td>
                <td>
                    <input type="text" name="learning[conducted_by][]" class="form-control">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            `;

            table.appendChild(newRow);
        }

        // Function to add other information row
        function addOtherInfoRow() {
            const table = document.getElementById('OtherInfoTable');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td>
                    <input type="text" name="other[special_skills][]" class="form-control">
                </td>
                <td>
                    <input type="text" name="other[distinctions][]" class="form-control">
                </td>
                <td>
                    <input type="text" name="other[membership][]" class="form-control">
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-row">Remove</button>
                </td>
            `;

            table.appendChild(newRow);
        }

        // Generic remove row function
        function removeRow(button) {
            button.closest('tr').remove();
        }

        // Form validation function
        function validateForm() {
            // Add your validation logic here
            return true;
        }

        // Event delegation for remove buttons
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('remove-row')) {
                event.target.closest('tr').remove();
            }
        });
    </script>
@endsection
