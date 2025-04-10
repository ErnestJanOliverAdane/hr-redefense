@php
    //$user = ['type' => 'admin'];
@endphp


<div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                <img class="logo-dark" style="height: 65px;" src="/logo2.png" srcset="/logo.png 2x" alt="logo">
                <!--<img class="logo-small logo-img logo-img-small" src="/TCC.png" srcset="/logo.png 2x" alt="logo-small"> -->

            </a>
        </div>
        <div class="nk-menu-trigger me-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em
                    class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-heading pt-0">
                        <h6 class="overline-title text-primary-alt">menu</h6>
                    </li>

                    <li class="nk-menu-item">
                        <a href="/dashboard"class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nk-menu-heading pt-0">
                        <h6 class="overline-title text-primary-alt">EMPLOYEE MANAGEMENT</h6>
                    </li>


                    <li class="nk-menu-item">
                        <a href="/addemployees" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Add Employee</span>
                        </a>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="/masterlist" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-list"></em></span>
                            <span class="nk-menu-text" class="icon ni ni-tile-thumb-fill">Masterlist</span>
                        </a>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                            <span class="nk-menu-text">Faculty</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="/faculty" class="nk-menu-link">
                                    <span class="nk-menu-text">List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/ranks" class="nk-menu-link">
                                    <span class="nk-menu-text">Ranks</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nk-menu-item">
                        <a href="/staff" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-archive"></em></span>
                            <span class="nk-menu-text">Staff</span>
                        </a>

                    </li>

                    <li class="nk-menu-heading pt-3">
                        <h6 class="overline-title text-primary-alt">OTHERS</h6>
                    </li>

                    <li class="nk-menu-item">
                        <a href="/others/coe" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-task"></em></span>
                            <span class="nk-menu-text">COE</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="/others/so" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-task"></em></span>
                            <span class="nk-menu-text">SO</span>
                        </a>
                    </li>

                    <li class="nk-menu-heading pt-3">
                        <h6 class="overline-title text-primary-alt">REQUEST</h6>
                    </li>

                    <li class="nk-menu-item has-sub">
                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file"></em></span>
                            <span class="nk-menu-text">COE Request</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="/others/request" class="nk-menu-link">
                                    <span class="nk-menu-text">Request List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/others/rejected" class="nk-menu-link">
                                    <span class="nk-menu-text">Rejected List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/others/approved" class="nk-menu-link">
                                    <span class="nk-menu-text">Approved COE Request</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- <li class="nk-menu-item has-sub">
                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file"></em></span>
                            <span class="nk-menu-text">SO Request</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="/others/sorequestlist" class="nk-menu-link">
                                    <span class="nk-menu-text">Request List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/others/soreject" class="nk-menu-link">
                                    <span class="nk-menu-text">Rejected List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/others/soapprove" class="nk-menu-link">
                                    <span class="nk-menu-text">Approved SO Request</span>
                                </a>
                            </li>
                        </ul>
                    </li> --}}

                    <li class="nk-menu-item has-sub">
                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file"></em></span>
                            <span class="nk-menu-text">Promotion request</span>
                            @if ($pendingPromotionCount > 0)
                                <span class="nk-menu-indicator position-relative">
                                    <em class="icon ni ni-chevron-right"></em>
                                    <span class="position-absolute bg-danger rounded-circle"
                                        style="width: 6px; height: 6px; top: 0; right: 0;"></span>
                                </span>
                            @else
                                <span class="nk-menu-indicator">
                                    <em class="icon ni ni-chevron-right"></em>
                                </span>
                            @endif
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="/promote/request" class="nk-menu-link">
                                    <span class="nk-menu-text">Request List</span>
                                    @if ($pendingPromotionCount > 0)
                                        <span
                                            class="badge badge-pill badge-primary ml-auto">{{ $pendingPromotionCount }}</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/promote/reject" class="nk-menu-link">
                                    <span class="nk-menu-text">Rejected List</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/promote/approve" class="nk-menu-link">
                                    <span class="nk-menu-text">Approved List</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nk-menu-heading pt-3">
                        <h6 class="overline-title text-primary-alt">OVERALL REPORT</h6>
                    </li>
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-report"></em></span>
                            <span class="nk-menu-text">Reports</span>
                        </a>

                        <ul class="nk-menu-sub">

                            <li class="nk-menu-item">
                                <a href="/ccosreport" class="nk-menu-link">
                                    <span class="nk-menu-text">Casual/Contractual Reports</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/jocosmoareport" class="nk-menu-link">
                                    <span class="nk-menu-text">JO/COS/MOA Reports</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
