<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        @php 
            $user_category = auth()->user()->category;  
        @endphp

        @if( $user_category == 'admin' 
            || auth()->user()->isAbleTo('dashboard_*') 
            || auth()->user()->isAbleTo('users_*')
            || auth()->user()->isAbleTo('roles_*') 
            || auth()->user()->isAbleTo('students_*') 
        ) 
        <ul class="nav flex-column">

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'admin') ? 'active' : ''}}" aria-current="page" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.Dashboard')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'motion') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.motion.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.motion')</span>
                </a>
            </li>
            @endif
            
            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'adverticement') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.adverticement.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.adverticement')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'news_category') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.news_category.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.News_category')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'news') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.news.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.News')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'podcast') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.podcast.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.Podcast')</span>
                </a>
            </li>
            @endif
            
            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'playlist') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.playlist.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.playlist')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'episodes') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.episodes.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.episodes')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'festival') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.festival.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.festival')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'event') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.event.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.event')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'branch') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.branch.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.branches')</span>
                </a>
            </li>
            @endif

            @if( $user_category == 'admin' || auth()->user()->isAbleTo('dashboard_*') )
            <li class="nav-item">
                <a class="nav-link {{ str_ends_with(Request::path(), 'places') ? 'active' : ''}}" aria-current="page2" href="{{ route('admin.places.index') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="mx-1">@lang('layouts.places')</span>
                </a>
            </li>
            @endif           

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                </a>
            </li>
        </ul>
        @endif
        
    </div>
</nav>