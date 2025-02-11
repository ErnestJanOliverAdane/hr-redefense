@extends('theme.layout')

@section('content')
    <h4 class="header">Manage Request Certificate of Employment</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>List of approved requests.</p>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-inner">
                        <table class="datatable-init table table-hover">
                            <thead>
                                <tr>
                                    <th width="20">#</th>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                    <th>Issue Date</th>

                                    <th>Monthly Compensation</th>
                                    <th>Status</th>
                                    <th width="100" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedRequests as $key => $request)
                                    <tr style="cursor: pointer">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $request->FirstName }} {{ $request->LastName }}</td>
                                        <td>{{ $request->Email }}</td>
                                        <td>{{ $request->Position }}</td>
                                        <td>{{ $request->created_at->format('F d, Y') }}</td>

                                        <td>
                                            {{ $request->MonthlyCompensationText }}
                                            (Php {{ number_format($request->MonthlyCompensationDigits, 2) }})
                                        </td>
                                        <td>
                                            <span class="badge badge-sm badge-dot has-bg bg-success">
                                                Approved
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-center">
                                            <button type="button" class="btn btn-primary btn-sm my-1 text-white view-btn"
                                                data-id="{{ $request->coe_id }}"
                                                data-employee-id="{{ $request->employee_id }}"
                                                data-name="{{ $request->FirstName }} {{ $request->LastName }}"
                                                data-email="{{ $request->Email }}"
                                                data-position="{{ $request->Position }}"
                                                data-date="{{ $request->created_at->format('F d, Y') }}"
                                                data-or-number="{{ 'OR-' . date('Y') . '-' . str_pad($request->coe_id, 5, '0', STR_PAD_LEFT) }}"
                                                data-compensation="{{ $request->MonthlyCompensationText }} (Php {{ number_format($request->MonthlyCompensationDigits, 2) }})">
                                                View
                                            </button>
                                            <button type="button" class="btn btn-info btn-sm my-1 text-white edit-btn"
                                                data-id="{{ $request->coe_id }}"
                                                data-firstname="{{ $request->FirstName }}"
                                                data-lastname="{{ $request->LastName }}"
                                                data-email="{{ $request->Email }}"
                                                data-position="{{ $request->Position }}"
                                                data-date="{{ $request->created_at->format('Y-m-d') }}"
                                                data-compensation-text="{{ $request->MonthlyCompensationText }}"
                                                data-compensation-digits="{{ $request->MonthlyCompensationDigits }}">
                                                Edit
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="modal fade" id="orInputModal" tabindex="-1" aria-labelledby="orInputModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orInputModalLabel">Enter OR Number</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="orInputForm">
                                            <div class="form-group">
                                                <label for="or-number-input" class="form-label">OR Number</label>
                                                <input type="text" class="form-control" id="or-number-input" required
                                                    placeholder="Enter OR Number">
                                                <div class="invalid-feedback">Please enter an OR number.</div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" id="confirmOrNumber">Proceed</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Certificate Request</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="editForm" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="edit-FirstName">First Name</label>
                                                        <input type="text" class="form-control" id="edit-FirstName"
                                                            name="FirstName" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="edit-LastName">Last Name</label>
                                                        <input type="text" class="form-control" id="edit-LastName"
                                                            name="LastName" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label" for="edit-Email">Email</label>
                                                        <input type="email" class="form-control" id="edit-Email"
                                                            name="Email" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="edit-Position">Position</label>
                                                        <input type="text" class="form-control" id="edit-Position"
                                                            name="Position" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="edit-DateStarted">Issue
                                                            Date</label>
                                                        <input type="date" class="form-control" id="edit-DateStarted"
                                                            name="DateStarted" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="edit-MonthlyCompensationText">Monthly Compensation
                                                            (Text)</label>
                                                        <input type="text" class="form-control"
                                                            id="edit-MonthlyCompensationText"
                                                            name="MonthlyCompensationText" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label"
                                                            for="edit-MonthlyCompensationDigits">Monthly Compensation
                                                            (Amount)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">PHP</span>
                                                            <input type="number" step="0.01" class="form-control"
                                                                id="edit-MonthlyCompensationDigits"
                                                                name="MonthlyCompensationDigits" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the Modal -->
    @include('admin.others.modal.certificate')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            const orInputModal = new bootstrap.Modal(document.getElementById('orInputModal'));
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
            let currentRequestData = null;

            // Add click handlers directly to the buttons
            document.querySelectorAll('.view-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    currentRequestData = {
                        name: this.getAttribute('data-name'),
                        position: this.getAttribute('data-position'),
                        startDate: this.getAttribute('data-date'),
                        compensation: this.getAttribute('data-compensation')
                    };
                    orInputModal.show();
                });
            });

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const id = this.getAttribute('data-id');

                    document.getElementById('editForm').action = `/admin/others/${id}/edit`;

                    document.getElementById('edit-FirstName').value = this.getAttribute(
                        'data-firstname');
                    document.getElementById('edit-LastName').value = this.getAttribute(
                        'data-lastname');
                    document.getElementById('edit-Email').value = this.getAttribute('data-email');
                    document.getElementById('edit-Position').value = this.getAttribute(
                        'data-position');
                    document.getElementById('edit-DateStarted').value = this.getAttribute(
                        'data-date');
                    document.getElementById('edit-MonthlyCompensationText').value = this
                        .getAttribute('data-compensation-text');
                    document.getElementById('edit-MonthlyCompensationDigits').value = this
                        .getAttribute('data-compensation-digits');

                    editModal.show();
                });
            });

            // Handle OR number confirmation
            document.getElementById('confirmOrNumber').addEventListener('click', function() {
                const orNumberInput = document.getElementById('or-number-input');

                if (!orNumberInput.value.trim()) {
                    orNumberInput.classList.add('is-invalid');
                    return;
                }

                orInputModal.hide();
                showCertificateModal(currentRequestData, orNumberInput.value.trim());

                orNumberInput.value = '';
                orNumberInput.classList.remove('is-invalid');
            });

            // Function to show certificate modal
            function showCertificateModal(data, orNumber) {
                try {
                    const today = new Date();
                    const currentDate = today.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });

                    const updateElement = (id, text) => {
                        const element = document.getElementById(id);
                        if (element) {
                            element.textContent = text;
                        } else {
                            console.warn(`Element with id '${id}' not found`);
                        }
                    };

                    document.querySelectorAll('#modal-name, #modal-name-2').forEach(el => {
                        if (el) el.textContent = data.name;
                    });

                    updateElement('modal-position', data.position);
                    updateElement('modal-date', data.startDate);
                    updateElement('modal-current-date', currentDate);
                    updateElement('modal-compensation', data.compensation);
                    updateElement('modal-issue-date', currentDate);
                    updateElement('modal-or-number', orNumber);
                    updateElement('modal-or-date', currentDate);
                    updateElement('modal-or-amount', 'PHP 330.00');

                    new bootstrap.Modal(document.getElementById('viewModal')).show();
                } catch (error) {
                    console.error('Error updating modal:', error);
                }
            }

            // Handle form submission
            document.getElementById('editForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const coe_id = this.action.split('/edit')[0].split('/').pop();
                const formData = new FormData(this);
                formData.append('_method', 'PUT');

                fetch(`/admin/others/${coe_id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    .then(async response => {
                        const data = await response.json();
                        console.log('Server response:', data);

                        if (!response.ok) {
                            throw new Error(data.message || 'Server error');
                        }
                        return data;
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Certificate request updated successfully',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Update failed');
                        }
                    })
                    .catch(error => {
                        console.error('Error details:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error.message ||
                                'An error occurred while updating the request'
                        });
                    });

                editModal.hide();
            });

            // Reset OR input when modal is hidden
            document.getElementById('orInputModal').addEventListener('hidden.bs.modal', function() {
                const orNumberInput = document.getElementById('or-number-input');
                orNumberInput.value = '';
                orNumberInput.classList.remove('is-invalid');
            });
        });
    </script>
@endsection
