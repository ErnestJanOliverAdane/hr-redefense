@extends('employee_theme.layout')
@section('content')

@php
use Illuminate\Support\Facades\Storage;
@endphp


    <div class="nk-fmg-body">
        <div class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <!-- Add search functionality if needed -->
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="#file-upload" class="btn btn-primary" data-bs-toggle="modal">
                            <em class="icon ni ni-upload-cloud"></em>
                            <span>Upload</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- File Upload Modal -->
        <div class="modal fade" id="file-upload" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Upload File</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employee.files.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Choose File</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Files List -->
        <div class="nk-fmg-quick-list nk-block">
            <div class="nk-block-head-xs">
                <div class="nk-block-between g-2">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Files</h3>
                    </div>
                </div>
            </div>
            <div class="nk-files nk-files-view-grid">
                <div class="nk-files-list">
                    @foreach ($files as $file)
                        <div class="nk-file-item nk-file">
                            <div class="nk-file-info">
                            <a href="{{ route('employee.files.show', $file->id) }}" target="_blank" class="nk-file-link">
                                    <div class="nk-file-title">
                                        <div class="nk-file-icon">
                                            <span class="nk-file-icon-type">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 72 72">
                                                    <g>
                                                        <rect x="32" y="16" width="28" height="15" rx="2.5"
                                                            ry="2.5" style="fill:#f29611" />
                                                        <path
                                                            d="M59.7778,61H12.2222A6.4215,6.4215,0,0,1,6,54.3962V17.6038A6.4215,6.4215,0,0,1,12.2222,11H30.6977a4.6714,4.6714,0,0,1,4.1128,2.5644L38,24H59.7778A5.91,5.91,0,0,1,66,30V54.3962A6.4215,6.4215,0,0,1,59.7778,61Z"
                                                            style="fill:#ffb32c" />
                                                        <path
                                                            d="M8.015,59c2.169,2.3827,4.6976,2.0161,6.195,2H58.7806a6.2768,6.2768,0,0,0,5.2061-2Z"
                                                            style="fill:#f2a222" />
                                                    </g>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="nk-file-name">
                                            <div class="nk-file-name-text">
                                                <span class="title">{{ $file->name }}</span>
                                            </div>
                                            <div class="nk-file-size">{{ number_format($file->size / 1024, 2) }} KB</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="nk-file-actions">
                                <form action="{{ route('employee.files.destroy', $file->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                        <em class="icon ni ni-trash"></em>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
