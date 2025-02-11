@extends('theme.layout')
@section('content')
    <h4 class="header">LIST OF JOB ORDER</h4>
    <div class="nk-block-head-content">
        <div class="nk-block-des text-soft">
            <p> JOB ORDER</p>
        </div>
    </div>

    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-inner">
                        <table id="jobOrderTable" class="datatable-init-export nowrap table" data-export-title="Export">
                            <thead>
                                <tr>
                                    <th width="20">#</th>
                                    <th>Employee's ID</th>
                                    <th>Employee Name</th>
                                    <th>Email Address</th>
                                    <th>Job Title</th>
                                    <th>Department/Designation</th>
                                    <th>Employment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($masterlists as $key => $masterlist)
                                    <tr style="cursor: pointer" data-role="{{ $masterlist->role }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $masterlist->employee_id }}</td>
                                        <td>{{ $masterlist->full_name }}</td>
                                        <td>{{ $masterlist->contact_information }}</td>
                                        <td>{{ $masterlist->job_title }}</td>
                                        <td>{{ $masterlist->department }}</td>
                                        <td>{{ $masterlist->employment_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary" onclick="printTable()"><em class="icon ni ni-printer-fill"></em>Print Table</button>
    </div>

    <script>
        function printTable() {
            const tableContent = document.getElementById('jobOrderTable').outerHTML;
            const newWindow = window.open('', '', 'width=800,height=600');
            newWindow.document.write('<html><head><title>Print Table</title>');
            newWindow.document.write('<style>table { width: 100%; border-collapse: collapse; } table, th, td { border: 1px solid black; } th, td { padding: 8px; text-align: left; }</style>');
            newWindow.document.write('</head><body>');
            newWindow.document.write('<h4>LIST OF JOB ORDER</h4>');
            newWindow.document.write(tableContent);
            newWindow.document.write('</body></html>');
            newWindow.document.close();
            newWindow.print();
        }
    </script>

    
@endsection
