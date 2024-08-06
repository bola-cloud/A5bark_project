<div class="text-center">
    @if($news->isNotEmpty())
        <h4>@lang('front.news')</h4>
        <ul class="list-unstyled">
            @foreach($news as $newsItem)
                <li class="search-result-item">
                    <a href="{{ route('news_details', $newsItem->id) }}">
                        {{ app()->getLocale() === 'ar' ? $newsItem->ar_title : $newsItem->en_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($festivals->isNotEmpty())
        <h4>@lang('front.festivals')</h4>
        <ul class="list-unstyled">
            @foreach($festivals as $festival)
                <li class="search-result-item">
                    <a href="{{ route('festival') }}">
                        {{ app()->getLocale() === 'ar' ? $festival->ar_title : $festival->en_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($events->isNotEmpty())
        <h4>@lang('front.events')</h4>
        <ul class="list-unstyled">
            @foreach($events as $event)
                <li class="search-result-item">
                    <a href="{{ route('event_details', $event->id) }}">
                        {{ app()->getLocale() === 'ar' ? $event->ar_title : $event->en_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($playlists->isNotEmpty())
        <h4>@lang('front.playlists')</h4>
        <ul class="list-unstyled">
            @foreach($playlists as $playlist)
                <li class="search-result-item">
                    <a href="{{ route('podcast') }}">
                        {{ app()->getLocale() === 'ar' ? $playlist->ar_title : $playlist->en_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($episodes->isNotEmpty())
        <h4>@lang('front.episodes')</h4>
        <ul class="list-unstyled">
            @foreach($episodes as $episode)
                <li class="search-result-item">
                    <a href="{{ route('episodes', $episode->id) }}">
                        {{ app()->getLocale() === 'ar' ? $episode->ar_title : $episode->en_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($advertisements->isNotEmpty())
        <h4>@lang('front.advertisements')</h4>
        <ul class="list-unstyled">
            @foreach($advertisements as $advertisement)
                <li class="search-result-item">
                    <a href="{{ route('adverticement') }}">
                        {{ app()->getLocale() === 'ar' ? $advertisement->ar_title : $advertisement->en_title }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    @if($branches->isNotEmpty())
        <h4>@lang('front.branches')</h4>
        <ul class="list-unstyled">
            @foreach($branches as $branch)
                <li class="search-result-item">
                    <a href="{{ route('branch_details', $branch->id) }}">
                        {{ app()->getLocale() === 'ar' ? $branch->ar_name : $branch->en_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
