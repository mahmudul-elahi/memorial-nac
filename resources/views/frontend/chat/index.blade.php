@extends('frontend.master')

@section('content')
    <section id="chat-page">
        <div class="container py-4">
            <div class="chat-wrapper">

                {{-- Header --}}
                <div class="chat-header d-flex align-items-center gap-3">
                    <a href="{{ route('profile', [$otherUser->id, $otherUser->name]) }}"
                        class="d-flex align-items-center gap-2 text-decoration-none">
                        <img src="{{ asset($otherUser->getAvatar()) }}" class="rounded-circle" width="42" height="42"
                            alt="">
                        <span class="chat-username">{{ $otherUser->name }}</span>
                    </a>
                </div>

                {{-- Messages --}}
                <div class="chat-body" id="chatBody">
                    @foreach ($messages as $msg)
                        <div class="chat-bubble-row {{ $msg->sender_id === Auth::id() ? 'mine' : 'theirs' }}"
                            data-id="{{ $msg->id }}">
                            @if ($msg->sender_id !== Auth::id())
                                <img src="{{ asset($msg->sender->getAvatar()) }}" class="bubble-avatar rounded-circle"
                                    width="30" height="30" alt="">
                            @endif
                            <div class="chat-bubble">
                                <p>{{ $msg->body }}</p>
                                <span class="bubble-time">{{ $msg->created_at->format('H:i') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Input --}}
                <div class="chat-footer">
                    <form id="chatForm" class="d-flex gap-2">
                        @csrf
                        <input type="text" id="chatInput" class="form-control chat-input"
                            placeholder="Write a message..." autocomplete="off">
                        <button type="submit" class="btn chat-send-btn">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <style>
        #chat-page {
            background: #f7f2ee;
            min-height: 80vh;
        }

        .chat-wrapper {
            max-width: 750px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .07);
            display: flex;
            flex-direction: column;
            height: 75vh;
        }

        .chat-header {
            padding: 14px 20px;
            border-bottom: 1px solid #f0e8e0;
            background: #fff;
        }

        .chat-username {
            font-weight: 600;
            color: #252525;
            font-size: 15px;
        }

        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .chat-bubble-row {
            display: flex;
            align-items: flex-end;
            gap: 8px;
        }

        .chat-bubble-row.mine {
            flex-direction: row-reverse;
        }

        .bubble-avatar {
            flex-shrink: 0;
        }

        .chat-bubble {
            max-width: 65%;
            padding: 10px 14px;
            border-radius: 18px;
            position: relative;
        }

        .chat-bubble-row.theirs .chat-bubble {
            background: #f0e8e0;
            border-bottom-left-radius: 4px;
        }

        .chat-bubble-row.mine .chat-bubble {
            background: #fd8c99;
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .chat-bubble p {
            margin: 0;
            font-size: 14px;
            line-height: 1.45;
        }

        .bubble-time {
            font-size: 10px;
            opacity: .6;
            display: block;
            margin-top: 4px;
            text-align: right;
        }

        .chat-footer {
            padding: 12px 16px;
            border-top: 1px solid #f0e8e0;
            background: #fff;
        }

        .chat-input {
            border-radius: 24px;
            border: 1.5px solid #f0e8e0;
            padding: 10px 18px;
            font-size: 14px;
        }

        .chat-input:focus {
            border-color: #fd8c99;
            box-shadow: none;
            outline: none;
        }

        .chat-send-btn {
            background: #fd8c99;
            color: #fff;
            border-radius: 50%;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chat-send-btn:hover {
            background: #e07080;
            color: #fff;
        }
    </style>

    @if(config('broadcasting.connections.pusher.key'))
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @endif
    <script>
        const ME = {{ Auth::id() }};
        const OTHER = {{ $otherUser->id }};
        const SEND_URL = "{{ route('chat.store', $otherUser->id) }}";
        const POLL_URL = "{{ route('chat.poll', $otherUser->id) }}";
        const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const CHANNEL = "{{ $channelName }}";
        const PUSHER_KEY = "{{ config('broadcasting.connections.pusher.key') }}";
        const PUSHER_CLUSTER = "{{ config('broadcasting.connections.pusher.options.cluster', 'mt1') }}";

        // Track the highest message id rendered so far for polling
        let lastMsgId = 0;
        document.querySelectorAll('.chat-bubble-row[data-id]').forEach(function(el) {
            const id = parseInt(el.dataset.id);
            if (id > lastMsgId) lastMsgId = id;
        });

        function scrollBottom() {
            const body = document.getElementById('chatBody');
            body.scrollTop = body.scrollHeight;
        }
        scrollBottom();

        function appendBubble(msg, mine) {
            // Avoid duplicate renders
            if (document.querySelector('[data-id="' + msg.id + '"]')) return;
            if (msg.id > lastMsgId) lastMsgId = msg.id;
            if (!mine) window.dispatchEvent(new Event('chat:newMessage'));

            const row = document.createElement('div');
            row.className = 'chat-bubble-row ' + (mine ? 'mine' : 'theirs');
            row.dataset.id = msg.id;

            let avatarHtml = '';
            if (!mine) {
                avatarHtml = `<img src="${msg.sender.avatar}" class="bubble-avatar rounded-circle" width="30" height="30" alt="">`;
            }

            row.innerHTML = `${avatarHtml}
            <div class="chat-bubble">
                <p>${escHtml(msg.body)}</p>
                <span class="bubble-time">${msg.created_at}</span>
            </div>`;
            document.getElementById('chatBody').appendChild(row);
            scrollBottom();
        }

        function escHtml(str) {
            return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
        }

        // Send message
        document.getElementById('chatForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const input = document.getElementById('chatInput');
            const body = input.value.trim();
            if (!body) return;
            input.value = '';

            fetch(SEND_URL, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
                body: JSON.stringify({ body })
            })
            .then(r => r.json())
            .then(msg => appendBubble(msg, true))
            .catch(() => {});
        });

        // Pusher real-time (when credentials are configured)
        let pusherConnected = false;
        if (PUSHER_KEY) {
            try {
                const pusher = new Pusher(PUSHER_KEY, {
                    cluster: PUSHER_CLUSTER,
                    forceTLS: true,
                    authEndpoint: '/broadcasting/auth',
                    auth: { headers: { 'X-CSRF-TOKEN': CSRF } }
                });
                const channel = pusher.subscribe('private-' + CHANNEL);

                pusher.connection.bind('connected', function() { pusherConnected = true; });
                pusher.connection.bind('error', function() { pusherConnected = false; });

                channel.bind('App\\Events\\MessageSent', function(data) {
                    if (data.sender_id !== ME) appendBubble(data, false);
                });
            } catch(e) { pusherConnected = false; }
        }

        // Polling fallback — runs every 3 s when Pusher is not connected
        function poll() {
            if (pusherConnected) return;
            fetch(POLL_URL + '?after=' + lastMsgId, { headers: { 'X-CSRF-TOKEN': CSRF } })
                .then(r => r.json())
                .then(msgs => msgs.forEach(m => {
                    if (m.sender_id !== ME) appendBubble(m, false);
                    else if (m.id > lastMsgId) lastMsgId = m.id;
                }))
                .catch(() => {});
        }
        setInterval(poll, 3000);
    </script>
@endsection
