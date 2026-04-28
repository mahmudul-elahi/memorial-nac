@extends('frontend.master')

@section('content')
<section id="friends-page">
    <div class="container py-5">

        <div class="friends-header d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <h3 class="mb-0">My Friends <span class="friends-count">({{ $friends->count() }})</span></h3>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('friendship.requests') }}" class="btn friends-action-btn">
                    <i class="fas fa-user-clock"></i> Friend Requests
                </a>
                <a href="{{ route('chat.conversations.page') }}" class="btn friends-action-btn">
                    <i class="fas fa-comments"></i> Messages
                </a>
            </div>
        </div>

        {{-- Search --}}
        <div class="mb-4">
            <input type="text" id="friendSearch" class="form-control friends-search" placeholder="Search friends...">
        </div>

        @if($friends->isEmpty())
            <div class="friends-empty text-center py-5">
                <i class="fas fa-user-friends fa-4x mb-3" style="color:#f0d8dc;"></i>
                <h5 class="text-muted">You have no friends yet</h5>
                <p class="text-muted">Start connecting by visiting profiles and sending friend requests.</p>
            </div>
        @else
            <div class="row" id="friendsList">
                @foreach($friends as $friend)
                <div class="col-6 col-md-3 col-lg-2 mb-4 friend-item">
                    <div class="friend-card-full text-center p-3">
                        <a href="{{ route('profile', [$friend->id, $friend->name]) }}">
                            <img src="{{ asset($friend->getAvatar()) }}" class="rounded-circle mb-2 friend-avatar-lg" width="80" height="80" alt="{{ $friend->name }}">
                        </a>
                        <p class="friend-name-full mb-2">{{ Str::limit($friend->name, 16) }}</p>
                        <div class="d-flex flex-column gap-1">
                            <a href="{{ route('chat.index', $friend->id) }}" class="btn btn-sm friends-msg-btn">
                                <i class="fas fa-comment"></i> Message
                            </a>
                            <a href="{{ route('profile', [$friend->id, $friend->name]) }}" class="btn btn-sm friends-profile-btn">
                                <i class="fas fa-user"></i> Profile
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</section>

<style>
    #friends-page { background: #f7f2ee; min-height: 80vh; }

    .friends-count { font-size: 18px; color: #aaa; font-weight: 400; }

    .friends-action-btn {
        background: #fd8c99; color: #fff; border-radius: 20px;
        padding: 8px 18px; font-size: 13px; font-weight: 500;
        border: none;
    }
    .friends-action-btn:hover { background: #e07080; color: #fff; }

    .friends-search {
        border-radius: 24px; border: 1.5px solid #f0d8dc;
        padding: 10px 20px; font-size: 14px; max-width: 400px;
    }
    .friends-search:focus { border-color: #fd8c99; box-shadow: none; }

    .friends-empty i { display: block; }

    .friend-card-full {
        background: #fff; border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,.06);
        transition: transform .2s;
    }
    .friend-card-full:hover { transform: translateY(-3px); }

    .friend-avatar-lg { object-fit: cover; border: 3px solid #f0d8dc; }

    .friend-name-full {
        font-size: 13px; font-weight: 600; color: #333;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .friends-msg-btn {
        background: #fd8c99; color: #fff; border-radius: 14px;
        font-size: 12px; border: none;
    }
    .friends-msg-btn:hover { background: #e07080; color: #fff; }

    .friends-profile-btn {
        background: #f0e8e0; color: #555; border-radius: 14px;
        font-size: 12px; border: none;
    }
    .friends-profile-btn:hover { background: #e0d0c8; color: #333; }
</style>

<script>
    document.getElementById('friendSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.friend-item').forEach(function (item) {
            const name = item.querySelector('.friend-name-full').textContent.toLowerCase();
            item.style.display = name.includes(q) ? '' : 'none';
        });
    });
</script>
@endsection
