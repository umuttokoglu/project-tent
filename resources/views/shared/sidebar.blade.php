<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories ps" id="sidebar-accordion">
            <li class="menu">
                <a href="{{ route('dashboard') }}"
                   @if(\App\Constants\UrlSegments::DASHBOARD_SEGMENT === request()->segment(1)) data-active="true"
                   @endif aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-layers">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-layers">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span>{{ __('admin/sidebar.categories') }}</span>
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
