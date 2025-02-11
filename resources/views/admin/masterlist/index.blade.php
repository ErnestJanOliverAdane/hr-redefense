@extends('theme.layout')
@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Employee Master List</h4>
            <div class="d-flex gap-2">

                <!-- Import form -->
                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data"
                    class="d-flex align-items-center">
                    @csrf
                    <div class="me-2">
                        <label for="file" class="form-label">Choose Spreadsheet</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>

        <p></p>

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display error message -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Employee Table or No Data Message -->
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">

            </div>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <table class="datatable-init-export nowrap table" data-export-title="Export">
                        <thead>
                            <tr class="nk-tb-item nk-tb-head">
                                <th class="nk-tb-col"><span class="sub-text">#</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Full Name</span></th>
                                <!-- Changed from First Name to Full Name -->
                                <!-- <th class="nk-tb-col"><span class="sub-text">Middle Initial</span></th> -->
                                <th class="nk-tb-col"><span class="sub-text">Contact Information</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Employment Status</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Job Title</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Department</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Job Type</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Action</span></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $index => $employee)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $employee->first_name }} {{ $employee->middle_name }} {{ $employee->last_name }}
                                    </td>
                                    <!-- <td>{{ $employee->middle_initial }}</td> -->
                                    <td>{{ $employee->contact_information }}</td>
                                    <td>{{ $employee->employment_status }}</td>
                                    <td>{{ $employee->job_title }}</td>
                                    <td class="expanded-cell">{{ $employee->department }}</td>
                                    <td class="expanded-cell">{{ $employee->job_type }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm"
                                            onclick="openViewModal('{{ $employee->id }}')">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="employee-files-list"></div>
                    <!-- Add other fields as needed -->
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-3">Basic Information</h6>
                            <p><strong>Employee ID:</strong> <span id="view_employee_id"></span></p>
                            <p><strong>Full Name:</strong> <span id="view_full_name"></span></p>
                            <p><strong>Sex:</strong> <span id="view_sex"></span></p>
                            <p><strong>Civil Status:</strong> <span id="view_civil_status"></span></p>
                            <p><strong>Date of Birth:</strong> <span id="view_date_of_birth"></span></p>
                            <p><strong>Place of Birth:</strong> <span id="view_place_of_birth"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Employment Details</h6>
                            <p><strong>Department:</strong> <span id="view_department"></span></p>
                            <p><strong>Job Title:</strong> <span id="view_job_title"></span></p>
                            <p><strong>Employment Status:</strong> <span id="view_employment_status"></span></p>
                            <p><strong>Contact Info:</strong> <span id="view_contact_information"></span></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6 class="mb-3">Physical Information</h6>
                            <p><strong>Height:</strong> <span id="view_height"></span></p>
                            <p><strong>Weight:</strong> <span id="view_weight"></span></p>
                            <p><strong>Blood Type:</strong> <span id="view_blood_type"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Government IDs</h6>
                            <p><strong>GSIS:</strong> <span id="view_gsis_no"></span></p>
                            <p><strong>Pag-IBIG:</strong> <span id="view_pagibig_no"></span></p>
                            <p><strong>PhilHealth:</strong> <span id="view_philhealth_no"></span></p>
                            <p><strong>SSS:</strong> <span id="view_sss_no"></span></p>
                            <p><strong>TIN:</strong> <span id="view_tin_no"></span></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6 class="mb-3">Personal Information</h6>
                            <p><strong>Citizenship:</strong> <span id="view_citizenship"></span></p>
                            <p><strong>Religion:</strong> <span id="view_religion"></span></p>
                            <p><strong>Residential Address:</strong> <span id="view_residential_address"></span></p>
                            <p><strong>Permanent Address:</strong> <span id="view_permanent_address"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Family Background</h6>
                            <p><strong>Spouse's Name:</strong> <span id="view_spouse_name"></span></p>
                            <p><strong>Father's Name:</strong> <span id="view_father_name"></span></p>
                            <p><strong>Mother's Name:</strong> <span id="view_mother_name"></span></p>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6 class="mb-3">Educational Background</h6>
                            <p><strong>Highest Degree:</strong> <span id="view_highest_degree"></span></p>
                            <p><strong>School Graduated:</strong> <span id="view_school_graduated"></span></p>
                            <p><strong>Year Graduated:</strong> <span id="view_year_graduated"></span></p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="mb-3">Other Details</h6>
                            <p><strong>Special Skills:</strong> <span id="view_special_skills"></span></p>
                            <p><strong>Languages Spoken:</strong> <span id="view_languages_spoken"></span></p>
                            <p><strong>Hobbies:</strong> <span id="view_hobbies"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-info btn-sm"
                        onclick="viewEmployeeFiles('{{ $employee->id }}')">
                        View Files
                    </button> --}}

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openViewModal(masterlistId) {

            $.ajax({
                url: `/masterlist/${masterlistId}`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.error) {
                        alert(response.error);
                        return;
                    }

                    // Basic Information
                    $('#view_full_name').text(
                        `${response.first_name || ''} ${response.middle_initial || ''} ${response.last_name || ''}`
                    );
                    $('#view_employee_id').text(response.employee_id || 'N/A');

                    // Employment Details
                    $('#view_department').text(response.department || 'N/A');
                    $('#view_job_title').text(response.job_title || 'N/A');
                    $('#view_employment_status').text(response.employment_status || 'N/A');
                    $('#view_contact_information').text(response.contact_information || 'N/A');
                    $('#view_job_type').text(response.job_type || 'N/A');

                    // Personal Details
                    $('#view_sex').text(response.sex || 'N/A');
                    $('#view_civil_status').text(response.civil_status || 'N/A');
                    $('#view_date_of_birth').text(response.date_of_birth || 'N/A');
                    $('#view_place_of_birth').text(response.place_of_birth || 'N/A');

                    // Physical Information
                    $('#view_height').text(response.height ? response.height + ' m' : 'N/A');
                    $('#view_weight').text(response.weight ? response.weight + ' kg' : 'N/A');
                    $('#view_blood_type').text(response.blood_type || 'N/A');

                    // Government IDs
                    $('#view_gsis_no').text(response.gsis_no || 'N/A');
                    $('#view_pagibig_no').text(response.pagibig_no || 'N/A');
                    $('#view_philhealth_no').text(response.philhealth_no || 'N/A');
                    $('#view_sss_no').text(response.sss_no || 'N/A');
                    $('#view_tin_no').text(response.tin_no || 'N/A');

                    // Personal Information (Added)
                    $('#view_citizenship').text(response.citizenship || 'N/A');
                    $('#view_religion').text(response.religion || 'N/A');
                    $('#view_residential_address').text(response.residential_address || 'N/A');
                    $('#view_permanent_address').text(response.permanent_address || 'N/A');

                    // Family Background (Added)
                    $('#view_spouse_name').text(response.spouse_name || 'N/A');
                    $('#view_father_name').text(response.father_name || 'N/A');
                    $('#view_mother_name').text(response.mother_name || 'N/A');

                    // Educational Background (Added)
                    $('#view_highest_degree').text(response.highest_degree || 'N/A');
                    $('#view_school_graduated').text(response.school_graduated || 'N/A');
                    $('#view_year_graduated').text(response.year_graduated || 'N/A');

                    // Other Details (Added)
                    $('#view_special_skills').text(response.special_skills || 'N/A');
                    $('#view_languages_spoken').text(response.languages_spoken || 'N/A');
                    $('#view_hobbies').text(response.hobbies || 'N/A');

                    // Show the modal
                    $('#viewModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    alert('Employee Data is not available at the moment. Please check back soon.');
                }
            });
        }

        function viewEmployeeFiles(masterlistId) {
            if (!masterlistId) {
                alert('Invalid Masterlist ID');
                return;
            }

            $.ajax({
                url: `/employee/${masterlistId}/files`,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    const filesList = $('#employee-files-list');
                    filesList.empty();

                    if (response.files && response.files.length > 0) {
                        response.files.forEach(file => {
                            // Ensure correct path prefix
                            const filePath =
                                `/${file.path}`; // Add a leading slash to make it an absolute path
                            filesList.append(`
                        <div class="file-item">
                            <a href="${filePath}" target="_blank">${file.name}</a>
                            <span class="file-size">(${formatFileSize(file.size)})</span>
                        </div>
                    `);
                        });
                    } else {
                        filesList.html('<p>No files found for this employee.</p>');
                    }

                    // Show the modal after appending files
                    $('#viewModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching files:', xhr.responseText);
                    alert('An error occurred while fetching files.');
                }
            });
        }



        function formatFileSize(size) {
            const units = ['B', 'KB', 'MB', 'GB'];
            let index = 0;
            while (size >= 1024 && index < units.length - 1) {
                size /= 1024;
                index++;
            }
            return `${size.toFixed(2)} ${units[index]}`;
        }


        function formatFileSize(size) {
            const units = ['B', 'KB', 'MB', 'GB'];
            let index = 0;
            while (size >= 1024 && index < units.length - 1) {
                size /= 1024;
                index++;
            }
            return `${size.toFixed(2)} ${units[index]}`;
        }
    </script>
    </div>

@endsection
