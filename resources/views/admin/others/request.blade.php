@extends('theme.layout')

@section('content')
    <h4 class="header">Manage Request Certificate of Employment</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p>List of request.</p>
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
                                @foreach ($requests as $key => $request)
                                    <tr style="cursor: pointer">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $request->FirstName }} {{ $request->LastName }}</td>
                                        <td>{{ $request->Email }}</td>
                                        <td>{{ $request->Position }}</td>
                                        <td>{{ $request->DateStarted }}</td>
                                        <td>
                                            {{ $request->MonthlyCompensationText }}
                                            (Php {{ number_format($request->MonthlyCompensationDigits, 2) }})
                                        </td>
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
                                        <td class="nk-tb-col text-center">
                                            <button type="button" class="btn btn-primary my-3 text-white"
                                                data-bs-toggle="modal" data-bs-target="#viewModal{{ $request->coe_id }}">
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
    @include('admin.others.modal.modal')
    <script>
        $(document).ready(function() {
            $('.view-btn').click(function() {
                $('#view_name').text($(this).data('name'));
                $('#view_email').text($(this).data('email'));
                $('#view_position').text($(this).data('position'));
                $('#view_date').text($(this).data('date'));
                $('#view_compensation').text($(this).data('compensation'));
                $('#view_status').text($(this).data('status'));
                $('#view_proof').attr('href', $(this).data('proof'));
                $('#viewModal').modal('show');
            });
        });
    </script>

    {{--
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Certificate of Employment Modal</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
            }

            .container {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                background-color: #f0f0f0;
            }

            .modal-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .modal {
                position: relative;
                background-color: #fff;
                width: 800px;
                max-width: 90%;
                height: 1120px;
                padding: 20px;
                border: 5px solid #A27AC3;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                background-image: url('/assets/images/lgu.png');
                background-size: cover;
                background-position: center;
                overflow-y: auto;
                display: none;
                z-index: 1000;
            }

            .modal .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .modal .header h1 {
                font-size: 24px;
                color: #4A1B81;
                margin: 0;
            }

            .modal .title {
                text-align: center;
                font-size: 22px;
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: 20px;
                color: #4A1B81;
            }

            .modal .content {
                font-size: 16px;
                line-height: 1.6;
                background-color: rgba(255, 255, 255, 0.8);
                padding: 20px;
                border-radius: 10px;
            }

            .modal .signature {
                text-align: right;
                margin-top: 50px;
            }

            .modal .footer {
                margin-top: 30px;
                font-size: 12px;
                color: #555;
            }

            .modal .footer .left {
                float: left;
            }

            .modal .footer .right {
                float: right;
            }

            .modal .clearfix {
                clear: both;
            }

            .print-button,
            .open-modal-button,
            .close-modal-button {
                display: inline-block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #4A1B81;
                color: white;
                font-size: 16px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
                text-align: center;
            }

            .print-button:hover,
            .open-modal-button:hover,
            .close-modal-button:hover {
                background-color: #3b1469;
            }

            .close-modal-button {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 24px;
                background: transparent;
                color: #4A1B81;
                cursor: pointer;
                border: none;
            }

            /* Print-specific styles */
            @media print {
                body * {
                    visibility: hidden;
                }

                .modal,
                .modal * {
                    visibility: visible !important;
                }

                .modal {
                    display: block !important;
                    visibility: visible !important;
                    position: absolute !important;
                    top: 0 !important;
                    left: 0 !important;
                    width: 100% !important;
                    background-image: url('/assets/images/lgu.png') !important;
                    background-size: cover !important;
                    background-position: center !important;
                    padding: 0 !important;
                    box-shadow: none !important;
                    border: none !important;
                }

                .print-button,
                .close-modal-button {
                    display: none !important;
                }
            }
        </style>
        <script>
            function openModal() {
                document.querySelector(".modal-overlay").style.display = "block";
                document.querySelector(".modal").style.display = "block";
            }

            function closeModal() {
                document.querySelector(".modal-overlay").style.display = "none";
                document.querySelector(".modal").style.display = "none";
            }

            function printDocument() {
                window.print();
            }

            function openModal(fullName, position, dateStarted, monthlyCompensationText, monthlyCompensationDigits) {

                document.querySelector('.modal .highlight:nth-of-type(1)').textContent = fullName;
                document.querySelector('.modal .highlight:nth-of-type(2)').textContent = position;
                document.querySelector('.modal .highlight:nth-of-type(3)').textContent = dateStarted;
                document.querySelector('.modal .highlight:nth-of-type(4)').textContent =
                    monthlyCompensationText;
                document.querySelector('.modal .highlight:nth-of-type(5)').textContent =
                    `Php ${Number(monthlyCompensationDigits).toFixed(2)}`;


                document.querySelector(".modal-overlay").style.display = "block";
                document.querySelector(".modal").style.display = "block";
            }

            function closeModal() {

                document.querySelector(".modal-overlay").style.display = "none";
                document.querySelector(".modal").style.display = "none";
            }

            function printDocument() {

                window.print();
            }
        </script>
    </head>

    <body>


        <div class="container">
            <div class="modal-overlay" onclick="closeModal()"></div>

            <div class="modal">
                <button class="close-modal-button" onclick="closeModal()">&times;</button>
                <div class="header">
                    <h1>Republic of the Philippines</h1>
                    <p>Province of Misamis Oriental</p>
                    <p>Municipality of Tagoloan</p>
                    <p><strong>Office of the Human Resource Management</strong></p>
                </div>

                <div class="title">
                    CERTIFICATE OF EMPLOYMENT
                </div>

                <div class="content">
                    <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                    <p>This is to certify that Mr. / Ms. <span class="highlight">[Full Name]</span>, is a Full-Time
                        Instructor in
                        Tagoloan Community College under Local Government Unit of Tagoloan, Misamis Oriental, with the
                        position
                        as <span class="highlight">[Position]</span>, he/she has been with the organization since <span
                            class="highlight">[Date Started]</span> up to <span class="highlight">[End Date]</span> with a
                        monthly compensation of <span class="highlight">(Php. [Amount])</span>.</p>

                    <p>This certification is being issued upon the request of Mr. / Ms. <span class="highlight">[Full
                            Name]</span> for whatever legal purpose it may serve him/her best.</p>

                    <p>Given this ________ day of ________ in the Municipality of Tagoloan, Province of Misamis Oriental,
                        Philippines.</p>
                </div>

                <div class="signature">
                    <p><span>ELIZABETH P. OBAOB</span></p>
                    <p>MGDH I (HRMO)</p>
                </div>

                <div class="footer">
                    <div class="left">
                        <p>This document is paid under:</p>
                        <p>O.R. #: ________</p>
                        <p>Date: ________</p>
                        <p>Amount: ________</p>
                    </div>

                    <div class="right">
                        <p>Tel No. (088) 890-4324</p>
                        <p>Email: hrmo.lgutigoloan@gmail.com</p>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <button class="print-button" onclick="printDocument()">Print Certificate</button>
            </div>
        </div>
    </body>

    </html> --}}
@endsection
