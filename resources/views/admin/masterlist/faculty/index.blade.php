@extends('theme.layout')
@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h4> Master List</h4>

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
                                <th class="nk-tb-col"><span class="sub-text">Middle Initial</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Contact Information</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Employment Status</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Job Title</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Department</span></th>
                                <th class="nk-tb-col"><span class="sub-text">Action</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facultys as $index => $faculty)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $faculty->first_name }} {{ $faculty->middle_name }} {{ $faculty->last_name }}
                                    </td>
                                    <td>{{ $faculty->middle_initial }}</td>
                                    <td>{{ $faculty->contact_information }}</td>
                                    <td>{{ $faculty->employment_status }}</td>
                                    <td>{{ $faculty->job_title }}</td>
                                    <td>{{ $faculty->department }}</td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm"
                                            onclick="openViewModal({{ $faculty->id }})">
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

        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel">Employee Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Replace the existing modal-body div with this updated version -->
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function openViewModal(employeeId) {
                $.ajax({
                    url: `/masterlist/${employeeId}`,
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
        </script>
    </div>

@endsection
