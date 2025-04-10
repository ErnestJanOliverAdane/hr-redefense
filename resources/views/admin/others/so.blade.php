@extends('theme.layout')

@section('content')
<div class="container">
    <!-- Buttons for adding new row and printing -->

    <h4 class="text-center">Republic of the Philippines</h4>
    <h5 class="text-center">Municipality of Tagoloan</h5>
    <h6 class="text-center">Misamis Oriental</h6>
    <h3 class="text-center">OFFICE OF THE HUMAN RESOURCE MANAGEMENT</h3>

    <h4 class="text-center"><strong>SERVICE RECORD</strong></h4>
    <p class="text-center">(To be accomplished by Employer)</p>

    <div class="mt-4">
        <p><strong>Name:</strong> <span contenteditable="true">Enter Name</span></p>
        <p><strong>Birth:</strong> <span contenteditable="true">Enter Birth Details</span></p>
    </div>

    <p class="mt-3">
        This is to certify that the name above has actually rendered services in this office as shown by the service record below, 
        each line of which is supported by appointment and other papers actually issued by this office and approved by the authorities concerned.
    </p>

    <!-- Editable table with an empty tbody -->
    <table id="serviceRecordTable" class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th colspan="2">Inclusive Dates</th>
                <th rowspan="2">Designation</th>
                <th rowspan="2">Status</th>
                <th rowspan="2">Salary</th>
                <th rowspan="2">Station/Place of Assignment</th>
                <th rowspan="2">Division</th>
                <th rowspan="2">Leave of Absence W/O Pay</th>
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
            <!-- Initially empty; new rows can be added -->
        </tbody>
    </table>

    <div class="text-center my-4">
        <button class="btn btn-success" onclick="addRow()">Add New Row</button>
    </div>

    <p class="mt-4">
        Issued in compliance with Executive Order No. 54, dated August 10, 1954 and in accordance with Circular No. 58, dated August 10, 1954 of the Government Service Insurance System.
    </p>

    <div class="mt-4">
        <label class="fw-bold">Certified Correct:</label>
        <p class="mb-0" contenteditable="true">Enter Certification Name</p>
        <p class="mb-0" contenteditable="true">Enter Certification Title</p>
    </div>
    
    <div class="text-end mt-3">
        <label class="fw-bold">Date:</label>
        <span contenteditable="true">Enter Date</span>
    </div>

    <div class="text-center my-4">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
    
</div>

<!-- JavaScript for adding a new row -->
<script>
function addRow() {
    var tbody = document.getElementById("serviceRecordTable").getElementsByTagName('tbody')[0];
    var newRow = tbody.insertRow();
    // The table has 11 columns
    for (var i = 0; i < 11; i++) {
        var newCell = newRow.insertCell(i);
        newCell.contentEditable = "true";
        newCell.innerHTML = ""; // You can add placeholder text if desired
    }
}
</script>
@endsection
