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


                        <!-- Job Type -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="job_title">Job Type <b
                                            class="text-danger">*</b></label>
                                    <span class="form-note">Specify the job Type here.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" id="job_type" name="job_type" required>
                                    <option value="">Select Job Type</option>
                                    @foreach ($jobTypes as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="faculty-fields" style="display: none;">
                        <!-- Current Rank -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="current_rank"> Rank <b class="text-danger">*</b></label>
                                    <span class="form-note">Select the rank.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <select class="form-control" id="current_rank" name="current_rank">
                                    <option value="">Select Rank</option>
                                    <option value="Instructor I">Instructor I</option>
                                    <option value="Instructor II">Instructor II</option>
                                    <option value="Instructor III">Instructor III</option>
                                    <option value="Assistant Professor I">Assistant Professor I</option>
                                    <option value="Assistant Professor II">Assistant Professor II</option>
                                    <option value="Assistant Professor III">Assistant Professor III</option>
                                    <option value="Associate Professor I">Associate Professor I</option>
                                    <option value="Associate Professor II">Associate Professor II</option>
                                    <option value="Associate Professor III">Associate Professor III</option>
                                    <option value="Professor I">Professor I</option>
                                    <option value="Professor II">Professor II</option>
                                    <option value="Professor III">Professor III</option>
                                </select>
                            </div>
                        </div>

                        <!-- Current Qualification -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="current_qual"> Qualification <b class="text-danger">*</b></label>
                                    <span class="form-note">Specify the qualification.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="current_qual" name="current_qual" 
                                        placeholder="Enter Qualification...">
                                </div>
                            </div>
                        </div>

                        <!-- Current Field -->
                        <div class="row mt-2 align-center">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="current_field"> Field <b class="text-danger">*</b></label>
                                    <span class="form-note">Specify the field.</span>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="current_field" name="current_field" 
                                        placeholder="Enter Field...">
                                </div>
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
                    document.getElementById('job_type').addEventListener('change', function() {
                        const facultyFields = document.getElementById('faculty-fields');
                        const facultyInputs = facultyFields.querySelectorAll('input, select');
                        
                        if (this.value === 'Faculty') {
                            facultyFields.style.display = 'block';
                            facultyInputs.forEach(input => {
                                input.setAttribute('required', 'required');
                            });
                        } else {
                            facultyFields.style.display = 'none';
                            facultyInputs.forEach(input => {
                                input.removeAttribute('required');
                                input.value = '';
                            });
                        }
                    });</script>
                    

                </div>
            @endsection
