{{-- <h4 class="header">Request Certificate of Employment</h4>
<div class="nk-block-head-content">
    <div class="nk-block-des text-soft">
        <p>Click the button below to request your certificate of employment.</p>
    </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestModal">
        Request Certificate of Employment
    </button>
</div> --}}

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
                                        <td>{{ $request->MonthlyCompensationText }}
                                            (Php {{ number_format($request->MonthlyCompensationDigits, 2) }})</td>
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
                                                    $extension = pathinfo($request->proof_payment_path, PATHINFO_EXTENSION);
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
    $(document).ready(function() {
        $('.approve-btn').click(function() {
            const id = $(this).data('id');
            $.ajax({
                url: `/others/request/${id}/approve`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    location.reload();
                }
            });
        });

        $('.reject-btn').click(function() {
            const id = $(this).data('id');
            $.ajax({
                url: `/others/request/${id}/reject`,
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    location.reload();
                }
            });
        });
    });
</script>
