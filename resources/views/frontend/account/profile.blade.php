@extends('frontend.master')

@section('content')
    <section id="profile">
        <div class="bg">
            <div class="container">

                <div class="row">

                    <div class="col-md-4">
                        <div class="card p-3">

                            <div class="d-flex align-items-center gap-2">

                                <div class="image">
                                    <img src="{{ $user->avatar_url }}" class="rounded" width="100" height="100" style="object-fit:cover;">
                                </div>

                                <div class="ml-3 w-100">

                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <h4 class="mb-0 mt-0">{{ $user->name }}</h4>

                                        @auth
                                            @if (Auth::id() !== $user->id)

                                                {{-- Friend button --}}
                                                @if (!$friendship)
                                                    <form action="{{ route('friendship.send', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn profile-friend-btn" type="submit">
                                                            <i class="fas fa-user-plus"></i> Add Friend
                                                        </button>
                                                    </form>

                                                @elseif ($friendship->status === 'pending' && $friendship->sender_id === Auth::id())
                                                    <form action="{{ route('friendship.cancel', $friendship->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn profile-friend-btn pending" type="submit">
                                                            <i class="fas fa-clock"></i> Pending
                                                        </button>
                                                    </form>

                                                @elseif ($friendship->status === 'pending' && $friendship->receiver_id === Auth::id())
                                                    <form action="{{ route('friendship.accept', $friendship->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn profile-friend-btn accept" type="submit">
                                                            <i class="fas fa-check"></i> Accept
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('friendship.decline', $friendship->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn profile-friend-btn decline" type="submit">
                                                            <i class="fas fa-times"></i> Decline
                                                        </button>
                                                    </form>

                                                @elseif ($friendship->status === 'accepted')
                                                    <span class="profile-friend-btn friends">
                                                        <i class="fas fa-user-check"></i> Friends
                                                    </span>
                                                    <a href="{{ route('chat.index', $user->id) }}" class="btn profile-friend-btn message">
                                                        <i class="fas fa-comment"></i> Message
                                                    </a>
                                                    <form action="{{ route('friendship.cancel', $friendship->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn profile-friend-btn decline" type="submit">
                                                            <i class="fas fa-user-minus"></i>
                                                        </button>
                                                    </form>

                                                @elseif ($friendship->status === 'declined')
                                                    <form action="{{ route('friendship.send', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button class="btn profile-friend-btn" type="submit">
                                                            <i class="fas fa-user-plus"></i> Add Friend
                                                        </button>
                                                    </form>
                                                @endif

                                            @endif
                                        @endauth
                                    </div>

                                    <div
                                        class="p-2 mt-2 bg-primary d-flex justify-content-around  rounded text-white stats">

                                        <div class="d-flex flex-column">

                                            <span class="followers">Comments</span>
                                            <span class="number2">{{ $user->comments->count() }}</span>

                                        </div>

                                        <div class="d-flex flex-column">

                                            <span class="rating">Friends</span>
                                            <span class="number3">{{ $user->friendsCount() }}</span>

                                        </div>

                                        <div class="d-flex flex-column">

                                            <span class="rating">Obituaries</span>
                                            <span class="number3">{{ $user->items->count() }}</span>

                                        </div>

                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>

                </div>
                <hr>

                {{-- Friends Section --}}
                @if($friends->count() > 0)
                <div class="row pt-4">
                    <div class="col-md-12 d-flex align-items-center justify-content-between mb-3">
                        <h4 class="mb-0">Friends <span class="profile-friend-count">({{ $friends->count() }})</span></h4>
                        @auth
                            @if(Auth::id() === $user->id)
                                <a href="{{ route('friendship.friends') }}" class="btn profile-friend-btn" style="font-size:13px;">See All Friends</a>
                            @endif
                        @endauth
                    </div>
                    @foreach($friends->take(6) as $friend)
                    <div class="col-6 col-md-2 mb-3">
                        <div class="friend-card text-center p-2">
                            <a href="{{ route('profile', [$friend->id, $friend->name]) }}" class="text-decoration-none text-dark">
                                <img src="{{ asset($friend->getAvatar()) }}" class="rounded friend-avatar mb-2" width="70" height="70" alt="{{ $friend->name }}">
                                <p class="mb-1 friend-name">{{ Str::limit($friend->name, 14) }}</p>
                            </a>
                            @auth
                                @php $myFriendship = Auth::user()->friendshipWith($friend->id); @endphp
                                @if($myFriendship && $myFriendship->status === 'accepted')
                                    <a href="{{ route('chat.index', $friend->id) }}" class="btn btn-sm profile-friend-btn message w-100" style="font-size:11px; padding:3px 6px;">
                                        <i class="fas fa-comment"></i> Message
                                    </a>
                                @elseif(Auth::id() === $friend->id)
                                    {{-- own card, no button --}}
                                @elseif(!$myFriendship)
                                    <form action="{{ route('friendship.send', $friend->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-sm profile-friend-btn w-100" style="font-size:11px; padding:3px 6px;">
                                            <i class="fas fa-user-plus"></i> Add
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    @endforeach
                </div>
                <hr>
                @endif

                <div class="row pt-4">
                    <div class="col-md-12">
                        <h4 class="pb-3">Latest Posts of {{ $user->name }}</h4>
                    </div>
                    @forelse($user->items as $item)
                        <div class="col-md-4">
                            <div class="memorial-post-card">
                                <div class="card-image">
                                    <img src="{{ asset($item->getThumb()) }}" class="img-fluid" alt="card-image1">
                                </div>
                                <div class="card-text">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="aminal-name mb-0">{{ Str::limit($item->title, 10) }}</h6>
                                        <p class="aminal-type mb-0">{{ optional($item->category)->name }}</p>
                                    </div>

                                    <div class="date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>
                                            {{ Carbon\Carbon::create($item->details->birth_date)->format('d M, Y') }}</span>
                                    </div>

                                    <div class="d-grid">
                                        <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}"
                                            class="btn btn-primary" type="button">View Memorial</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>This user has no posts</p>
                    @endforelse




                </div>

                <div class="row pt-4">
                    <div class="col-md-12">
                        <div class="comment">

                            <div class="user-comment">
                                <h4>Latest Comment</h4>

                                <div class="comments">
                                    @forelse($user->comments->take(10) as $comment)
                                        <div class="comment-box">
                                            <div class="comment-user d-flex align-items-center ">
                                                <div class="author-image me-2">
                                                    <img src="{{ asset($comment->user->getAvatar()) }}" alt="user">
                                                </div>
                                                <div class="author">
                                                    <p class="m-0"> <a class="text-dark"
                                                            href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                                            {{ $comment->user->name }}</a>
                                                        <span class="m-0">
                                                            {{ $comment->created_at->diffForHumans() }}</span>
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="comment-message">
                                                <p> {{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    @empty
                                        <p>This user has no comment</p>
                                    @endforelse

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<style>
    .profile-friend-count { font-size: 16px; color: #aaa; font-weight: 400; }

    .friend-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
        transition: transform .2s;
    }
    .friend-card:hover { transform: translateY(-3px); }

    .friend-avatar { object-fit: cover; border: 2px solid #f0d8dc; }

    .friend-name {
        font-size: 12px; font-weight: 600; color: #333;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .profile-friend-btn.message {
        background: #fd8c99; color: #fff; border: none;
        border-radius: 14px; font-size: 11px; padding: 3px 8px;
    }
    .profile-friend-btn.message:hover { background: #e07080; color: #fff; }
</style>
@endsection
