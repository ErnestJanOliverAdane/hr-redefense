<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Certificate of Employment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <style>
                    .certificate-container {
                        font-family: Arial, sans-serif;
                    }

                    .certificate-content {
                        width: 100%;
                        background-image: url('/assets/images/lgu.png');
                        background-size: cover;
                        background-position: center;
                        padding: 20px;
                        position: relative;
                        border: 5px solid #A27AC3;
                    }

                    .header {
                        text-align: center;
                        padding-bottom: 10px;
                        margin-bottom: 20px;
                    }

                    .header h1 {
                        margin: 0;
                        font-size: 24px;
                        color: #4A1B81;
                    }

                    .header p {
                        margin: 5px 0;
                        font-size: 14px;
                    }

                    .title {
                        text-align: center;
                        font-size: 22px;
                        font-weight: bold;
                        text-decoration: underline;
                        margin-bottom: 20px;
                        color: #4A1B81;
                    }

                    .content {
                        font-size: 16px;
                        line-height: 1.6;

                        padding: 20px;
                        border-radius: 10px;
                    }

                    .content p {
                        margin: 10px 0;
                    }

                    .content .highlight {
                        text-decoration: underline;
                    }

                    .signature {
                        margin-top: 50px;
                        text-align: right;
                    }

                    .signature p {
                        margin: 5px 0;
                    }

                    .signature span {
                        font-weight: bold;
                    }

                    .footer {
                        margin-top: 30px;
                        font-size: 12px;
                        color: #555;
                    }

                    .footer .left {
                        float: left;
                    }

                    .footer .right {
                        float: right;
                    }

                    .clearfix {
                        clear: both;
                    }

                    /* Print-specific styles */
                    @media print {
                        @page {
                            size: A4 portrait;
                            margin: 0;
                        }

                        body * {
                            visibility: hidden;
                        }

                        .modal-body,
                        .modal-body * {
                            visibility: visible;
                        }

                        .modal-body {
                            position: absolute;
                            left: 0;
                            top: 0;
                            width: 100%;
                            height: 100%;
                            margin: 0;
                            padding: 0;
                        }

                        .certificate-content {
                            transform-origin: top left;
                            transform: scale(1);
                            width: 8.5in;
                            /* Legal width */
                            height: 14in;
                            /* Legal height */
                            margin: 0;
                            padding: 0;
                            border: none;
                            position: fixed;
                            top: 0;
                            left: 0;
                        }

                        .modal-footer,
                        .modal-header {
                            display: none;
                        }

                        .header-banner,
                        .content,
                        .signature,
                        .footer {
                            position: relative;
                            margin: 0;
                            padding: 0.5in;
                        }

                        /* Ensure background colors print */
                        * {
                            -webkit-print-color-adjust: exact !important;
                            print-color-adjust: exact !important;
                        }
                    }

                    /* Content styling */
                    .header-banner {
                        background: #4A1B81;
                        height: 100px;
                        width: 100%;
                        padding: 20px;
                        box-sizing: border-box;
                    }

                    .content {
                        padding: 40px;
                        line-height: 1.6;
                    }

                    .title {
                        text-align: center;
                        font-size: 24px;
                        color: #4A1B81;
                        margin: 30px 0;
                        text-transform: uppercase;
                        font-weight: bold;
                    }

                    .signature {
                        text-align: right;
                        margin-top: 80px;
                        padding-right: 40px;
                    }

                    .footer {
                        position: absolute;
                        bottom: 30px;
                        width: 100%;
                        padding: 0 40px;
                    }
                </style>

                <div class="certificate-container">
                    <div class="certificate-content">
                        <div class="header">
                            <h1>Republic of the Philippines</h1>
                            <p>Province of Misamis Oriental</p>
                            <p>Municipality of Tagoloan</p>
                            <p><strong>Office of the Human Resource Management</strong></p>
                        </div>

                        <div class="title">
                            <br>
                            CERTIFICATE OF EMPLOYMENT
                        </div>

                        <div class="content">
                            <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                            <!-- In the modal content section -->
                            <p>This is to certify that Mr. / Ms. <span class="highlight" id="modal-name">[Full
                                    Name]</span>, is a Full-Time Instructor in
                                Tagoloan Community College under Local Government Unit of Tagoloan, Misamis Oriental,
                                with the position
                                as <span class="highlight" id="modal-position">[Position]</span>, he/she has been with
                                the organization since <span class="highlight" id="modal-date">[Date Started]</span> up
                                to <span class="highlight" id="modal-current-date">[End Date]</span> with a
                                monthly compensation of <span class="highlight" id="modal-compensation">(Php.
                                    [Amount])</span>.</p>

                            <p>This certification is being issued upon the request of Mr. / Ms. <span class="highlight"
                                    id="modal-name-2">[Full Name]</span> for whatever legal purpose it may serve him/her
                                best.</p>

                            <p>Given this <span id="modal-issue-date">________</span> in the Municipality of Tagoloan,
                                Province of Misamis Oriental, Philippines.</p>
                        </div>

                        <div class="signature">
                            <p><span>ELIZABETH P. OBAOB</span></p>
                            <p>MGDH I (HRMO)</p>
                        </div>

                        <div class="footer">
                            <div class="left">
                                <p>This document is paid under:</p>
                                <p>O.R. #: <span id="modal-or-number"></span></p>
                                <p>Date: <span id="modal-or-date"></span></p>
                                <p>Amount: <span id="modal-or-amount"></span></p>
                            </div>

                            <div class="right">
                                <p>Tel No. (088) 890-4324</p>
                                <p>Email: hrmo.lgutigoloan@gmail.com</p>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info text-white edit-modal-btn">Edit</button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">Print Certificate</button>
                </div>
            </div>
        </div>
    </div>
</div>
