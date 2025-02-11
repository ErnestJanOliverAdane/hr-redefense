// View: admin/others/edit.blade.php
@extends('theme.layout')

@section('content')
    <div class="nk-block">
        <div class="card">
            <div class="card-inner">
                <form action="{{ route('admin.others.update', $request->coe_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label for="FirstName">First Name</label>
                        <input type="text" class="form-control" id="FirstName" name="FirstName"
                            value="{{ old('FirstName', $request->FirstName) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="LastName">Last Name</label>
                        <input type="text" class="form-control" id="LastName" name="LastName"
                            value="{{ old('LastName', $request->LastName) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="Email"
                            value="{{ old('Email', $request->Email) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="Position">Position</label>
                        <input type="text" class="form-control" id="Position" name="Position"
                            value="{{ old('Position', $request->Position) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="DateStarted">Date Started</label>
                        <input type="date" class="form-control" id="DateStarted" name="DateStarted"
                            value="{{ old('DateStarted', $request->DateStarted) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="MonthlyCompensationText">Monthly Compensation (Text)</label>
                        <input type="text" class="form-control" id="MonthlyCompensationText"
                            name="MonthlyCompensationText"
                            value="{{ old('MonthlyCompensationText', $request->MonthlyCompensationText) }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="MonthlyCompensationDigits">Monthly Compensation (Amount)</label>
                        <input type="number" step="0.01" class="form-control" id="MonthlyCompensationDigits"
                            name="MonthlyCompensationDigits"
                            value="{{ old('MonthlyCompensationDigits', $request->MonthlyCompensationDigits) }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update Request</button>
                        <a href="{{ $request->status === 'approve'
                            ? route('admin.others.Approve')
                            : ($request->status === 'reject'
                                ? route('admin.others.rejected')
                                : route('admin.others.request')) }}"
                            class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
