<!-- admin/others/modal/modal.blade.php -->
@foreach ($requests as $key => $request)
    <div class="modal fade" id="viewModal{{ $request->coe_id }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="col-lg-4">Employee Name</td>
                                        <td class="col-lg-8">{{ $request->FirstName }} {{ $request->LastName }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $request->Email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Position</td>
                                        <td>{{ $request->Position }}</td>
                                    </tr>
                                    <tr>
                                        <td>Date Started</td>
                                        <td>{{ $request->DateStarted }}</td>
                                    </tr>
                                    <tr>
                                        <td>Monthly Compensation</td>
                                        <td>
                                            <div class="compensation-display"
                                                id="compensation-display-{{ $request->coe_id }}">
                                                <span>{{ $request->MonthlyCompensationText }}
                                                    (Php
                                                    {{ number_format($request->MonthlyCompensationDigits, 2) }})</span>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary ms-2 edit-compensation-btn"
                                                    data-id="{{ $request->coe_id }}"
                                                    onclick="editCompensation({{ $request->coe_id }})">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </div>
                                            <div class="compensation-edit d-none"
                                                id="compensation-edit-{{ $request->coe_id }}">
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label for="compensation-digits-{{ $request->coe_id }}"
                                                            class="form-label">Amount in Numbers</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">Php</span>
                                                            <input type="number"
                                                                class="form-control compensation-digits"
                                                                id="compensation-digits-{{ $request->coe_id }}"
                                                                value="{{ $request->MonthlyCompensationDigits }}"
                                                                placeholder="Amount"
                                                                onchange="generateAmountInWords({{ $request->coe_id }})">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="compensation-text-{{ $request->coe_id }}"
                                                            class="form-label">Amount in Words</label>
                                                        <input type="text" class="form-control"
                                                            id="compensation-text-{{ $request->coe_id }}"
                                                            value="{{ $request->MonthlyCompensationText }}"
                                                            placeholder="Text (e.g. Twenty Thousand)">
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <button type="button"
                                                            class="btn btn-sm btn-primary save-compensation-btn"
                                                            data-id="{{ $request->coe_id }}"
                                                            onclick="saveCompensation({{ $request->coe_id }})">Save</button>
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary cancel-edit-btn"
                                                            data-id="{{ $request->coe_id }}"
                                                            onclick="cancelEdit({{ $request->coe_id }})">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <span
                                                class="badge badge-sm badge-dot has-bg
                                                {{ $request->status === 'pending'
                                                    ? 'bg-warning'
                                                    : ($request->status === 'approve'
                                                        ? 'bg-success'
                                                        : 'bg-danger') }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Proof of Payment</td>
                                        <td>
                                            @if ($request->proof_payment_path)
                                                @php
                                                    $extension = pathinfo(
                                                        $request->proof_payment_path,
                                                        PATHINFO_EXTENSION,
                                                    );
                                                    $isImage = in_array(strtolower($extension), [
                                                        'jpg',
                                                        'jpeg',
                                                        'png',
                                                        'gif',
                                                    ]);
                                                @endphp

                                                @if ($isImage)
                                                    <img src="{{ asset('storage/' . $request->proof_payment_path) }}"
                                                        class="img-fluid mb-2" style="max-height: 200px;">
                                                @endif

                                                <a href="{{ asset('storage/' . $request->proof_payment_path) }}"
                                                    class="btn btn-sm btn-primary d-block" target="_blank">
                                                    View Full {{ $isImage ? 'Image' : 'Document' }}
                                                </a>
                                            @else
                                                <span class="text-muted">No attachment provided</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="POST" action="{{ route('request.approve', $request->coe_id) }}"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('request.reject', $request->coe_id) }}"
                                class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<script>
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

    // Function to format decimal part of the amount
    function formatCents(cents) {
        if (cents === 0) return '';
        if (cents < 10) cents = '0' + cents;
        return ' and ' + cents + '/100';
    }

    // Function to generate amount in words from the entered digits
    function generateAmountInWords(id) {
        const amountInput = document.getElementById(`compensation-digits-${id}`);
        const textInput = document.getElementById(`compensation-text-${id}`);

        if (amountInput.value) {
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
        } else {
            // Clear the text field if amount is empty
            textInput.value = '';
        }
    }

    // Direct function declarations for the edit/cancel/save operations
    function editCompensation(id) {
        $(`#compensation-display-${id}`).addClass('d-none');
        $(`#compensation-edit-${id}`).removeClass('d-none');
    }

    function cancelEdit(id) {
        $(`#compensation-edit-${id}`).addClass('d-none');
        $(`#compensation-display-${id}`).removeClass('d-none');
    }

    function saveCompensation(id) {
        const textValue = $(`#compensation-text-${id}`).val();
        const digitsValue = $(`#compensation-digits-${id}`).val();

        if (!textValue || !digitsValue) {
            alert('Both text and amount values are required.');
            return;
        }

        // Format the digits with two decimal places
        const formattedDigits = parseFloat(digitsValue).toFixed(2);

        // Show loading state
        $(`.save-compensation-btn[data-id="${id}"]`).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
        $(`.save-compensation-btn[data-id="${id}"]`).prop('disabled', true);

        // Send AJAX request to update the compensation
        $.ajax({
            url: `/others/request/${id}`,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                MonthlyCompensationText: textValue,
                MonthlyCompensationDigits: digitsValue
            },
            success: function(response) {
                if (response.success) {
                    // Update the display text
                    const displayText = textValue + ' (Php ' + new Intl.NumberFormat('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(digitsValue) + ')';
                    $(`#compensation-display-${id} span`).text(displayText);

                    // Switch back to display mode
                    $(`#compensation-edit-${id}`).addClass('d-none');
                    $(`#compensation-display-${id}`).removeClass('d-none');

                    // Show success notification
                    alert('Monthly compensation updated successfully');
                } else {
                    alert(response.message || 'An error occurred while updating');
                }
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                alert(errorMsg);
            },
            complete: function() {
                // Reset button state
                $(`.save-compensation-btn[data-id="${id}"]`).html('Save');
                $(`.save-compensation-btn[data-id="${id}"]`).prop('disabled', false);
            }
        });
    }

    $(document).ready(function() {
        // Initialize amount in words for existing values when editing
        $('.compensation-digits').each(function() {
            const id = $(this).attr('id').replace('compensation-digits-', '');
            if ($(this).val()) {
                generateAmountInWords(id);
            }
        });

        // For redundancy, still keep these event handlers
        // Edit compensation button click
        $('.edit-compensation-btn').click(function() {
            const id = $(this).data('id');
            editCompensation(id);
        });

        // Cancel edit button click
        $('.cancel-edit-btn').click(function() {
            const id = $(this).data('id');
            cancelEdit(id);
        });

        // Save compensation button click
        $('.save-compensation-btn').click(function() {
            const id = $(this).data('id');
            saveCompensation(id);
        });
    });
</script>
