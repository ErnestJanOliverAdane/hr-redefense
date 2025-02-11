@extends('theme.layout')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Certificate of Employment</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
            }

            .container {
                width: 800px;
                height: 1120px;
                background-image: url('/assets/images/lgu.png');
                /* Ensure path is correct */
                background-size: cover;
                background-position: center;
                padding: 20px;
                margin: 50px auto;
                position: relative;
                border: 5px solid #A27AC3;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
                color: #010101;
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

            .print-button {
                display: block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #4A1B81;
                color: white;
                font-size: 16px;
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }

            .print-button:hover {
                background-color: #3b1469;
            }

            /* Print-specific styles */
            @media print {
                @page {
                    size: Legal;
                    margin: 0;
                }

                body {
                    margin: 0;
                    padding: 0;
                    -webkit-print-color-adjust: exact;
                    /* Ensure colors and backgrounds are printed */
                    print-color-adjust: exact;
                }

                .container {
                    width: 100%;
                    height: auto;
                    background-image: url('/assets/images/lgu.png');
                    /* Ensure path is correct */
                    background-size: cover;
                    background-position: center;
                    padding: 20px;
                    border: 5px solid #A27AC3;
                    box-shadow: none;
                    -webkit-print-color-adjust: exact;
                    /* Ensure background image appears in print */
                    print-color-adjust: exact;
                }

                body * {
                    visibility: hidden;
                }

                .container,
                .container * {
                    visibility: visible;
                }

                .print-button {
                    display: none;
                }
            }
        </style>

        <script>
            function printDocument() {
                window.print();
            }
        </script>
    </head>

    <body>

        <div class="container">
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
                <p>This is to certify that Mr. / Ms. <span class="highlight">[Full Name]</span>, is a Full-Time Instructor in
                    Tagoloan Community College under Local Government Unit of Tagoloan, Misamis Oriental, with the position
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
        </div>

        <button class="print-button" onclick="printDocument()">Print Certificate</button>

    </body>

    </html>
@endsection
