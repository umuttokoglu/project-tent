<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories ps" id="sidebar-accordion">
            <li class="menu">
                <a href="{{ route('dashboard') }}"
                   @if(\App\Constants\UrlSegments::DASHBOARD_SEGMENT === request()->segment(1)) data-active="true"
                   @endif aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-codesandbox">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline>
                            <polyline points="7.5 19.79 7.5 14.6 3 12"></polyline>
                            <polyline points="21 12 16.5 14.6 16.5 19.79"></polyline>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>{{ __('admin/sidebar.dashboard') }}</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('categories') }}"
                   @if(\App\Constants\UrlSegments::CATEGORIES_SEGMENT === request()->segment(1)) data-active="true"
                   @endif aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>{{ __('admin/sidebar.categories') }}</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="{{ route('category-files') }}"
                   @if(\App\Constants\UrlSegments::CATEGORY_FILES_SEGMENT === request()->segment(1)) data-active="true"
                   @endif aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-book-open">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                        <span>{{ __('admin/sidebar.category-files') }}</span>
                    </div>
                </a>
            </li>


            {{--<li class="menu single-menu">
                <a href="#user-home" data-toggle="collapse"
                   @if(\App\Http\Constants\UrlSegment::USER_HOME_SEGMENT_NAME === request()->segment(2)) data-active="true"
                   @endif aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>{{ __('sidebar.user-home.dropdown') }}</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if(\App\Http\Constants\UrlSegment::USER_HOME_SEGMENT_NAME === request()->segment(2)) show @endif"
                    id="user-home" data-parent="#sidebar-accordion">
                    <li @if(\App\Http\Constants\UrlSegment::LANDING_SECTION_SEGMENT_NAME === request()->segment(3)) class="active" @endif>
                        <a href="{{ route('user-home-landing') }}">{{ __('sidebar.user-home.landing-section') }}</a>
                    </li>
                    <li @if(\App\Http\Constants\UrlSegment::USER_COMMENTS_SEGMENT_NAME === request()->segment(3)) class="active" @endif>
                        <a href="{{ route('comments-about-us') }}">{{ __('sidebar.user-home.comments-from-users') }}</a>
                    </li>
                </ul>
            </li>--}}
        </ul>
    </nav>
</div>
