@extends('employee_theme.layout')
@section('content')
    <h4 class="header">Request Service Record</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>Fill out the form below to request your certificate of service record.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('sorequest.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="card-title">Employee Information</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <tbody>
                        {{-- <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_tin">Tin No.<b class="text-danger">*</b></label>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_tin" name="inp_tin"
                                        placeholder="" required readonly
                                        value="{{ old('inp_tin', $personalinformation-> tin_no ?? '') }}">
                                </div>
                            </td>
                        </tr> --}}
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_email">Email <b class="text-danger">*</b></label>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="inp_email" name="inp_email"
                                        placeholder="" required readonly
                                        value="{{ old('inp_email', $masterlist->contact_information ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_bd">Birth Date<b class="text-danger">*</b></label>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_bd" name="inp_bd" placeholder=""
                                        required readonly
                                        value="{{ old('inp_bd', $personalinformation->date_of_birth ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_bp">Birth Place<b class="text-danger">*</b></label>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="email" class="form-control" id="inp_bp" name="inp_bp" placeholder=""
                                        required readonly
                                        value="{{ old('inp_bp', $personalinformation->place_of_birth ?? '') }}">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-lg-5">
                                <div class="form-group">
                                    <label class="form-label" for="inp_purpose">Purpose</label>
                                    <span class="form-note">Specify the purpose here.</span>
                                </div>
                            </td>
                            <td class="col-lg-7">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="inp_purpose" name="inp_purpose"
                                        placeholder="Enter Purpose here...">
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

            <!-- Attachment Section -->
            <div class="card-body border-top">
                <h5 class="card-title">Attachment</h5>
                <p class="text-muted">( If first time to request submit a photocopy of appointment. )</p>
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input type="file" class="form-control" id="inp_photocopy" name="inp_photocopy"
                            accept="image/*,application/pdf">
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
