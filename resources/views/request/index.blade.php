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
                                    <th>Department/Designation</th>
                                    <th>Issue Date</th>
                                    <th>Monthy Compensation</th>
                                    <th width="100" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr style="cursor: pointer">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="nk-tb-col">
                                        <div class="dropdown">
                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger"
                                                data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                <ul class="link-list-plain">
                                                    <li><a href="#">Accept</a></li>
                                                    <li><a href="#">Decline</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
