<!-- Certificate of Employment Modal with Enhanced PDF functionality -->
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
                        max-width: 100%;
                    }

                    .certificate-content {
                        width: 100%;
                        height: 100%;
                        background-image: url('/assets/images/lgu.png');
                        background-size: 100% 100%;
                        background-repeat: no-repeat;
                        background-position: center;
                        padding: 0;
                        position: relative;
                        border: none;
                        /* A4 aspect ratio (210mm x 297mm) */
                        aspect-ratio: 0.7071;
                    }

                    .header {
                        text-align: center;
                        padding-top: 20px;
                        padding-bottom: 10px;
                        margin-bottom: 15px;
                    }

                    .header h1 {
                        margin: 0;
                        font-size: 22px;
                        color: #4A1B81;
                        margin-top: 5px;
                    }

                    .header p {
                        margin: 5px 0;
                        font-size: 14px;
                        color: #4A1B81;
                    }

                    .title {
                        text-align: center;
                        font-size: 20px;
                        font-weight: bold;
                        text-decoration: underline;
                        margin-bottom: 20px;
                        color: #4A1B81;
                        margin-top: 30px;
                    }

                    .content {
                        font-size: 14px;
                        line-height: 1.6;
                        padding: 10px 60px;
                        margin-top: 20px;
                    }

                    .content p {
                        margin: 10px 0;
                    }

                    .content .highlight {
                        text-decoration: underline;
                    }

                    .signature {
                        margin-top: 60px;
                        text-align: right;
                        padding-right: 80px;
                    }

                    .signature p {
                        margin: 3px 0;
                        font-size: 14px;
                    }

                    .signature span {
                        font-weight: bold;
                    }

                    .footer {
                        position: absolute;
                        bottom: 120px;
                        width: 100%;
                        padding: 0 60px;
                        font-size: 11px;
                        color: #333;
                    }

                    .footer .left {
                        float: left;
                    }

                    .footer .right {
                        float: right;
                        margin-right: 60px;
                    }

                    .clearfix {
                        clear: both;
                    }

                    /* Fit content to match LGU background design */
                    .inner-container {
                        padding: 0 20px;
                        height: 100%;
                        box-sizing: border-box;
                        display: flex;
                        flex-direction: column;
                    }

                    /* Additional spacing to match background */
                    .content-wrapper {
                        flex: 1;
                        padding: 20px 0;
                    }

                    /* Media query for print to ensure proper ratio */
                    @media print {
                        .certificate-content {
                            height: 11.69in;
                            /* A4 height */
                            width: 8.27in;
                            /* A4 width */
                        }
                    }
                </style>

                <div class="certificate-container" id="certificate-container">
                    <div class="certificate-content">
                        <div class="inner-container">
                            <div class="header">
                                <h1>Republic of the Philippines</h1>
                                <p>Province of Misamis Oriental</p>
                                <p>Municipality of Tagoloan</p>
                                <p style="color: #4A1B81; font-weight: bold; margin-top: 8px; font-size: 15px;">Office
                                    of the Human Resource Management</p>
                            </div>

                            <div class="title">
                                CERTIFICATE OF EMPLOYMENT
                            </div>

                            <div class="content-wrapper">
                                <div class="content">
                                    <p><strong>TO WHOM IT MAY CONCERN:</strong></p>
                                    <p>This is to certify that Mr. / Ms. <span class="highlight" id="modal-name">[Full
                                            Name]</span>, is a Full-Time Instructor in
                                        Tagoloan Community College under Local Government Unit of Tagoloan, Misamis
                                        Oriental,
                                        with the position
                                        as <span class="highlight" id="modal-position">[Position]</span>, he/she has
                                        been with
                                        the organization since <span class="highlight" id="modal-date">[Date
                                            Started]</span> up
                                        to <span class="highlight" id="modal-current-date">[End Date]</span> with a
                                        monthly compensation of <span class="highlight" id="modal-compensation">Two
                                            Thousand Pesos Only (Php. 2,000.00)</span>.</p>

                                    <p>This certification is being issued upon the request of Mr. / Ms. <span
                                            class="highlight" id="modal-name-2">[Full Name]</span> for whatever legal
                                        purpose it may serve him/her
                                        best.</p>

                                    <p>Given this <span id="modal-issue-date">________</span> in the Municipality of
                                        Tagoloan,
                                        Province of Misamis Oriental, Philippines.</p>
                                </div>

                                <div class="signature">
                                    <p><span>ELIZABETH P. OBAOB</span></p>
                                    <p>MGDH I (HRMO)</p>
                                </div>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info text-white edit-modal-btn" data-id="" data-firstname=""
                    data-lastname="" data-email="" data-position="" data-date="" data-compensation-text=""
                    data-compensation-digits="">Edit</button>
                <button type="button" class="btn btn-primary" id="generatePDF">Generate PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Include html2pdf.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- JavaScript for PDF generation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set today's date in the correct format for the certificate
        function formatDate(date) {
            const day = date.getDate();
            const monthNames = [
                "January", "February", "March", "April", "May", "June",
                "July", "August", "September", "October", "November", "December"
            ];
            const month = monthNames[date.getMonth()];
            const year = date.getFullYear();

            // Function to add ordinal suffix to day number (1st, 2nd, 3rd, etc.)
            function getOrdinalSuffix(day) {
                if (day > 3 && day < 21) return 'th';
                switch (day % 10) {
                    case 1:
                        return 'st';
                    case 2:
                        return 'nd';
                    case 3:
                        return 'rd';
                    default:
                        return 'th';
                }
            }

            return `${day}${getOrdinalSuffix(day)} day of ${month}, ${year}`;
        }

        // Format a full name for filename: removing special characters and spaces
        function formatNameForFilename(name) {
            // Remove brackets and trim
            let formattedName = name.replace(/[\[\]]/g, '').trim();

            // If name is a placeholder, return empty string
            if (formattedName === 'Full Name') return '';

            // Replace multiple spaces with single underscore
            formattedName = formattedName.replace(/\s+/g, '_');

            // Remove any special characters
            formattedName = formattedName.replace(/[^\w\s]/gi, '');

            return formattedName;
        }

        // Set the issue date when the modal is shown
        $('#viewModal').on('show.bs.modal', function() {
            const today = new Date();
            document.getElementById('modal-issue-date').textContent = formatDate(today);

            // Set current date for end date if it's blank
            if (!document.getElementById('modal-current-date').textContent ||
                document.getElementById('modal-current-date').textContent === '[End Date]') {
                const formattedDate = today.toLocaleDateString('en-US', {
                    month: 'long',
                    day: 'numeric',
                    year: 'numeric'
                });
                document.getElementById('modal-current-date').textContent = formattedDate;
            }

            // Ensure name-2 is populated from name if it's empty
            const name1 = document.getElementById('modal-name').textContent;
            const name2 = document.getElementById('modal-name-2').textContent;

            if (name2 === '[Full Name]' && name1 !== '[Full Name]') {
                document.getElementById('modal-name-2').textContent = name1;
            }
        });

        // PDF generation functionality
        document.getElementById('generatePDF').addEventListener('click', function() {
            // Get the certificate container
            const element = document.getElementById('certificate-container');

            // Get employee name for filename
            const employeeName = document.getElementById('modal-name').textContent;
            const formattedName = formatNameForFilename(employeeName);
            const filename = formattedName ?
                `Certificate_of_Employment_${formattedName}.pdf` :
                'Certificate_of_Employment.pdf';

            // Configuration for PDF generation
            const opt = {
                margin: 0,
                filename: filename,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    logging: true,
                    letterRendering: true,
                    imageTimeout: 0
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4', // A4 size
                    orientation: 'portrait'
                }
            };

            // Show loading indicator
            const loadingText = document.createElement('div');
            loadingText.textContent = 'Generating PDF...';
            loadingText.style.cssText =
                'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0,0,0,0.7); color: white; padding: 20px; border-radius: 5px; z-index: 9999;';
            document.body.appendChild(loadingText);

            // Generate PDF
            html2pdf()
                .set(opt)
                .from(element)
                .toPdf()
                .get('pdf')
                .then((pdf) => {
                    pdf.save();
                    // Remove loading indicator when done
                    document.body.removeChild(loadingText);

                    // Show success message with filename
                    const successMessage = document.createElement('div');
                    successMessage.textContent = `PDF successfully generated as "${filename}"!`;
                    successMessage.style.cssText =
                        'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(46,125,50,0.9); color: white; padding: 20px; border-radius: 5px; z-index: 9999;';
                    document.body.appendChild(successMessage);

                    // Remove success message after 3 seconds
                    setTimeout(() => {
                        document.body.removeChild(successMessage);
                    }, 3000);
                })
                .catch(err => {
                    // Remove loading indicator if error
                    document.body.removeChild(loadingText);

                    // Show error message
                    console.error('Error generating PDF:', err);
                    const errorMessage = document.createElement('div');
                    errorMessage.textContent = 'Error generating PDF. Please try again.';
                    errorMessage.style.cssText =
                        'position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(198,40,40,0.9); color: white; padding: 20px; border-radius: 5px; z-index: 9999;';
                    document.body.appendChild(errorMessage);

                    // Remove error message after 3 seconds
                    setTimeout(() => {
                        document.body.removeChild(errorMessage);
                    }, 3000);
                });
        });
    });
</script>
