<nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
                <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}"><img src="{{ asset('frontend/images/logo.png')}}" alt="logo" style="height: 130px;"/></a>
                <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('dashboard') }}"><img src="{{ asset('frontend/images/logo.png')}}" alt="logo" style="height: 130px;"/></a>
            </div>
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                            @if(session('image') && session('image') != "")
                                <img src="{{ asset('storage/users').'/'.session('image') }}" alt="profile" />
                            @else
                                <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile" />
                            @endif
                            <span class="login-status online"></span>
                            <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column pr-3">
                            <span class="font-weight-medium mb-2">{{ session('name') }}</span>
                            <span class="font-weight-normal">8,753.00</span>
                        </div>
                        <span class="badge badge-danger text-white ml-3 rounded">3</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item @if((request()->segment(1)=='view_department') || (request()->segment(1)=='add_department')) active @endif">
                    <a class="nav-link" href="{{ route('view.department') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Departments</span>
                    </a>
                </li>
                <li class="nav-item @if((request()->segment(1)=='view_branch') || (request()->segment(1)=='add_branch')) active @endif">
                    <a class="nav-link" href="{{ route('view.branch') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Branch</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='view_employee') || (request()->segment(1)=='add_employee') || (request()->segment(1)=='edit_employee')) active @endif">
                    <a class="nav-link" href="{{ route('view.emp') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Employee</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='telecaller-feedback')) active @endif">
                    <a class="nav-link" href="{{ route('view.t_feedback') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">View Telecaler Feedback</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='show_attendance')) active @endif">
                    <a class="nav-link" href="{{ route('view.attendance') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">View Attendance</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='loans')) active @endif">
                    <a class="nav-link" href="{{ route('loans.index') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Loans</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='advances')) active @endif">
                    <a class="nav-link" href="{{ route('advances.index') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Advance Salary</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='category')) active @endif">
                    <a class="nav-link" href="{{ route('view.category') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Category</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='product')) active @endif">
                    <a class="nav-link" href="{{ route('view.product') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Products</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='shop_footer_details')) active @endif">
                    <a class="nav-link" href="{{ route('view.footer.details') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Shop Footer Details</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='discount')) active @endif">
                    <a class="nav-link" href="{{ route('view.discount') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Discount</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='cart_setting')) active @endif">
                    <a class="nav-link" href="{{ route('add.cart.setting') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Cart Setting</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='salary')) active @endif">
                    <a class="nav-link" href="{{ route('view.salary') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Add Salary Account </span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='leads')) active @endif">
                    <a class="nav-link" href="{{ route('leads.index') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Lead Management</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='tasks')) active @endif">
                    <a class="nav-link" href="{{ route('tasks.index') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Task Management</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='todo')) active @endif">
                    <a class="nav-link" href="{{ route('todos.index') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">TODO List</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='contact_us')) active @endif">
                    <a class="nav-link" href="{{ route('contact.us.index') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Contact Us Details</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='leaves')) active @endif">
                    <a class="nav-link" href="{{ route('view.leaves') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Leaves</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='holidays')) active @endif">
                    <a class="nav-link" href="{{ route('view.holidays') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Holidays</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='target')) active @endif">
                    <a class="nav-link" href="{{ route('view.target') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Target</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='sop')) active @endif">
                    <a class="nav-link" href="{{ route('view.sop') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">SOP</span>
                    </a>
                </li>

                <li class="nav-item @if((request()->segment(1)=='campaign')) active @endif">
                    <a class="nav-link" href="{{ route('view.campaign') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">Campaign</span>
                    </a>
                </li>

                {{-- <li class="nav-item @if((request()->segment(1)=='view_loans')) active @endif">
                    <a class="nav-link" href="{{ route('loans.view') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">View Loans</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                        aria-controls="ui-basic">
                        <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        <span class="menu-title">Basic UI Elements</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="pages/ui-features/typography.html">Typography</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="pages/forms/basic_elements.html">
                        <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        <span class="menu-title">Forms</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/charts/chartjs.html">
                        <i class="mdi mdi-chart-bar menu-icon"></i>
                        <span class="menu-title">Charts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/tables/basic-table.html">
                        <i class="mdi mdi-table-large menu-icon"></i>
                        <span class="menu-title">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <span class="nav-link" href="#">
                        <span class="menu-title">Docs</span>
                    </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://www.bootstrapdash.com/demo/breeze-free/documentation/documentation.html">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                        <span class="menu-title">Documentation</span>
                    </a>
                </li>
                <li class="nav-item sidebar-actions">
                    <div class="nav-link">
                        <div class="mt-4">
                            <div class="border-none">
                                <p class="text-black">Notification</p>
                            </div>
                            <ul class="mt-4 pl-0">
                                <li>Sign Out</li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container-fluid page-body-wrapper">
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles light"></div>
                    <div class="tiles dark"></div>
                </div>
            </div>