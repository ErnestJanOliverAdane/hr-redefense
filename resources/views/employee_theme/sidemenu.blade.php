@php
    $user = Auth::user(); // assuming this is MasterlistModel user
@endphp

<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo"></a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                <em class="icon ni ni-arrow-left"></em>
            </a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu">
                <em class="icon ni ni-menu"></em>
            </a>
        </div>
    </div>

    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading pt-0">
                        <h6 class="overline-title text-primary-alt">Menu</h6>
                    </li>

                    {{-- Always visible --}}
                    <li class="nk-menu-item">
                        <a href="/emp/dashboard" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">User Profile</span>
                        </a>
                    </li>

                    {{-- Conditional: Show only if not disabled --}}
                    @if ($user->employment_type !== 'disabled')
                        <li class="nk-menu-item has-sub">
                            <a href="/personal-data-sheet" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-card-view"></em></span>
                                <span class="nk-menu-text">User Update Profile</span>
                            </a>
                        </li>

                        <li class="nk-menu-item">
                            <a href="/employee/files" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-files-fill"></em></span>
                                <span class="nk-menu-text">Attachment Files</span>
                            </a>
                        </li>
                    @endif

                    {{-- Request COE is always visible --}}
                    <li class="nk-menu-item has-sub">
                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file-text"></em></span>
                            <span class="nk-menu-text">Request COE</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="/request" class="nk-menu-link">
                                    <span class="nk-menu-text">New Request</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/request/status" class="nk-menu-link">
                                    <span class="nk-menu-text">Request Status</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Conditional: Show only if not disabled --}}
                    @if ($user->employment_type !== 'disabled')
                        <li class="nk-menu-item has-sub">
                            <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-file-text"></em></span>
                                <span class="nk-menu-text">Request SO</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="/sorequest" class="nk-menu-link">
                                        <span class="nk-menu-text">New Request</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="/sorequest/sorequeststatus" class="nk-menu-link">
                                        <span class="nk-menu-text">Request Status</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    {{-- Promotion request only for active faculty --}}
                    @if ($user->employment_type !== 'disabled' && $user->job_type == 'faculty')
                        <li class="nk-menu-item has-sub">
                            <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-trend-up"></em></span>
                                <span class="nk-menu-text">Promotion request</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="/promotion" class="nk-menu-link">
                                        <span class="nk-menu-text">New Request</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="/promotion/status" class="nk-menu-link">
                                        <span class="nk-menu-text">Promotion Status</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>
</div>
