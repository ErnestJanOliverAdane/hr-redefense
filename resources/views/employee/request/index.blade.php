@extends('employee_theme.layout')
@section('content')
    <h4 class="header">Request Certificate of Employment</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>Fill out the form below to request your certificate of employment.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('request.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="card-title">Employee Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <tbody>
                        <!-- First Name -->
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_fn">First Name <b class="text-danger">*</b></label>
                                    <span class="form-note">Specify the First Name here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_fn" name="inp_fn"
                                        placeholder="Enter First Name here..." required readonly
                                        value="{{ old('inp_fn', $masterlist->first_name ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <!-- Last Name -->
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_ln">Last Name <b class="text-danger">*</b></label>
                                    <span class="form-note">Specify the Last Name here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_ln" name="inp_ln"
                                        placeholder="Enter Last Name here..." required readonly
                                        value="{{ old('inp_ln', $masterlist->last_name ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <!-- Email -->
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_email">Email <b class="text-danger">*</b></label>
                                    <span class="form-note">Specify the email address here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="inp_email" name="inp_email"
                                        placeholder="Enter Email here..." required readonly
                                        value="{{ old('inp_email', $masterlist->contact_information ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <!-- Position -->
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_position">Position</label>
                                    <span class="form-note">Specify the position here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_position" name="inp_position"
                                        placeholder="Enter Position here..." required readonly
                                        value="{{ old('inp_position', $masterlist->job_title ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <!-- Date Started -->

                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_date_started">Date Started</label>
                                    <span class="form-note">Specify the date here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="date" class="form-control" id="inp_date_started" name="inp_date_started"
                                        value="{{ old('inp_date_started', $dateStarted) }}" required readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_or">Position</label>
                                    <span class="form-note">Specify the position here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_or" name="inp_or"
                                        placeholder="Enter OR here..." required>
                                </div>
                            </td>
                        </tr>


                        <!-- Monthly Compensation -->
                        {{-- <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="ern_text">Monthly Compensation</label>
                                    <span class="form-note">Specify the monthly compensation here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control" id="ern_text" name="ern_text"
                                            placeholder="Enter compensation (text)" required>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="number" class="form-control" id="ern_digits" name="ern_digits"
                                            placeholder="Enter compensation (digits)" required>
                                    </div>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>

                </table>
            </div>
            <!-- Proof of Payment Attachment Section -->
            <div class="card-body border-top">
                <h5 class="card-title">Attach Proof of Payment</h5>
                <p class="text-muted">Upload the proof of payment for your request. Accepted file formats are images and
                    PDFs.
                </p>
                <div class="form-group">
                    <label class="form-label" for="inp_proof_payment">Proof of Payment <b class="text-danger">*</b></label>
                    <div class="form-control-wrap">
                        <input type="file" class="form-control" id="inp_proof_payment" name="inp_proof_payment"
                            accept="image/*,application/pdf" required>
                    </div>
                    <span class="form-note text-muted">Max file size: 5MB. Allowed formats: .jpg, .png, .pdf</span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    <em class="icon ni ni-save"></em> Submit Request
                </button>
            </div>

        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
@endsection
