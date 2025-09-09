<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
        <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}"><img
                src="{{ asset('frontend/images/logo.png') }}" alt="logo" style="height: 130px;" /></a>
        <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('dashboard') }}"><img
                src="{{ asset('frontend/images/logo.png') }}" alt="logo" style="height: 130px;" /></a>
    </div>
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    @if (session('image') && session('image') != '')
                        <img src="{{ asset('storage/users') . '/' . session('image') }}" alt="profile" />
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
            <div id="google_translate_element"></div>

            <script type="text/javascript">
                function googleTranslateElementInit() {
                    new google.translate.TranslateElement({
                        pageLanguage: 'en', // Your default language
                        // includedLanguages: 'en,hi,fr,es,ar,zh-CN', // Customize with allowed languages
                        layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                    }, 'google_translate_element');
                }
            </script>

            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
            </script>
        </li>

        @if (session('role') == '0' || in_array('dashboard', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                    <span class="menu-title">Theme Customization</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'admin_select_theme') || (request()->segment(1) == 'admin_edit_theme')) active @endif" href="{{ route('add.theme') }}">Add Theme</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'select_theme')) active @endif" href="{{ route('select.theme') }}">Select Theme</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) ==   'theme_home_header_customization')) active @endif" href="{{ route('theme.home.header.customization') }}">Home-Header Modify</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) ==   'theme_home_custom_data')) active @endif" href="{{ route('theme.home.custom.data') }}">Home-Custom Modify</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_about_us')) active @endif" href="{{ route('theme.home.about.us') }}">Home-AboutUs Modify</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_service_us')) active @endif" href="{{ route('theme.home.service') }}">Home-Services Modify</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_call_to_action')) active @endif" href="{{ route('theme.home.call.to.action') }}">Home-Call To Action</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_feature')) active @endif" href="{{ route('theme.home.feature') }}">Home-Features</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_pricing')) active @endif" href="{{ route('theme.home.pricing') }}">Home-Pricing</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_frequently_qst')) active @endif" href="{{ route('theme.home.frquently') }}">Home-Frequently Qst</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_home_team_member') || (request()->segment(1) == 'theme_about_team_member')) active @endif" href="{{ route('theme.about.team.member') }}">About - Team Member</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link @if ((request()->segment(1) == 'theme_contact')) active @endif" href="{{ route('theme.contact') }}">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

        @if (session('role') == '0' || in_array('departments', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'view_department' || request()->segment(1) == 'add_department') active @endif">
                <a class="nav-link" href="{{ route('view.department') }}">
                    <i class="mdi mdi-office-building menu-icon"></i>
                    <span class="menu-title">Departments</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('branch', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'view_branch' || request()->segment(1) == 'add_branch') active @endif">
                <a class="nav-link" href="{{ route('view.branch') }}">
                    <i class="mdi mdi-store menu-icon"></i>
                    <span class="menu-title">Branch</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('employee', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'view_employee' ||
                    request()->segment(1) == 'add_employee' ||
                    request()->segment(1) == 'edit_employee') active @endif">
                <a class="nav-link" href="{{ route('view.emp') }}">
                    <i class="mdi mdi-account menu-icon"></i>
                    <span class="menu-title">Employee</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('telecaler', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'telecaller-feedback') active @endif">
                <a class="nav-link" href="{{ route('view.t_feedback') }}">
                    <i class="mdi mdi-phone-message menu-icon"></i>
                    <span class="menu-title">View Telecaler Feedback</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('attendance', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'show_attendance') active @endif">
                <a class="nav-link" href="{{ route('view.attendance') }}">
                    <i class="mdi mdi-account-check menu-icon"></i>
                    <span class="menu-title">View Attendance</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('loans', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'loans') active @endif">
                <a class="nav-link" href="{{ route('loans.index') }}">
                    <i class="mdi mdi-cash-multiple menu-icon"></i>
                    <span class="menu-title">Loans</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('salary', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'advances') active @endif">
                <a class="nav-link" href="{{ route('advances.index') }}">
                    <i class="mdi mdi-cash-refund menu-icon"></i>
                    <span class="menu-title">Advance Salary</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('category', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'category') active @endif">
                <a class="nav-link" href="{{ route('view.category') }}">
                    <i class="mdi mdi-folder menu-icon"></i>
                    <span class="menu-title">Category</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('products', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'product') active @endif">
                <a class="nav-link" href="{{ route('view.product') }}">
                    <i class="mdi mdi-package-variant menu-icon"></i>
                    <span class="menu-title">Products</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('footer_shop', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'shop_footer_details') active @endif">
                <a class="nav-link" href="{{ route('view.footer.details') }}">
                    <i class="mdi mdi-store menu-icon"></i>
                    <span class="menu-title">Shop Footer Details</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('discount', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'discount') active @endif">
                <a class="nav-link" href="{{ route('view.discount') }}">
                    <i class="mdi mdi-tag-outline menu-icon"></i>
                    <span class="menu-title">Discount</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('cart_setting', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'cart_setting') active @endif">
                <a class="nav-link" href="{{ route('add.cart.setting') }}">
                    <i class="mdi mdi-cart menu-icon"></i>
                    <span class="menu-title">Cart Setting</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('salary_account', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'salary') active @endif">
                <a class="nav-link" href="{{ route('view.salary') }}">
                    <i class="mdi mdi-credit-card menu-icon"></i>
                    <span class="menu-title">Add Salary Account </span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('lead_management', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'leads') active @endif">
                <a class="nav-link" href="{{ route('leads.index') }}">
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                    <span class="menu-title">Lead Management</span>
                </a>
            </li>
        @endif

        @if (session('role') == '1' ||
                session('role') == '0' ||
                in_array('task_management', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'tasks') active @endif">
                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <i class="mdi mdi-timer-sand menu-icon"></i>
                    <span class="menu-title">Task Management</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('todo', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'todo') active @endif">
                <a class="nav-link" href="{{ route('todos.index') }}">
                    <i class="mdi mdi-checkbox-marked-outline menu-icon"></i>
                    <span class="menu-title">TODO List</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('contact_us', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'contact_us') active @endif">
                <a class="nav-link" href="{{ route('contact.us.index') }}">
                    <i class="mdi mdi-email menu-icon"></i>
                    <span class="menu-title">Contact Us Details</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('leaves', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'leaves') active @endif">
                <a class="nav-link" href="{{ route('view.leaves') }}">
                    <i class="mdi mdi-account-clock-outline menu-icon"></i>
                    <span class="menu-title">Leaves</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('holidays', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'holidays') active @endif">
                <a class="nav-link" href="{{ route('view.holidays') }}">
                    <i class="mdi mdi-calendar-account-outline menu-icon"></i>
                    <span class="menu-title">Holidays</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('target', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'target') active @endif">
                <a class="nav-link" href="{{ route('view.target') }}">
                    <i class="mdi mdi-target menu-icon"></i>
                    <span class="menu-title">Target</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('sop', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'sop') active @endif">
                <a class="nav-link" href="{{ route('view.sop') }}">
                    <i class="mdi mdi-clipboard-text-outline     menu-icon"></i>
                    <span class="menu-title">SOP</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('campaign', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'campaign') active @endif">
                <a class="nav-link" href="{{ route('view.campaign') }}">
                    <i class="mdi mdi-alpha-c-box menu-icon"></i>
                    <span class="menu-title">Campaign</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('order_details', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'order_details') active @endif">
                <a class="nav-link" href="{{ route('view.order_details') }}">
                    <i class="mdi mdi-file-account-outline menu-icon"></i>
                    <span class="menu-title">Order Details</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('material', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'materials') active @endif">
                <a class="nav-link" href="{{ route('view.material') }}">
                    <i class="mdi mdi-alpha-m-box menu-icon"></i>
                    <span class="menu-title">Materials</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('users', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'users') active @endif">
                <a class="nav-link" href="{{ route('view.user.details') }}">
                    <i class="mdi mdi-account-group menu-icon"></i>
                    <span class="menu-title">Customers</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('meeting', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'meeting') active @endif">
                <a class="nav-link" href="{{ route('view.meeting') }}">
                    <i class="mdi mdi-briefcase menu-icon"></i>
                    <span class="menu-title">Meetings</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('template', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'template') active @endif">
                <a class="nav-link" href="{{ route('view.template') }}">
                    <i class="mdi mdi-alpha-t-box menu-icon"></i>
                    <span class="menu-title">Template</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('whats_app', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'whats_app') active @endif">
                <a class="nav-link" href="{{ route('view.whats_app') }}">
                    <i class="mdi mdi-whatsapp menu-icon"></i>
                    <span class="menu-title">Whats App Setting</span>
                </a>
            </li>
        @endif

        @if (session('role') == '0' || in_array('whats_app_flow', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'whats_app_flow') active @endif">
                <a class="nav-link" href="{{ route('view.whats_app.flow') }}">
                    <i class="mdi mdi-whatsapp menu-icon"></i>
                    <span class="menu-title">Whats App Flow</span>
                </a>
            </li>
        @endif

        <li class="nav-item @if (request()->segment(1) == 'whats_app_chat' ||
                request()->segment(1) == 'whats_app_image' ||
                request()->segment(1) == 'whats_app_sticker' ||
                request()->segment(1) == 'whats_app_document' ||
                request()->segment(1) == 'whats_app_audio' ||
                request()->segment(1) == 'whats_app_video' ||
                request()->segment(1) == 'whats_app_contact' ||
                request()->segment(1) == 'whats_app_location' ||
                request()->segment(1) == 'whats_app_vcard' ||
                request()->segment(1) == 'whats_app_reaction' ||
                request()->segment(1) == 'whats_app_resend') active @endif">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic"
                aria-expanded="@if (request()->segment(1) == 'whats_app_chat' ||
                        request()->segment(1) == 'whats_app_image' ||
                        request()->segment(1) == 'whats_app_sticker' ||
                        request()->segment(1) == 'whats_app_document' ||
                        request()->segment(1) == 'whats_app_audio' ||
                        request()->segment(1) == 'whats_app_video' ||
                        request()->segment(1) == 'whats_app_contact' ||
                        request()->segment(1) == 'whats_app_location' ||
                        request()->segment(1) == 'whats_app_vcard' ||
                        request()->segment(1) == 'whats_app_reaction' ||
                        request()->segment(1) == 'whats_app_resend') true @else false @endif" aria-controls="ui-basic">
                <i class="mdi mdi-whatsapp menu-icon"></i>
                <span class="menu-title">Whats App Messages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse @if (request()->segment(1) == 'whats_app_chat' ||
                    request()->segment(1) == 'whats_app_image' ||
                    request()->segment(1) == 'whats_app_sticker' ||
                    request()->segment(1) == 'whats_app_document' ||
                    request()->segment(1) == 'whats_app_audio' ||
                    request()->segment(1) == 'whats_app_video' ||
                    request()->segment(1) == 'whats_app_contact' ||
                    request()->segment(1) == 'whats_app_location' ||
                    request()->segment(1) == 'whats_app_vcard' ||
                    request()->segment(1) == 'whats_app_reaction' ||
                    request()->segment(1) == 'whats_app_resend') show @endif" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_chat') active @endif"
                            href="{{ route('view.whats_app.chat') }}">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_image') active @endif"
                            href="{{ route('view.whats_app.image') }}">Image</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_sticker') active @endif"
                            href="{{ route('view.whats_app.sticker') }}">Sticker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_document') active @endif"
                            href="{{ route('view.whats_app.document') }}">Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_audio') active @endif"
                            href="{{ route('view.whats_app.audio') }}">Audio/Voice</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_video') active @endif"
                            href="{{ route('view.whats_app.video') }}">Video</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_contact') active @endif"
                            href="{{ route('view.whats_app.contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_location') active @endif"
                            href="{{ route('view.whats_app.location') }}">Location</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_vcard') active @endif"
                            href="{{ route('view.whats_app.vcard') }}">VCard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_reaction') active @endif"
                            href="{{ route('view.whats_app.reaction') }}">Reaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'whats_app_resend') active @endif"
                            href="{{ route('view.whats_app.resend') }}">Resend By Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (request()->segment(1) == 'qrcode') active @endif"
                            href="{{ route('view.whats_app.qrcode') }}">QR Code</a>
                    </li>
                </ul>
            </div>
        </li>

        @if (session('role') == '0' || in_array('credentials', session('page_access')->pluck('page_name')->toArray()))
            <li class="nav-item @if (request()->segment(1) == 'credetails') active @endif">
                <a class="nav-link" href="{{ route('credentials.view') }}">
                    <i class="mdi mdi-account-box-outline menu-icon"></i>
                    <span class="menu-title">Credentials</span>
                </a>
            </li>
        @endif

        {{-- <li class="nav-item @if (request()->segment(1) == 'view_loans') active @endif">
                    <a class="nav-link" href="{{ route('loans.view') }}">
                        <i class="mdi mdi-contacts menu-icon"></i>
                        <span class="menu-title">View Loans</span>
                    </a>
                </li>

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
                </li> --}}
        <li class="nav-item sidebar-actions">
            <div class="nav-link">
                <div class="mt-4">
                    <div class="border-none">
                        <p class="text-black">Notification</p>
                    </div>
                    <ul class="mt-4 pl-0">
                        <li><a href="{{ route('p.logout') }}">Sign Out</a></li>
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
