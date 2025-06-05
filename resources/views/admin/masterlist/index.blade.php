@extends('theme.layout')
@section('content')

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h4>Employee Master List</h4>
            <div class="d-flex gap-2">

                {{-- <!-- Import form -->
                <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data"
                    class="d-flex align-items-center">
                    @csrf
                    <div class="me-2">
                        <label for="file" class="form-label">Choose Spreadsheet</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form> --}}
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

                    <button type="button" class="btn btn-primary" onclick="downloadEmployeePDF()">
                        <i class="fas fa-download"></i> Download PDF
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        let currentEmployeeData = null; // Store current employee data for PDF generation

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

                    // Store employee data for PDF generation
                    currentEmployeeData = response;

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

        function downloadEmployeePDF() {
            if (!currentEmployeeData) {
                alert('No employee data available for PDF generation.');
                return;
            }

            const {
                jsPDF
            } = window.jspdf;
            const doc = new jsPDF('portrait', 'mm', 'legal'); // Legal size paper (8.5" x 14")

            // Document setup
            const pageWidth = doc.internal.pageSize.width;
            const pageHeight = doc.internal.pageSize.height;
            const margin = 12;
            let yPosition = margin;
            const cellHeight = 12;
            const fullWidth = pageWidth - (margin * 2);

            // Helper function to draw a box with text
            function drawBox(x, y, width, height, text = '', fontSize = 9, bold = false, align = 'left') {
                doc.rect(x, y, width, height);
                if (text) {
                    doc.setFontSize(fontSize);
                    doc.setFont(undefined, bold ? 'bold' : 'normal');
                    const textY = y + height - 3;
                    const textX = align === 'center' ? x + (width / 2) : x + 2;
                    doc.text(text, textX, textY, {
                        align: align
                    });
                }
            }

            // Helper function to draw label box (gray background)
            function drawLabelBox(x, y, width, height, text, fontSize = 8) {
                doc.setFillColor(220, 220, 220);
                doc.rect(x, y, width, height, 'F');
                doc.rect(x, y, width, height);
                doc.setFontSize(fontSize);
                doc.setFont(undefined, 'bold');
                doc.text(text, x + 2, y + height - 3);
                doc.setFont(undefined, 'normal');
            }

            // Helper function to check page break
            function checkNewPage(yPos, requiredSpace = 30) {
                if (yPos + requiredSpace > pageHeight - margin) {
                    doc.addPage();
                    doc.setFontSize(7);
                    doc.text('', margin, 10);
                    doc.text('Page 2 of 4', pageWidth - margin - 20, 10);
                    return 20;
                }
                return yPos;
            }

            // Header - CS Form identification
            doc.setFontSize(10);
            doc.setFont(undefined, 'bold');
            doc.text('', margin, yPosition);
            yPosition += 5;
            doc.text('', margin, yPosition);
            yPosition += 20;

            // Main title
            doc.setFontSize(22);
            doc.setFont(undefined, 'bold');
            doc.text('PERSONAL DATA SHEET', pageWidth / 2, yPosition, {
                align: 'center'
            });
            yPosition += 20;

            // Warning text
            doc.setFontSize(9);
            doc.setFont(undefined, 'bold');
            const warningText =
                'WARNING: Any misrepresentation made in the Personal Data Sheet and the Work Experience Sheet shall cause the filing of administrative/criminal case/s against the person concerned.';
            const warningLines = doc.splitTextToSize(warningText, fullWidth);
            doc.text(warningLines, margin, yPosition);
            yPosition += warningLines.length * 4 + 8;

            // Instructions
            doc.setFontSize(9);
            doc.setFont(undefined, 'bold');
            doc.text(
                'READ THE ATTACHED GUIDE TO FILLING OUT THE PERSONAL DATA SHEET (PDS) BEFORE ACCOMPLISHING THE PDS FORM.',
                margin, yPosition);
            yPosition += 8;
            doc.setFont(undefined, 'normal');
            doc.text(
                'Print legibly. Tick appropriate boxes (☑) and use separate sheet if necessary. Indicate N/A if not applicable. DO NOT ABBREVIATE.',
                margin, yPosition);
            yPosition += 15;

            // =============================================
            // I. PERSONAL INFORMATION SECTION
            // =============================================
            drawLabelBox(margin, yPosition, fullWidth, 10, 'I. PERSONAL INFORMATION');
            yPosition += 10;

            // Row 2: Name Information
            drawLabelBox(margin, yPosition, 15, cellHeight, '2.');
            drawLabelBox(margin + 15, yPosition, 50, cellHeight, 'SURNAME');
            drawBox(margin + 65, yPosition, 85, cellHeight, (currentEmployeeData.last_name || '').toUpperCase());
            drawLabelBox(margin + 150, yPosition, 65, cellHeight, 'NAME EXTENSION (JR., SR)');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 50, cellHeight, 'FIRST NAME');
            drawBox(margin + 65, yPosition, 150, cellHeight, (currentEmployeeData.first_name || '').toUpperCase());
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 50, cellHeight, 'MIDDLE NAME');
            drawBox(margin + 65, yPosition, 150, cellHeight, (currentEmployeeData.middle_name || '').toUpperCase());
            yPosition += cellHeight + 3;

            // Row 3: Date of Birth & Citizenship
            drawLabelBox(margin, yPosition, 15, cellHeight, '3.');
            drawLabelBox(margin + 15, yPosition, 65, cellHeight, 'DATE OF BIRTH (mm/dd/yyyy)');
            drawBox(margin + 80, yPosition, 50, cellHeight, currentEmployeeData.date_of_birth || '');
            drawLabelBox(margin + 135, yPosition, 40, cellHeight, '16. CITIZENSHIP');

            // Citizenship checkboxes
            const citizenship = (currentEmployeeData.citizenship || '').toLowerCase();
            doc.setFontSize(9);
            doc.text(citizenship === 'filipino' ? '☑ Filipino' : '☐ Filipino', margin + 177, yPosition + 8);
            doc.text('☐ Dual Citizenship', margin + 177, yPosition + 12);
            yPosition += cellHeight + 3;

            // Row 4: Place of Birth
            drawLabelBox(margin, yPosition, 15, cellHeight, '4.');
            drawLabelBox(margin + 15, yPosition, 65, cellHeight, 'PLACE OF BIRTH');
            drawBox(margin + 80, yPosition, 135, cellHeight, currentEmployeeData.place_of_birth || '');
            yPosition += cellHeight + 3;

            // Row 5: Sex & Residential Address
            drawLabelBox(margin, yPosition, 15, cellHeight, '5.');
            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'SEX');

            const sex = (currentEmployeeData.sex || '').toLowerCase();
            doc.setFontSize(9);
            doc.text(sex === 'male' ? '☑ Male' : '☐ Male', margin + 47, yPosition + 8);
            doc.text(sex === 'female' ? '☑ Female' : '☐ Female', margin + 75, yPosition + 8);

            drawLabelBox(margin + 105, yPosition, 55, cellHeight, '17. RESIDENTIAL ADDRESS');
            drawLabelBox(margin + 160, yPosition, 55, cellHeight / 2, 'House/Block/Lot No.');
            drawLabelBox(margin + 160, yPosition + cellHeight / 2, 55, cellHeight / 2, 'Street');
            yPosition += cellHeight;

            // Row 6: Civil Status & Address continuation
            drawLabelBox(margin, yPosition, 15, cellHeight, '6.');
            drawLabelBox(margin + 15, yPosition, 45, cellHeight, 'CIVIL STATUS');

            const civilStatus = (currentEmployeeData.civil_status || '').toLowerCase();
            doc.setFontSize(8);
            doc.text(civilStatus === 'single' ? '☑ Single' : '☐ Single', margin + 62, yPosition + 8);
            doc.text(civilStatus === 'married' ? '☑ Married' : '☐ Married', margin + 90, yPosition + 8);
            doc.text(civilStatus === 'widowed' ? '☑ Widowed' : '☐ Widowed', margin + 120, yPosition + 8);
            doc.text(civilStatus === 'separated' ? '☑ Separated' : '☐ Separated', margin + 150, yPosition + 8);

            drawLabelBox(margin + 160, yPosition, 27, cellHeight / 2, 'Subdivision/Village');
            drawLabelBox(margin + 187, yPosition, 28, cellHeight / 2, 'Barangay');
            drawLabelBox(margin + 160, yPosition + cellHeight / 2, 27, cellHeight / 2, 'City/Municipality');
            drawLabelBox(margin + 187, yPosition + cellHeight / 2, 28, cellHeight / 2, 'Province');
            yPosition += cellHeight + 3;

            // Permanent Address
            drawLabelBox(margin, yPosition, 60, cellHeight, '18. PERMANENT ADDRESS');
            drawLabelBox(margin + 60, yPosition, 35, cellHeight / 2, 'House/Block/Lot No.');
            drawLabelBox(margin + 95, yPosition, 30, cellHeight / 2, 'Street');
            drawLabelBox(margin + 60, yPosition + cellHeight / 2, 35, cellHeight / 2, 'Subdivision/Village');
            drawLabelBox(margin + 95, yPosition + cellHeight / 2, 30, cellHeight / 2, 'Barangay');

            drawLabelBox(margin + 125, yPosition, 45, cellHeight / 2, 'City/Municipality');
            drawLabelBox(margin + 170, yPosition, 30, cellHeight / 2, 'Province');
            drawLabelBox(margin + 125, yPosition + cellHeight / 2, 45, cellHeight / 2, 'ZIP CODE');
            yPosition += cellHeight + 5;

            // Physical Information & Contact Details (Side by side)
            const leftColY = yPosition;

            // Left column - Physical info
            drawLabelBox(margin, leftColY, 15, cellHeight, '7.');
            drawLabelBox(margin + 15, leftColY, 40, cellHeight, 'HEIGHT (m)');
            drawBox(margin + 55, leftColY, 30, cellHeight, currentEmployeeData.height || '');

            drawLabelBox(margin, leftColY + cellHeight, 15, cellHeight, '8.');
            drawLabelBox(margin + 15, leftColY + cellHeight, 40, cellHeight, 'WEIGHT (kg)');
            drawBox(margin + 55, leftColY + cellHeight, 30, cellHeight, currentEmployeeData.weight || '');

            drawLabelBox(margin, leftColY + cellHeight * 2, 15, cellHeight, '9.');
            drawLabelBox(margin + 15, leftColY + cellHeight * 2, 40, cellHeight, 'BLOOD TYPE');
            drawBox(margin + 55, leftColY + cellHeight * 2, 30, cellHeight, currentEmployeeData.blood_type || '');

            // Right column - Contact info
            drawLabelBox(margin + 105, leftColY, 50, cellHeight, '19. TELEPHONE NO.');
            drawBox(margin + 155, leftColY, 60, cellHeight, currentEmployeeData.contact_information || '');

            drawLabelBox(margin + 105, leftColY + cellHeight, 50, cellHeight, '20. MOBILE NO.');
            drawBox(margin + 155, leftColY + cellHeight, 60, cellHeight, '');

            drawLabelBox(margin + 105, leftColY + cellHeight * 2, 50, cellHeight, '21. E-MAIL ADDRESS (if any)');
            drawBox(margin + 155, leftColY + cellHeight * 2, 60, cellHeight, '');

            yPosition = leftColY + cellHeight * 3 + 8;

            // Government IDs
            const govIdY = yPosition;
            drawLabelBox(margin, govIdY, 15, cellHeight, '10.');
            drawLabelBox(margin + 15, govIdY, 40, cellHeight, 'GSIS ID NO.');
            drawBox(margin + 55, govIdY, 45, cellHeight, currentEmployeeData.gsis_no || '');

            drawLabelBox(margin, govIdY + cellHeight, 15, cellHeight, '11.');
            drawLabelBox(margin + 15, govIdY + cellHeight, 40, cellHeight, 'PAG-IBIG ID NO.');
            drawBox(margin + 55, govIdY + cellHeight, 45, cellHeight, currentEmployeeData.pagibig_no || '');

            drawLabelBox(margin, govIdY + cellHeight * 2, 15, cellHeight, '12.');
            drawLabelBox(margin + 15, govIdY + cellHeight * 2, 40, cellHeight, 'PHILHEALTH NO.');
            drawBox(margin + 55, govIdY + cellHeight * 2, 45, cellHeight, currentEmployeeData.philhealth_no || '');

            drawLabelBox(margin, govIdY + cellHeight * 3, 15, cellHeight, '13.');
            drawLabelBox(margin + 15, govIdY + cellHeight * 3, 40, cellHeight, 'SSS NO.');
            drawBox(margin + 55, govIdY + cellHeight * 3, 45, cellHeight, currentEmployeeData.sss_no || '');

            drawLabelBox(margin, govIdY + cellHeight * 4, 15, cellHeight, '14.');
            drawLabelBox(margin + 15, govIdY + cellHeight * 4, 40, cellHeight, 'TIN NO.');
            drawBox(margin + 55, govIdY + cellHeight * 4, 45, cellHeight, currentEmployeeData.tin_no || '');

            drawLabelBox(margin, govIdY + cellHeight * 5, 15, cellHeight, '15.');
            drawLabelBox(margin + 15, govIdY + cellHeight * 5, 40, cellHeight, 'AGENCY EMPLOYEE NO.');
            drawBox(margin + 55, govIdY + cellHeight * 5, 45, cellHeight, currentEmployeeData.employee_id || '');

            yPosition = govIdY + cellHeight * 6 + 10;

            // =============================================
            // II. FAMILY BACKGROUND SECTION
            // =============================================
            yPosition = checkNewPage(yPosition, 120);
            drawLabelBox(margin, yPosition, fullWidth, 10, 'II. FAMILY BACKGROUND');
            yPosition += 10;

            // Spouse Information
            drawLabelBox(margin, yPosition, 15, cellHeight, '22.');
            drawLabelBox(margin + 15, yPosition, 60, cellHeight, 'SPOUSE\'S SURNAME');
            const spouseName = currentEmployeeData.spouse_name || '';
            const spouseLastName = spouseName.split(' ').pop() || '';
            drawBox(margin + 75, yPosition, 50, cellHeight, spouseLastName.toUpperCase());

            drawLabelBox(margin + 130, yPosition, 60, cellHeight, '23. NAME OF CHILDREN (Write full name and list all)');
            drawLabelBox(margin + 190, yPosition, 25, cellHeight, 'DATE OF BIRTH');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'FIRST NAME');
            const spouseFirstName = spouseName.split(' ')[0] || '';
            drawBox(margin + 45, yPosition, 40, cellHeight, spouseFirstName.toUpperCase());
            drawLabelBox(margin + 85, yPosition, 40, cellHeight, 'NAME EXTENSION (JR., SR)');

            drawLabelBox(margin + 190, yPosition, 25, cellHeight, '(mm/dd/yyyy)');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'MIDDLE NAME');
            drawBox(margin + 45, yPosition, 80, cellHeight, '');

            // Children entries (3 rows)
            for (let i = 0; i < 3; i++) {
                drawBox(margin + 130, yPosition + (i * cellHeight), 60, cellHeight, '');
                drawBox(margin + 190, yPosition + (i * cellHeight), 25, cellHeight, '');
            }
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'OCCUPATION');
            drawBox(margin + 45, yPosition, 80, cellHeight, '');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 40, cellHeight, 'EMPLOYER/BUSINESS NAME');
            drawBox(margin + 55, yPosition, 70, cellHeight, '');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 40, cellHeight, 'BUSINESS ADDRESS');
            drawBox(margin + 55, yPosition, 70, cellHeight, '');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'TELEPHONE NO.');
            drawBox(margin + 45, yPosition, 40, cellHeight, '');
            yPosition += cellHeight + 5;

            // Father's Information
            drawLabelBox(margin, yPosition, 15, cellHeight, '24.');
            drawLabelBox(margin + 15, yPosition, 35, cellHeight, 'FATHER\'S SURNAME');
            const fatherName = currentEmployeeData.father_name || '';
            const fatherLastName = fatherName.split(' ').pop() || '';
            drawBox(margin + 50, yPosition, 60, cellHeight, fatherLastName.toUpperCase());
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'FIRST NAME');
            const fatherFirstName = fatherName.split(' ')[0] || '';
            drawBox(margin + 45, yPosition, 45, cellHeight, fatherFirstName.toUpperCase());
            drawLabelBox(margin + 90, yPosition, 40, cellHeight, 'NAME EXTENSION (JR., SR)');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'MIDDLE NAME');
            drawBox(margin + 45, yPosition, 85, cellHeight, '');
            yPosition += cellHeight + 5;

            // Mother's Information
            drawLabelBox(margin, yPosition, 15, cellHeight, '25.');
            drawLabelBox(margin + 15, yPosition, 40, cellHeight, 'MOTHER\'S MAIDEN NAME');
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'SURNAME');
            const motherName = currentEmployeeData.mother_name || '';
            const motherLastName = motherName.split(' ').pop() || '';
            drawBox(margin + 45, yPosition, 60, cellHeight, motherLastName.toUpperCase());
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'FIRST NAME');
            const motherFirstName = motherName.split(' ')[0] || '';
            drawBox(margin + 45, yPosition, 45, cellHeight, motherFirstName.toUpperCase());
            yPosition += cellHeight;

            drawLabelBox(margin + 15, yPosition, 30, cellHeight, 'MIDDLE NAME');
            drawBox(margin + 45, yPosition, 85, cellHeight, '');
            yPosition += cellHeight + 15;

            // =============================================
            // III. EDUCATIONAL BACKGROUND SECTION
            // =============================================
            yPosition = checkNewPage(yPosition, 150);
            drawLabelBox(margin, yPosition, fullWidth, 10, 'III. EDUCATIONAL BACKGROUND');
            yPosition += 10;

            // Educational background table headers
            drawLabelBox(margin, yPosition, 15, cellHeight, '26.');
            drawLabelBox(margin + 15, yPosition, 50, cellHeight, 'LEVEL');
            drawLabelBox(margin + 65, yPosition, 55, cellHeight, 'NAME OF SCHOOL');
            drawLabelBox(margin + 120, yPosition, 35, cellHeight, 'BASIC EDUCATION/');
            drawLabelBox(margin + 155, yPosition, 25, cellHeight, 'PERIOD OF');
            drawLabelBox(margin + 180, yPosition, 25, cellHeight, 'HIGHEST LEVEL/');
            drawLabelBox(margin + 205, yPosition, 15, cellHeight, 'YEAR');
            yPosition += cellHeight;

            // Sub-headers row 1
            drawLabelBox(margin + 120, yPosition, 35, cellHeight / 2, 'DEGREE/COURSE');
            drawLabelBox(margin + 155, yPosition, 12, cellHeight / 2, 'FROM');
            drawLabelBox(margin + 167, yPosition, 13, cellHeight / 2, 'TO');
            drawLabelBox(margin + 180, yPosition, 25, cellHeight / 2, 'UNITS EARNED');
            drawLabelBox(margin + 205, yPosition, 15, cellHeight / 2, 'GRADUATED');
            yPosition += cellHeight / 2;

            // Sub-headers row 2
            drawLabelBox(margin + 120, yPosition, 35, cellHeight / 2, '(Write in full)');
            drawLabelBox(margin + 180, yPosition, 25, cellHeight / 2, '(if not graduated)');
            yPosition += cellHeight / 2;

            // Educational levels
            const educationLevels = [
                'ELEMENTARY',
                'SECONDARY',
                'VOCATIONAL/TRADE COURSE',
                'COLLEGE',
                'GRADUATE STUDIES'
            ];

            educationLevels.forEach((level) => {
                drawLabelBox(margin + 15, yPosition, 50, cellHeight, level);

                if (level === 'COLLEGE') {
                    drawBox(margin + 65, yPosition, 55, cellHeight, (currentEmployeeData.school_graduated || '')
                        .toUpperCase());
                    drawBox(margin + 120, yPosition, 35, cellHeight, (currentEmployeeData.highest_degree || '')
                        .toUpperCase());
                    drawBox(margin + 155, yPosition, 12, cellHeight, '');
                    drawBox(margin + 167, yPosition, 13, cellHeight, '');
                    drawBox(margin + 180, yPosition, 25, cellHeight, '');
                    drawBox(margin + 205, yPosition, 15, cellHeight, currentEmployeeData.year_graduated || '');
                } else {
                    drawBox(margin + 65, yPosition, 55, cellHeight, '');
                    drawBox(margin + 120, yPosition, 35, cellHeight, '');
                    drawBox(margin + 155, yPosition, 12, cellHeight, '');
                    drawBox(margin + 167, yPosition, 13, cellHeight, '');
                    drawBox(margin + 180, yPosition, 25, cellHeight, '');
                    drawBox(margin + 205, yPosition, 15, cellHeight, '');
                }
                yPosition += cellHeight;
            });

            yPosition += 15;

            // =============================================
            // IV. CIVIL SERVICE ELIGIBILITY SECTION
            // =============================================
            yPosition = checkNewPage(yPosition, 120);
            drawLabelBox(margin, yPosition, fullWidth, 10, 'IV. CIVIL SERVICE ELIGIBILITY');
            yPosition += 10;

            // Civil service table headers
            drawLabelBox(margin, yPosition, 15, cellHeight, '27.');
            drawLabelBox(margin + 15, yPosition, 55, cellHeight, 'CAREER SERVICE/');
            drawLabelBox(margin + 70, yPosition, 20, cellHeight, 'RATING');
            drawLabelBox(margin + 90, yPosition, 30, cellHeight, 'DATE OF');
            drawLabelBox(margin + 120, yPosition, 35, cellHeight, 'PLACE OF');
            drawLabelBox(margin + 155, yPosition, 25, cellHeight, 'LICENSE');
            drawLabelBox(margin + 180, yPosition, 25, cellHeight, 'DATE OF');
            yPosition += cellHeight;

            // Sub-headers for civil service
            const civilServiceHeaders = [
                'RA 1080 (BOARD/',
                'BAR) UNDER',
                'SPECIAL LAWS/CES/',
                'CSEE BARANGAY',
                'ELIGIBILITY/DRIVER\'S',
                'LICENSE'
            ];

            civilServiceHeaders.forEach((header, index) => {
                if (index === 0) {
                    drawLabelBox(margin + 15, yPosition, 55, cellHeight / 2, header);
                    drawLabelBox(margin + 70, yPosition, 20, cellHeight / 2, '(If Applicable)');
                    drawLabelBox(margin + 90, yPosition, 30, cellHeight / 2, 'EXAMINATION/');
                    drawLabelBox(margin + 120, yPosition, 35, cellHeight / 2, 'EXAMINATION/');
                    drawLabelBox(margin + 155, yPosition, 25, cellHeight / 2, '(If Applicable)');
                    drawLabelBox(margin + 180, yPosition, 25, cellHeight / 2, 'VALIDITY');
                } else if (index === 1) {
                    drawLabelBox(margin + 15, yPosition, 55, cellHeight / 2, header);
                    drawLabelBox(margin + 90, yPosition, 30, cellHeight / 2, 'CONFERMENT');
                    drawLabelBox(margin + 120, yPosition, 35, cellHeight / 2, 'CONFERMENT');
                } else {
                    drawLabelBox(margin + 15, yPosition, 55, cellHeight / 2, header);
                }
                yPosition += cellHeight / 2;
            });

            // Add empty rows for civil service eligibility
            for (let i = 0; i < 3; i++) {
                drawBox(margin + 15, yPosition, 55, cellHeight, '');
                drawBox(margin + 70, yPosition, 20, cellHeight, '');
                drawBox(margin + 90, yPosition, 30, cellHeight, '');
                drawBox(margin + 120, yPosition, 35, cellHeight, '');
                drawBox(margin + 155, yPosition, 25, cellHeight, '');
                drawBox(margin + 180, yPosition, 25, cellHeight, '');
                yPosition += cellHeight;
            }

            yPosition += 15;

            // =============================================
            // V. WORK EXPERIENCE SECTION
            // =============================================
            yPosition = checkNewPage(yPosition, 150);
            drawLabelBox(margin, yPosition, fullWidth, 10, 'V. WORK EXPERIENCE');
            yPosition += 10;

            // Work experience note
            doc.setFontSize(8);
            doc.text(
                '(Include private employment. Start from your recent work) Description of duties should be indicated in the attached Work Experience sheet.',
                margin, yPosition);
            yPosition += 10;

            // Work experience table headers
            drawLabelBox(margin, yPosition, 15, cellHeight, '28.');
            drawLabelBox(margin + 15, yPosition, 35, cellHeight, 'INCLUSIVE DATES');
            drawLabelBox(margin + 50, yPosition, 45, cellHeight, 'POSITION TITLE');
            drawLabelBox(margin + 95, yPosition, 40, cellHeight, 'DEPARTMENT/');
            drawLabelBox(margin + 135, yPosition, 20, cellHeight, 'MONTHLY');
            drawLabelBox(margin + 155, yPosition, 20, cellHeight, 'SALARY/');
            drawLabelBox(margin + 175, yPosition, 20, cellHeight, 'STATUS OF');
            drawLabelBox(margin + 195, yPosition, 20, cellHeight, 'GOV\'T');
            yPosition += cellHeight;

            // Sub-headers for work experience
            drawLabelBox(margin + 15, yPosition, 17, cellHeight / 2, 'FROM');
            drawLabelBox(margin + 32, yPosition, 18, cellHeight / 2, 'TO');
            drawLabelBox(margin + 50, yPosition, 45, cellHeight / 2, '(Write in full/');
            drawLabelBox(margin + 95, yPosition, 40, cellHeight / 2, 'AGENCY/OFFICE/');
            drawLabelBox(margin + 135, yPosition, 20, cellHeight / 2, 'SALARY');
            drawLabelBox(margin + 155, yPosition, 20, cellHeight / 2, 'JOB/PAY');
            drawLabelBox(margin + 175, yPosition, 20, cellHeight / 2, 'APPOINTMENT');
            drawLabelBox(margin + 195, yPosition, 20, cellHeight / 2, 'SERVICE');
            yPosition += cellHeight / 2;

            drawLabelBox(margin + 50, yPosition, 45, cellHeight / 2, 'Do not abbreviate)');
            drawLabelBox(margin + 95, yPosition, 40, cellHeight / 2, 'COMPANY');
            drawLabelBox(margin + 155, yPosition, 20, cellHeight / 2, 'GRADE');
            yPosition += cellHeight / 2;

            // Add current employment if available
            if (currentEmployeeData.job_title || currentEmployeeData.department) {
                drawBox(margin + 15, yPosition, 17, cellHeight, '');
                drawBox(margin + 32, yPosition, 18, cellHeight, 'PRESENT');
                drawBox(margin + 50, yPosition, 45, cellHeight, (currentEmployeeData.job_title || '').toUpperCase());
                drawBox(margin + 95, yPosition, 40, cellHeight, (currentEmployeeData.department || '').toUpperCase());
                drawBox(margin + 135, yPosition, 20, cellHeight, '');
                drawBox(margin + 155, yPosition, 20, cellHeight, '');
                drawBox(margin + 175, yPosition, 20, cellHeight, currentEmployeeData.employment_status || '');
                drawBox(margin + 195, yPosition, 20, cellHeight, 'Y');
                yPosition += cellHeight;
            }

            // Add empty rows for additional work experience
            for (let i = 0; i < 4; i++) {
                drawBox(margin + 15, yPosition, 17, cellHeight, '');
                drawBox(margin + 32, yPosition, 18, cellHeight, '');
                drawBox(margin + 50, yPosition, 45, cellHeight, '');
                drawBox(margin + 95, yPosition, 40, cellHeight, '');
                drawBox(margin + 135, yPosition, 20, cellHeight, '');
                drawBox(margin + 155, yPosition, 20, cellHeight, '');
                drawBox(margin + 175, yPosition, 20, cellHeight, '');
                drawBox(margin + 195, yPosition, 20, cellHeight, '');
                yPosition += cellHeight;
            }

            // Footer with form reference
            doc.setFontSize(7);
            doc.text('CS Form No. 212 (Revised 2017)', margin, pageHeight - 15);
            doc.text('Page 1 of 4', pageWidth - margin - 20, pageHeight - 15);

            // Generate timestamp
            const currentDate = new Date().toLocaleDateString();
            doc.text(`Generated on: ${currentDate}`, pageWidth - margin - 60, pageHeight - 8);

            // Save the PDF
            const fullName =
                `${currentEmployeeData.first_name || ''} ${currentEmployeeData.middle_initial || ''} ${currentEmployeeData.last_name || ''}`
                .trim();
            const fileName = `PDS_${fullName.replace(/\s+/g, '_')}_${new Date().getTime()}.pdf`;
            doc.save(fileName);
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
    </script>

@endsection
