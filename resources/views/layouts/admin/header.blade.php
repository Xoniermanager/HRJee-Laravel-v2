<div class="page-header row">
    <div class="header-logo-wrapper col-auto">
        <div class="logo-wrapper"><a href="index.html">
                <img class="img-fluid for-light" src="{{ asset('admin/assets/images/logo-light.png')}}" alt="" /><img
                    class="img-fluid for-dark" src="{{ asset('admin/assets/images/logo-light.png')}}" alt="" /></a>
        </div>
    </div>
    <div class="col-4 col-xl-4 page-title">
        <h4 class="f-w-700">@yield('title')</h4>
    </div>
    <!-- Page Header Start-->
    <div class="header-wrapper col m-0">
        <div class="row">
            <form class="form-inline search-full col" action="#" method="get">
                <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                placeholder="Search Mofi .." name="q" title="" autofocus>
                            <div class="spinner-border Typeahead-spinner" role="status"><span
                                    class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form>
            <div class="header-logo-wrapper col-auto p-0">
                <div class="logo-wrapper"><a href="index.html"><img class="img-fluid"
                            src="{{ asset('admin/assets/images/logo.png')}}" alt=""></a></div>
                <div class="toggle-sidebar">
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                <ul class="nav-menus">
                    <li> <span class="header-search">
                            <svg>
                                <use href="{{ asset('admin/assets/svg/icon-sprite.svg')}}"></use>
                            </svg></span></li>
                    {{-- <li>
                        <div class="form-group w-100">
                            <div class="Typeahead Typeahead--twitterUsers">
                                <div class="u-posRelative d-flex align-items-center">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round"></path>
                                        </g>
                                    </svg>
                                    <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100"
                                        type="text" placeholder="Search  ..." name="q" title="">
                                </div>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li class="fullscreen-body">
                        <span>
                            <svg id="maximize-screen">
                                <use href="{{ asset('admin/assets/images/svg/')}}"></use>
                            </svg>



                        </span>
                    </li> --}}
                    {{-- <li class="onhover-dropdown">
                        <div class="notification-box">
                            <i class="fa fa-bell"></i><span class="badge rounded-pill badge-primary">4 </span>
                        </div>
                        <div class="onhover-show-div notification-dropdown">
                            <h5 class="f-18 f-w-600 mb-0 dropdown-title">Notifications </h5>
                            <ul class="notification-box">
                                <li class="toast default-show-toast align-items-center border-0 fade show"
                                    aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                    <div class="d-flex justify-content-between">
                                        <div class="toast-body d-flex p-0">
                                            <div class="flex-shrink-0 bg-light-primary"><img class="w-auto"
                                                    src="{{ asset('admin/assets/images/dashboard/icon/wallet.png')}}"
                                                    alt="Wallet"></div>
                                            <div class="flex-grow-1"> <a href="private-chat.html">
                                                    <h6 class="m-0">Daily offer added</h6>
                                                </a>
                                                <p class="m-0">User-only offer added</p>
                                            </div>
                                        </div>
                                        <button class="btn-close btn-close-white shadow-none" type="button"
                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </li>
                                <li class="toast default-show-toast align-items-center border-0 fade show"
                                    aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                    <div class="d-flex justify-content-between">
                                        <div class="toast-body d-flex p-0">
                                            <div class="flex-shrink-0 bg-light-info"><img class="w-auto"
                                                    src="{{ asset('admin/assets/images/dashboard/icon/shield-dne.png')}}"
                                                    alt="Shield-dne"></div>
                                            <div class="flex-grow-1"> <a href="private-chat.html">
                                                    <h6 class="m-0">Product Review</h6>
                                                </a>
                                                <p class="m-0">Changed to a workflow</p>
                                            </div>
                                        </div>
                                        <button class="btn-close btn-close-white shadow-none" type="button"
                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </li>
                                <li class="toast default-show-toast align-items-center border-0 fade show"
                                    aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                    <div class="d-flex justify-content-between">
                                        <div class="toast-body d-flex p-0">
                                            <div class="flex-shrink-0 bg-light-warning"><img class="w-auto"
                                                    src="{{ asset('admin/assets/images/dashboard/icon/graph.png')}}"
                                                    alt="Graph">
                                            </div>
                                            <div class="flex-grow-1"> <a href="private-chat.html">
                                                    <h6 class="m-0">Return Products</h6>
                                                </a>
                                                <p class="m-0">52 items were returned</p>
                                            </div>
                                        </div>
                                        <button class="btn-close btn-close-white shadow-none" type="button"
                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </li>
                                <li class="toast default-show-toast align-items-center border-0 fade show"
                                    aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
                                    <div class="d-flex justify-content-between">
                                        <div class="toast-body d-flex p-0">
                                            <div class="flex-shrink-0 bg-light-tertiary"><img class="w-auto"
                                                    src="{{ asset('admin/assets/images/dashboard/icon/ticket-star.png')}}"
                                                    alt="Ticket-star"></div>
                                            <div class="flex-grow-1"> <a href="private-chat.html">
                                                    <h6 class="m-0">Recently Paid</h6>
                                                </a>
                                                <p class="m-0">Card payment of $343 </p>
                                            </div>
                                        </div>
                                        <button class="btn-close btn-close-white shadow-none" type="button"
                                            data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    <li>
                        <div class="mode">
                            <svg height="200px" width="200px" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 56 56" xml:space="preserve" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path style="fill:#A5A5A4;"
                                        d="M29,28c0-11.917,7.486-22.112,18-26.147C43.892,0.66,40.523,0,37,0C21.561,0,9,12.561,9,28 s12.561,28,28,28c3.523,0,6.892-0.66,10-1.853C36.486,50.112,29,39.917,29,28z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </li>
                    {{-- <li class="onhover-dropdown">
                        <div class="notification-box">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                </g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M7 9H17M7 13H17M21 20L17.6757 18.3378C17.4237 18.2118 17.2977 18.1488 17.1656 18.1044C17.0484 18.065 16.9277 18.0365 16.8052 18.0193C16.6672 18 16.5263 18 16.2446 18H6.2C5.07989 18 4.51984 18 4.09202 17.782C3.71569 17.5903 3.40973 17.2843 3.21799 16.908C3 16.4802 3 15.9201 3 14.8V7.2C3 6.07989 3 5.51984 3.21799 5.09202C3.40973 4.71569 3.71569 4.40973 4.09202 4.21799C4.51984 4 5.0799 4 6.2 4H17.8C18.9201 4 19.4802 4 19.908 4.21799C20.2843 4.40973 20.5903 4.71569 20.782 5.09202C21 5.51984 21 6.0799 21 7.2V20Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg><span class="badge rounded-pill badge-info">3 </span>
                        </div>
                        <div class="onhover-show-div notification-dropdown">
                            <h5 class="f-18 f-w-600 mb-0 dropdown-title">Messages </h5>
                            <ul class="messages">
                                <li class="d-flex b-light1-primary gap-2">
                                    <div class="flex-shrink-0"><img
                                            src="{{ asset('admin/assets/images/dashboard-2/user1.png')}}" alt="Graph">
                                    </div>
                                    <div class="flex-grow-1"> <a href="private-chat.html">
                                            <h6 class="font-primary f-w-600">Hackett Yessenia</h6>
                                        </a>
                                        <p>Hello Miss...&#128522;</p>
                                    </div><span>2 hours</span>
                                </li>
                                <li class="d-flex b-light1-secondary gap-2">
                                    <div class="flex-shrink-0"><img
                                            src="{{ asset('admin/assets/images/dashboard-2/user2.png')}}" alt="Graph">
                                    </div>
                                    <div class="flex-grow-1"> <a href="private-chat.html">
                                            <h6 class="font-secondary f-w-600">schneider Adan</h6>
                                        </a>
                                        <p>Wishing You a Happy Birthday Dear.. 🥳&#127882;</p>
                                    </div><span>3 hours</span>
                                </li>
                                <li class="d-flex b-light1-success gap-2">
                                    <div class="flex-shrink-0"><img
                                            src="{{ asset('admin/assets/images/dashboard-2/user/3.png')}}" alt="Graph">
                                    </div>
                                    <div class="flex-grow-1"> <a href="private-chat.html">
                                            <h6 class="font-success f-w-600">Mahdi Gholizadeh</h6>
                                        </a>
                                        <p>Hello Dear!! This Theme Is Very beautiful</p>
                                    </div><span>5 hours</span>
                                </li>
                                <li class="bg-transparent"><a class="f-w-700 btn btn-primary w-100"
                                        href="letter-box.html">View all</a></li>
                            </ul>
                        </div>
                    </li> --}}

                    <li class="profile-nav onhover-dropdown px-0 py-0">
                        <div class="d-flex profile-media align-items-center"><img class="img-30 rounded-circle"
                                src="{{ asset('admin/assets/images/avatar.png')}}" alt="">
                            <div class="flex-grow-1"><span>{{ Auth()->guard('admin')->user()->name }}</span>
                                {{-- <p class="mb-0 font-outfit">Profile<i class="fa fa-angle-down"></i></p> --}}
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">

                            <li><a href="{{ route('admin.getProfile') }}"><i class="fa fa-user pr-10"></i><span>Profile</span></a>
                            </li>
                            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-arrow-circle-right pr-10">
                                    </i><span>Log out</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <script class="result-template" type="text/x-handlebars-template">
                <div class="ProfileCard u-cf">
      <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
      <div class="ProfileCard-details">
      <div class="ProfileCard-realName"></div>
      </div>
      </div>
    </script>
            <script class="empty-template" type="text/x-handlebars-template">
                <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
            </script>
        </div>
    </div>
    <!-- Page Header Ends                              -->
</div>
