@extends('theme.layout')

@section('content')
    <h4 class="header">Manage SO Request</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>List of SO requests.</p>
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
                                    <th>Employee ID</th>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Purpose</th>
                                    <th>Issue Date</th>
                                    <th>Status</th>
                                    <th width="100" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($so_requests as $key => $so_request)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $so_request->employee_id }}</td>
                                        <td>{{ $so_request->FirstName }} {{ $so_request->LastName }}</td>
                                        <td>{{ $so_request->Email }}</td>
                                        <td>{{ $so_request->purpose }}</td>
                                        <td>{{ \Carbon\Carbon::parse($so_request->created_at)->format('F d, Y') }}</td>
                                        <td>
                                            <span
                                                class="badge badge-sm badge-dot has-bg
                                                {{ $so_request->status === 'pending' ? 'bg-warning' : ($so_request->status === 'approve' ? 'bg-success' : 'bg-danger') }}">
                                                {{ ucfirst($so_request->status) }}
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-center">
                                            <button type="button" class="btn btn-primary my-3 text-white"
                                                data-bs-toggle="modal"
                                                data-bs-target="#viewSOModal{{ $so_request->soreqid }}">
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
    </div>

    <!-- Service Record Modals -->
    @foreach ($so_requests as $so_request)
        <div class="modal fade" id="viewSOModal{{ $so_request->soreqid }}">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Service Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <!-- Service Record Header -->
                                    <h4 class="text-center">Republic of the Philippines</h4>
                                    <h5 class="text-center">Municipality of Tagoloan</h5>
                                    <h6 class="text-center">Misamis Oriental</h6>
                                    <h3 class="text-center">OFFICE OF THE HUMAN RESOURCE MANAGEMENT</h3>
                                    <h4 class="text-center"><strong>SERVICE RECORD</strong></h4>
                                    <p class="text-center">(To be accomplished by Employer)</p>

                                    <!-- Employee Info -->
                                    @php
                                        // Get employee data from masterlist based on employee_id
                                        $employee = DB::table('masterlist')
                                            ->where('employee_id', $so_request->employee_id)
                                            ->first();
                                    @endphp

                                    <div class="mt-4">
                                        <p><strong>Name:</strong>
                                            @if ($employee)
                                                {{ $employee->last_name }}, {{ $employee->first_name }}
                                                {{ $employee->middle_initial }}
                                            @else
                                                {{ $so_request->employee_id }} (Employee not found)
                                            @endif
                                        </p>
                                        <p><strong>Birth:</strong> {{ $so_request->birthdate }} /
                                            {{ $so_request->birthplace }}</p>
                                    </div>

                                    <p class="mt-3">
                                        This is to certify that the name above has actually rendered services in this office
                                        as shown by the service
                                        record below, each line of which is supported by appointment and other papers
                                        actually issued by this office and approved by
                                        the authorities concerned.
                                    </p>

                                    <!-- Service Record Table -->
                                    <table id="serviceRecordTable{{ $so_request->soreqid }}"
                                        class="table table-bordered text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th colspan="2">Inclusive Dates</th>
                                                <th rowspan="2">Designation</th>
                                                <th rowspan="2">Status</th>
                                                <th rowspan="2">Salary</th>
                                                <th rowspan="2">Station/Place of Assignment</th>
                                                <th rowspan="2">Division</th>
                                                <th colspan="3">Separation</th>
                                            </tr>
                                            <tr>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Date</th>
                                                <th>Cause</th>
                                                <th>Amount Received</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                // Get employment history from tbl_ranking_history
                                                $history = DB::table('tbl_ranking_history')
                                                    ->where('employee_id', $so_request->employee_id)
                                                    ->orderBy('last_promotion_date', 'asc')
                                                    ->get();
                                            @endphp

                                            @foreach ($history as $record)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($record->last_promotion_date)->format('Y-m-d') }}
                                                    </td>
                                                    <td>
                                                        @if (!$loop->last)
                                                            {{ \Carbon\Carbon::parse($history[$loop->index + 1]->last_promotion_date)->subDay()->format('Y-m-d') }}
                                                        @else
                                                            Present
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->current_rank }}</td>
                                                    <td>
                                                        @if ($employee)
                                                            {{ $employee->employment_status }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td contenteditable="true"></td>
                                                    <td>
                                                        Tagoloan Community College
                                                    </td>
                                                    <td>Misamis Oriental</td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                </tr>
                                            @endforeach

                                            <!-- If no history found, show empty editable row -->
                                            @if ($history->isEmpty())
                                                <tr>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td>
                                                        @if ($employee)
                                                            {{ $employee->employment_status }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                    <td contenteditable="true"></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="text-center my-4">
                                        <button class="btn btn-success" onclick="addRow('{{ $so_request->soreqid }}')">Add
                                            New Row</button>
                                    </div>

                                    <p class="mt-4">
                                        Issued in compliance with Executive Order No. 54, dated August 10, 1954 and in
                                        accordance with Circular No. 58,
                                        dated August 10, 1954 of the Government Service Insurance System.
                                    </p>

                                    <div class="mt-4">
                                        <label class="fw-bold">Certified Correct:</label>
                                        <p class="mb-0" contenteditable="true">Enter Certification Name</p>
                                        <p class="mb-0" contenteditable="true">Enter Certification Title</p>
                                    </div>

                                    <div class="text-end mt-3">
                                        <label class="fw-bold">Date:</label>
                                        <span contenteditable="true">{{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <div>
                                        <button class="btn btn-info"
                                            onclick="printRecord('{{ $so_request->soreqid }}')">Print Record</button>
                                        <form method="POST"
                                            action="{{ route('so_request.approve', $so_request->soreqid) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success">Approve Request</button>
                                        </form>
                                        <form method="POST"
                                            action="{{ route('so_request.reject', $so_request->soreqid) }}"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-danger">Reject Request</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- JavaScript for adding a new row and printing -->
    <script>
        function addRow(soreqid) {
            var tbody = document.getElementById("serviceRecordTable" + soreqid).getElementsByTagName('tbody')[0];
            var newRow = tbody.insertRow();

            // The table has 10 columns
            for (var i = 0; i < 10; i++) {
                var newCell = newRow.insertCell(i);
                newCell.contentEditable = "true";
                newCell.innerHTML = ""; // Empty cell
            }
        }

        function printRecord(soreqid) {
            // Create a new window for printing
            var printWindow = window.open('', '_blank');
            var modalContent = document.getElementById('viewSOModal' + soreqid).querySelector('.modal-body').innerHTML;

            // Write the print-friendly content
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Service Record</title>
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <style>
                        @media print {
                            .no-print { display: none; }
                            button { display: none; }
                            [contenteditable="true"] {
                                border: none;
                                outline: none;
                            }
                        }
                        body {
                            padding: 20px;
                            font-family: Arial, sans-serif;
                        }
                    </style>
                </head>
                <body>
                    ${modalContent}
                </body>
                </html>
            `);

            // Trigger print and close
            printWindow.document.close();
            printWindow.focus();

            // Add a small delay to ensure content is fully loaded
            setTimeout(function() {
                printWindow.print();
                // Don't close the window to allow the user to see the print preview
            }, 500);
        }
    </script>
@endsection
