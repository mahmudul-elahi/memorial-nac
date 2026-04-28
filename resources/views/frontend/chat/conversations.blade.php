@extends('frontend.master')

@section('content')
<section id="conversations-page">
    <div class="container py-5">

        <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
            <h3 class="mb-0">Messages</h3>
            <a href="{{ route('friendship.friends') }}" class="btn convos-action-btn">
                <i class="fas fa-user-friends"></i> Friends
            </a>
        </div>

        <div class="convos-layout">

            {{-- Left: Conversations list --}}
            <div class="convos-sidebar" id="convosSidebar">

                {{-- New message: start chat with a friend --}}
                @if($friends->count() > 0)
                <div class="convos-new-msg mb-3">
                    <select id="newChatSelect" class="form-select convos-select" onchange="if(this.value) window.location='/chat/'+this.value">
                        <option value="">+ New Message</option>
                        @foreach($friends as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if($convos->isEmpty())
                    <div class="text-center py-4">
                        <i class="fas fa-comments fa-3x mb-2" style="color:#f0d8dc;"></i>
                        <p class="text-muted" style="font-size:13px;">No conversations yet.<br>Send a message to a friend!</p>
                    </div>
                @else
                    @foreach($convos as $c)
                    <a href="{{ route('chat.index', $c['user']->id) }}" class="convo-item d-flex align-items-center gap-3 text-decoration-none
                        {{ isset($activeUser) && $activeUser->id === $c['user']->id ? 'active' : '' }}">
                        <div class="convo-avatar-wrap">
                            <img src="{{ asset($c['user']->getAvatar()) }}" class="rounded-circle convo-avatar" width="46" height="46" alt="{{ $c['user']->name }}">
                            @if($c['unread'] > 0)
                                <span class="convo-unread-dot"></span>
                            @endif
                        </div>
                        <div class="flex-grow-1 min-w-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="convo-name {{ $c['unread'] > 0 ? 'fw-bold' : '' }}">{{ Str::limit($c['user']->name, 18) }}</span>
                                @if($c['updated_at'])
                                    <span class="convo-time">{{ $c['updated_at']->format('H:i') }}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="convo-preview {{ $c['unread'] > 0 ? 'fw-semibold text-dark' : '' }}">
                                    {{ Str::limit($c['last_msg'], 28) }}
                                </span>
                                @if($c['unread'] > 0)
                                    <span class="convo-badge">{{ $c['unread'] }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                @endif
            </div>

            {{-- Right: Placeholder / select a chat --}}
            <div class="convos-main d-none d-md-flex flex-column align-items-center justify-content-center">
                <i class="fas fa-comment-dots fa-4x mb-3" style="color:#f0d8dc;"></i>
                <h5 class="text-muted">Select a conversation</h5>
                <p class="text-muted" style="font-size:13px;">Pick a friend from the left to start chatting.</p>
            </div>

        </div>

    </div>
</section>

<style>
    #conversations-page { background: #f7f2ee; min-height: 80vh; }

    .convos-action-btn {
        background: #fd8c99; color: #fff; border-radius: 20px;
        padding: 8px 18px; font-size: 13px; font-weight: 500; border: none;
    }
    .convos-action-btn:hover { background: #e07080; color: #fff; }

    .convos-layout {
        display: grid;
        grid-template-columns: 340px 1fr;
        gap: 20px;
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,.07);
        min-height: 60vh;
    }

    .convos-sidebar {
        border-right: 1px solid #f0e8e0;
        overflow-y: auto;
        padding: 16px 0;
    }

    .convos-new-msg { padding: 0 16px; }

    .convos-select {
        border-radius: 20px; border: 1.5px solid #f0d8dc;
        font-size: 13px; color: #fd8c99; font-weight: 500;
    }
    .convos-select:focus { border-color: #fd8c99; box-shadow: none; }

    .convo-item {
        padding: 12px 16px; cursor: pointer; color: #333;
        border-left: 3px solid transparent;
        transition: background .15s;
    }
    .convo-item:hover { background: #fdf5f6; }
    .convo-item.active { background: #fdf5f6; border-left-color: #fd8c99; }

    .convo-avatar-wrap { position: relative; flex-shrink: 0; }
    .convo-avatar { object-fit: cover; border: 2px solid #f0d8dc; }
    .convo-unread-dot {
        position: absolute; bottom: 1px; right: 1px;
        width: 10px; height: 10px; background: #fd8c99;
        border-radius: 50%; border: 2px solid #fff;
    }

    .convo-name { font-size: 14px; color: #252525; }
    .convo-time { font-size: 11px; color: #aaa; white-space: nowrap; }
    .convo-preview { font-size: 12px; color: #999; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 160px; }
    .convo-badge {
        background: #fd8c99; color: #fff; border-radius: 10px;
        font-size: 10px; padding: 1px 6px; flex-shrink: 0;
    }

    .convos-main { background: #fafafa; padding: 40px; }

    @media (max-width: 768px) {
        .convos-layout { grid-template-columns: 1fr; }
    }
</style>
@endsection
