<!--  BEGIN NAVBAR  -->
<div class="header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
            <i data-feather="menu"></i>
        </a>

        <div class="nav-logo align-self-center">
            <a class="navbar-brand" href="{{route('admin.home')}}"><img alt="logo" src="{{asset('admins/assets/img/90x90.jpg')}}"> <span class="navbar-brand-name">Blog chat</span></a>
        </div>

        <ul class="navbar-item flex-row nav-dropdowns ml-auto">
            <li class="nav-item dropdown user-profile-dropdown order-lg-0 order-1">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="user-profile-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <img src="{{asset('admins/assets/img/90x90.jpg')}}" class="img-fluid" alt="admin-profile">
                        <div class="media-body align-self-center">
                            <h6><span>Hi,</span> {{Auth::user()->name}}</h6>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <div class="dropdown-menu position-absolute animated fadeInUp" aria-labelledby="user-profile-dropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                My Profile</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="apps_mailbox.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                                    <path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                </svg>
                                Inbox</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="auth_lockscreen.html">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                Lock Screen</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="javascript:void(0);" onclick="logout()">
                                <i data-feather="log-out"></i>
                                Sign Out
                            </a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </header>
    <form id="logout-form" action="{{route('admin.logout')}}" method="post">
        @csrf
    </form>
</div>
<!--  END NAVBAR  -->
