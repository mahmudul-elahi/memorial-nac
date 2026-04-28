@extends('frontend.master')

@section('content')
<section id="requests-page">
    <div class="container py-5">

        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <h3 class="mb-0">Friend Requests</h3>
            <a href="{{ route('friendship.friends') }}" class="btn friends-action-btn">
                <i class="fas fa-user-friends"></i> My Friends
            </a>
        </div>

        {{-- Tabs --}}
        <ul class="nav req-tabs mb-4" id="reqTabs">
            <li class="nav-item">
                <button class="req-tab active" data-target="received">
                    Received
                    @if($received->count() > 0)
                        <span class="req-badge">{{ $received->count() }}</span>
                    @endif
                </button>
            </li>
            <li class="nav-item">
                <button class="req-tab" data-target="sent">
                    Sent
                    @if($sent->count() > 0)
                        <span class="req-badge sent-badge">{{ $sent->count() }}</span>
                    @endif
                </button>
            </li>
        </ul>

        {{-- Received Requests --}}
        <div id="tab-received" class="req-tab-panel">
            @if($received->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x mb-3" style="color:#f0d8dc;"></i>
                    <p class="text-muted">No pending friend requests</p>
                </div>
            @else
                <div class="row">
                    @foreach($received as $req)
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="req-card d-flex align-items-center gap-3 p-3">
                            <a href="{{ route('profile', [$req->sender->id, $req->sender->name]) }}">
                                <img src="{{ asset($req->sender->getAvatar()) }}" class="rounded-circle req-avatar" width="56" height="56" alt="{{ $req->sender->name }}">
                            </a>
                            <div class="flex-grow-1 min-w-0">
                                <a href="{{ route('profile', [$req->sender->id, $req->sender->name]) }}" class="text-decoration-none">
                                    <p class="req-name mb-1">{{ $req->sender->name }}</p>
                                </a>
                                <p class="req-time mb-2">{{ $req->created_at->diffForHumans() }}</p>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('friendship.accept', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm req-accept-btn">
                                            <i class="fas fa-check"></i> Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('friendship.decline', $req->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm req-decline-btn">
                                            <i class="fas fa-times"></i> Decline
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Sent Requests --}}
        <div id="tab-sent" class="req-tab-panel" style="display:none;">
            @if($sent->isEmpty())
                <div class="text-center py-5">
                    <i class="fas fa-paper-plane fa-3x mb-3" style="color:#f0d8dc;"></i>
                    <p class="text-muted">No pending sent requests</p>
                </div>
            @else
                <div class="row">
                    @foreach($sent as $req)
                    <div class="col-12 col-md-6 col-lg-4 mb-3">
                        <div class="req-card d-flex align-items-center gap-3 p-3">
                            <a href="{{ route('profile', [$req->receiver->id, $req->receiver->name]) }}">
                                <img src="{{ asset($req->receiver->getAvatar()) }}" class="rounded-circle req-avatar" width="56" height="56" alt="{{ $req->receiver->name }}">
                            </a>
                            <div class="flex-grow-1 min-w-0">
                                <a href="{{ route('profile', [$req->receiver->id, $req->receiver->name]) }}" class="text-decoration-none">
                                    <p class="req-name mb-1">{{ $req->receiver->name }}</p>
                                </a>
                                <p class="req-time mb-2">Sent {{ $req->created_at->diffForHumans() }}</p>
                                <form action="{{ route('friendship.cancel', $req->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm req-cancel-btn">
                                        <i class="fas fa-times"></i> Cancel Request
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</section>

<style>
    #requests-page { background: #f7f2ee; min-height: 80vh; }

    .friends-action-btn {
        background: #fd8c99; color: #fff; border-radius: 20px;
        padding: 8px 18px; font-size: 13px; font-weight: 500; border: none;
    }
    .friends-action-btn:hover { background: #e07080; color: #fff; }

    .req-tabs { gap: 8px; border-bottom: 2px solid #f0d8dc; }

    .req-tab {
        background: none; border: none; padding: 10px 24px;
        font-size: 14px; font-weight: 500; color: #888;
        border-bottom: 3px solid transparent; margin-bottom: -2px;
        cursor: pointer; border-radius: 0;
        transition: color .2s;
    }
    .req-tab.active { color: #fd8c99; border-bottom-color: #fd8c99; }
    .req-tab:hover { color: #fd8c99; }

    .req-badge {
        background: #fd8c99; color: #fff; border-radius: 10px;
        font-size: 11px; padding: 1px 7px; margin-left: 5px;
    }
    .sent-badge { background: #aaa; }

    .req-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 10px rgba(0,0,0,.06);
    }

    .req-avatar { object-fit: cover; border: 2px solid #f0d8dc; flex-shrink: 0; }

    .req-name { font-weight: 600; color: #333; font-size: 14px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .req-time { font-size: 12px; color: #aaa; }

    .req-accept-btn {
        background: #fd8c99; color: #fff; border-radius: 12px;
        font-size: 12px; border: none; padding: 4px 12px;
    }
    .req-accept-btn:hover { background: #e07080; color: #fff; }

    .req-decline-btn, .req-cancel-btn {
        background: #f0e8e0; color: #666; border-radius: 12px;
        font-size: 12px; border: none; padding: 4px 12px;
    }
    .req-decline-btn:hover, .req-cancel-btn:hover { background: #e0d0c8; color: #333; }
</style>

<script>
    document.querySelectorAll('.req-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.req-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.req-tab-panel').forEach(p => p.style.display = 'none');
            this.classList.add('active');
            document.getElementById('tab-' + this.dataset.target).style.display = '';
        });
    });
</script>
@endsection
