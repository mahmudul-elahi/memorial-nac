<div class="card border-0 rounded-3">

    <a href="{{ route('blog.posts.show', $post->slug) }}">
        <div class="card-img-top img-responsive img-responsive-16by9 shadow"
            style="background-image: url({{ asset($post->getThumbnail()) }});"></div>
    </a>

    <div class="card-body">
        <h3 class="card-title font-weight-bold text-truncate">
            <a href="{{ route('blog.posts.show', $post->slug) }}" class="text-reset">
                {{ Str::limit($post->title, 30) }}
            </a>
        </h3>

        <div class="card-subtitle">
            <span class="badge bg-cyan-lt">
                {{ $post->created_at->diffForHumans() }}
            </span>
            @if ($post->category)
                <a href="{{ route('blog.categories.show', $post->category->slug) }}" class="badge bg-green-lt">
                    {{ $post->category->name }}
                </a>
            @endif
        </div>


        <cite class="text-muted">
            {{ Str::limit($post->description, 90) }}
        </cite>

    </div>

    <div class="card-footer">
        <div class="d-flex align-items-center">
            <a href="{{ route('blog.posts.show', $post->slug) }}" class="btn btn-pill btn-dark">
                {{ __('Read more') }}
            </a>

            <div class="ms-auto">
                <a href="{{ route('blog.posts.show', $post->slug) }}#comments" class="btn btn-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                        <line x1="12" y1="12" x2="12" y2="12.01" />
                        <line x1="8" y1="12" x2="8" y2="12.01" />
                        <line x1="16" y1="12" x2="16" y2="12.01" />
                    </svg>
                    {{ __('app.count_comment_card', ['count' => $post->comments_count]) }}
                </a>
            </div>

        </div>
    </div>

</div>
