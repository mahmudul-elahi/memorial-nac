<!-- Banner -->
<div class="mb-3">
    <div class="ratio ratio-1x1">
        <div class="skeleton-image"></div>
    </div>
    <small class="text-muted">{{ __('sponsorship') }}</small>
</div>

<!-- Latest comments -->
<div class="card mb-3">
    <div class="card-header">
        <h2 class="card-title">
            {{ __('app.latest_comments') }}
        </h2>
    </div>
    <div class="card-body">
        <div class="divide-y">
            @forelse($latestComments as $comment)
                <div class="row">
                    <div class="col-auto">
                        <span class="avatar avatar-rounded"
                            style="background-image: url({{ asset($comment->user->getAvatar()) }})"></span>
                    </div>
                    <div class="col">
                        <div>
                            <a href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                <strong>{{ $comment->user->name }}</strong>
                            </a>
                            <cite>{{ Str::limit($comment->content, 85, '...') }}</cite> <a
                                href="{{ route('show.obituary', [$comment->item->id, $comment->item->slug]) }}"
                                class="font-weight-bold">{{ $comment->item->title }}</a>
                        </div>
                        <div class="small text-muted mt-1">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @empty
                {{ __('app.no_results') }}
            @endforelse
        </div>
    </div>
</div>

<!-- Latest activities -->
<div class="card border-0">
    <div class="card-header">
        <h2 class="card-title">
            {{ __('app.latest_activities') }}
        </h2>
    </div>
    <div class="card-body">
        <ul class="list list-timeline list-timeline-simple text-truncate">
            @foreach ($condolences as $condolence)
                <li>
                    <div class="list-timeline-icon bg-pink-lt">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled text-green" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 15h10v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2v-4z" />
                            <path d="M12 9a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3" />
                            <path d="M12 11a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3" />
                            <line x1="12" y1="15" x2="12" y2="9" />
                        </svg>
                    </div>
                    <div class="list-timeline-content">
                        <div class="list-timeline-time">{{ $condolence->created_at->diffForHumans() }}</div>
                        <p class="list-timeline-title">{{ $condolence->user->name }}</p>
                        <small class="text-muted">to <a
                                href="{{ route('show.obituary', [$condolence->item->id, $condolence->item->slug]) }}">{{ $condolence->item->title }}</a></small>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
