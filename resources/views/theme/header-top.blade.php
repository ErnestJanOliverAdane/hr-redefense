@php
    $user = ['type' => 'admin', 'name' => '', 'email' => ''];
@endphp
<div class="nk-header nk-header-fixed is-light" style="border-top: 10px solid #b4543d">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ms-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em
                        class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="/logo.png" srcset="/logo.png 2x" alt="logo">
                    <img class="logo-dark logo-img" src="/logo.png" srcset="/logo.png 2x" alt="logo-dark">
                </a>
            </div>


            <!-- .nk-header-search bar -->
            
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle me-n1" data-bs-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm" style="background-color: #b4543d">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                                <div class="user-info d-none d-xl-block">
                                    @php
                                        if ($user['type'] == 'HR Admin') {
                                            $role = 'HR Admin';
                                        } elseif ($user['type'] == 'Employee') {
                                            $role = 'Employee';
                                        }
                                    @endphp
                                    <div class="user-status user-status-active"
                                        style="text-transform: uppercase; color: #b4543d">Admin</div>
                                    <div class="user-name dropdown-indicator" style="text-transform: uppercase">
                                        {{ Auth::user()->name }}

                                    </div>

                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-avatar">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text">{{ $user['name'] }}</span>
                                        <span class="sub-text">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">

                                    {{-- <li>
                                        <a href="{{ route('profile.edit') }}">
                                            <em class="icon ni ni-user-alt"></em>
                                            <span>{{ __('View Profile') }}</span>
                                        </a>
                                    </li> --}}



                                    <li><a href="html/user-profile-setting.html"><em
                                                class="icon ni ni-setting-alt"></em><span>Account Setting</span></a>
                                    </li>
                                </ul>

                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
