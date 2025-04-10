@foreach ($so_requests as $so_request)
    <div class="modal fade" id="viewSOModal{{ $so_request->soreqid }}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">SO Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="col-lg-4">Employee ID</td>
                                        <td class="col-lg-8">
                                            {{ $so_request-> employee_id }} 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $so_request->Email }}</td>
                                    </tr>
                                    <tr>
                                        <td>TIN</td>
                                        <td>{{ $so_request->tin }}</td>
                                    </tr>
                                    <tr>
                                        <td>Birthdate</td>
                                        <td>{{ $so_request->birthdate }}</td>
                                    </tr>
                                    <tr>
                                        <td>Birthplace</td>
                                        <td>{{ $so_request->birthplace }}</td>
                                    </tr>
                                    <tr>
                                        <td>Purpose</td>
                                        <td>{{ $so_request->purpose }}</td>
                                    </tr>
                                    <tr>
                                        <td>Attachment</td>
                                        <td>
                                            @if ($so_request->attachment)
                                                @php
                                                    $extension = pathinfo($so_request->attachment, PATHINFO_EXTENSION);
                                                    $isImage = in_array(strtolower($extension), ['jpg','jpeg','png','gif']);
                                                @endphp

                                                @if ($isImage)
                                                    <img src="{{ asset('storage/' . $so_request->attachment) }}" class="img-fluid mb-2" style="max-height: 200px;">
                                                @endif

                                                <a href="{{ asset('storage/' . $so_request->attachment) }}" class="btn btn-sm btn-primary d-block" target="_blank">
                                                    View Full {{ $isImage ? 'Image' : 'Document' }}
                                                </a>
                                            @else
                                                <span class="text-muted">No attachment provided</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <span class="badge badge-sm badge-dot has-bg
                                                {{ $so_request->status === 'pending'
                                                    ? 'bg-warning'
                                                    : ($so_request->status === 'approve'
                                                        ? 'bg-success'
                                                        : 'bg-danger') }}">
                                                {{ ucfirst($so_request->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="POST" action="{{ route('so_request.approve', $so_request->soreqid) }}" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('so_request.reject', $so_request->soreqid) }}" class="d-inline">
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

