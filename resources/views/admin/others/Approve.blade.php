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
                                    <tr>
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
                                                data-firstname="{{ $request->FirstName }}"
                                                data-lastname="{{ $request->LastName }}"
                                                data-or-number="{{ $request->or_number }}"
                                                data-compensation="{{ $request->MonthlyCompensationText }} (Php {{ number_format($request->MonthlyCompensationDigits, 2) }})"
                                                data-compensation-text="{{ $request->MonthlyCompensationText }}"
                                                data-compensation-digits="{{ $request->MonthlyCompensationDigits }}"
                                                onclick="showCertificateModal(this)">
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

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
                                                <!-- Fixed: Removed duplicate Monthly Compensation fields -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="edit-MonthlyCompensationText">Monthly
                                                            Compensation (Text)</label>
                                                        <input type="text" class="form-control"
                                                            id="edit-MonthlyCompensationText" name="MonthlyCompensationText"
                                                            required readonly>
                                                        <small class="form-text text-muted">Auto-generated from the
                                                            amount</small>
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
                                                                name="MonthlyCompensationDigits" required
                                                                placeholder="Enter amount">
                                                        </div>
                                                        <small class="form-text text-muted">The text will be generated
                                                            automatically</small>
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
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));

            // Add event listener for the edit button in the certificate modal
            document.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('edit-modal-btn')) {
                    e.preventDefault();

                    // Close the view modal first
                    const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewModal'));
                    if (viewModal) {
                        viewModal.hide();
                    }

                    // Show the edit modal
                    showEditModal(e.target);
                }
            });

            // Add click handlers for edit buttons
            function showEditModal(buttonElement) {
                const id = buttonElement.getAttribute('data-id');

                document.getElementById('editForm').action = `/admin/others/${id}/edit`;

                document.getElementById('edit-FirstName').value = buttonElement.getAttribute(
                    'data-firstname');
                document.getElementById('edit-LastName').value = buttonElement.getAttribute(
                    'data-lastname');
                document.getElementById('edit-Email').value = buttonElement.getAttribute('data-email');
                document.getElementById('edit-Position').value = buttonElement.getAttribute(
                    'data-position');
                document.getElementById('edit-DateStarted').value = buttonElement.getAttribute(
                    'data-date');
                document.getElementById('edit-MonthlyCompensationText').value = buttonElement
                    .getAttribute('data-compensation-text');
                document.getElementById('edit-MonthlyCompensationDigits').value = buttonElement
                    .getAttribute('data-compensation-digits');

                editModal.show();
            }

            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    showEditModal(this);
                });
            });

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
        });

        // Global function to show certificate modal (accessible via onclick)
        function showCertificateModal(btnElement) {
            try {
                const data = {
                    id: btnElement.getAttribute('data-id'),
                    name: btnElement.getAttribute('data-name'),
                    position: btnElement.getAttribute('data-position'),
                    startDate: btnElement.getAttribute('data-date'),
                    compensation: btnElement.getAttribute('data-compensation'),
                    orNumber: btnElement.getAttribute('data-or-number'),
                    compensationText: btnElement.getAttribute('data-compensation-text'),
                    compensationDigits: btnElement.getAttribute('data-compensation-digits'),
                    email: btnElement.getAttribute('data-email'),
                    firstname: btnElement.getAttribute('data-firstname'),
                    lastname: btnElement.getAttribute('data-lastname')
                };

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
                updateElement('modal-or-number', data.orNumber);
                updateElement('modal-or-date', currentDate);
                updateElement('modal-or-amount', 'PHP 330.00');

                // Store the employee data for Edit button in modal
                const viewModal = document.getElementById('viewModal');
                const editBtn = viewModal.querySelector('.edit-modal-btn');

                if (editBtn) {
                    // Set data attributes on the edit button
                    editBtn.setAttribute('data-id', data.id);
                    editBtn.setAttribute('data-firstname', data.firstname);
                    editBtn.setAttribute('data-lastname', data.lastname);
                    editBtn.setAttribute('data-email', data.email);
                    editBtn.setAttribute('data-position', data.position);
                    editBtn.setAttribute('data-date', data.startDate.replace(/^([A-Za-z]+ \d+, )/, ''));
                    editBtn.setAttribute('data-compensation-text', data.compensationText || '');
                    editBtn.setAttribute('data-compensation-digits', data.compensationDigits || '');
                }

                // Show the modal
                const viewModalElement = new bootstrap.Modal(document.getElementById('viewModal'));
                viewModalElement.show();
            } catch (error) {
                console.error('Error updating modal:', error);
                alert('An error occurred while trying to view the certificate details');
            }
        }

        // Function to convert number to words
        function numberToWords(num) {
            // Handle edge cases
            if (num === undefined || num === null || isNaN(num)) return 'Zero';

            // Handle zero case
            if (num === 0) return 'Zero';

            // Arrays for number words
            const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine',
                'Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen',
                'Seventeen', 'Eighteen', 'Nineteen'
            ];
            const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

            // Convert numbers less than 1000
            function convertLessThanOneThousand(num) {
                if (num === 0) return '';

                let result = '';

                // Handle hundreds
                if (num >= 100) {
                    result = ones[Math.floor(num / 100)] + ' Hundred';
                    if (num % 100 !== 0) {
                        result += ' ';
                    }
                    num %= 100;
                }

                // Handle tens and ones
                if (num >= 20) {
                    result += tens[Math.floor(num / 10)];
                    if (num % 10 !== 0) {
                        result += ' ' + ones[num % 10];
                    }
                } else if (num > 0) {
                    result += ones[num];
                }

                return result;
            }

            // Handle negative numbers
            if (num < 0) {
                return 'Negative ' + numberToWords(Math.abs(num));
            }

            let result = '';

            // Handle billions
            if (num >= 1000000000) {
                result += convertLessThanOneThousand(Math.floor(num / 1000000000)) + ' Billion';
                if (num % 1000000000 !== 0) {
                    result += ' ';
                }
                num %= 1000000000;
            }

            // Handle millions
            if (num >= 1000000) {
                result += convertLessThanOneThousand(Math.floor(num / 1000000)) + ' Million';
                if (num % 1000000 !== 0) {
                    result += ' ';
                }
                num %= 1000000;
            }

            // Handle thousands
            if (num >= 1000) {
                result += convertLessThanOneThousand(Math.floor(num / 1000)) + ' Thousand';
                if (num % 1000 !== 0) {
                    result += ' ';
                }
                num %= 1000;
            }

            // Handle remaining part
            if (num > 0) {
                result += convertLessThanOneThousand(num);
            }

            return result;
        }

        // Format cents part
        function formatCents(cents) {
            if (cents === 0) return '';
            if (cents < 10) cents = '0' + cents;
            return ' and ' + cents + '/100';
        }

        // Function to generate amount in words from digits
        function generateAmountInWords() {
            const amountInput = document.getElementById('edit-MonthlyCompensationDigits');
            const textInput = document.getElementById('edit-MonthlyCompensationText');

            if (amountInput && textInput && amountInput.value) {
                const amount = parseFloat(amountInput.value);

                if (isNaN(amount)) {
                    textInput.value = '';
                    return;
                }

                const wholePart = Math.floor(amount);
                const centsPart = Math.round((amount - wholePart) * 100);

                let amountInWords = numberToWords(wholePart);

                // Verify we got a valid word representation
                if (!amountInWords || amountInWords.trim() === '') {
                    amountInWords = 'Zero';
                }

                if (centsPart > 0) {
                    amountInWords += formatCents(centsPart);
                }

                amountInWords += ' Pesos Only';
                textInput.value = amountInWords;
            }
        }

        // Add event listener to the digits input in the edit modal
        document.addEventListener('DOMContentLoaded', function() {
            const digitsInput = document.getElementById('edit-MonthlyCompensationDigits');
            if (digitsInput) {
                digitsInput.addEventListener('input', generateAmountInWords);
                digitsInput.addEventListener('change', generateAmountInWords);

                // Also trigger when the modal is opened
                const editModal = document.getElementById('editModal');
                if (editModal) {
                    editModal.addEventListener('shown.bs.modal', function() {
                        // Generate words if there's already a value
                        if (digitsInput.value) {
                            generateAmountInWords();
                        }
                    });
                }
            }
        });
    </script>
@endsection
