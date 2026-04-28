<header id="header" class="d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex align-items-center gap-3">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img style="height: 21px;" src="{{ asset('assets/frontend/images/logo.png') }}"
                                alt="">
                        </a>
                    </div>

                    <div class="search">
                        <form action="{{ route('search') }}" method="GET">
                            @csrf
                            <input type="text" class="form-control @error('keywords') border border-danger @enderror"
                                name="keywords" placeholder="Search here" />
                            <button type="submit" class="btn btn-primary rounded-circle">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <nav class="navbar navbar-expand-lg navbar-light bg-light navbarTop">
                    <div class="container">
                        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                            <ul class="navbar-nav align-items-center">
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link add-memory" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endguest
                                @auth
                                    {{-- Message icon with dropdown --}}
                                    <li class="nav-item me-2">
                                        <div class="dropdown msg-dropdown">
                                            <button class="msg-icon-btn" type="button" id="msgDropdownBtn"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="far fa-comment-dots"></i>
                                                <span class="msg-badge" id="msgBadge" style="display:none;">0</span>
                                            </button>
                                            <div class="dropdown-menu msg-dropdown-menu p-0" aria-labelledby="msgDropdownBtn">
                                                <div class="msg-dropdown-header px-3 py-2">
                                                    <strong>Messages</strong>
                                                </div>
                                                <div id="msgConvoList">
                                                    <div class="px-3 py-3 text-muted" style="font-size:13px;">Loading…</div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link add-memory" href="{{ route('insert.obituary') }}">
                                            <i class="fas fa-plus"></i>
                                            <span class="ms-1">Add a Memory</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="dropdown authenticated d-flex align-items-center">
                                            <button class="ms-3 authenticated-btn" type="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <img src="{{ asset(Auth::user()->getAvatar()) }}" alt="Profile">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('profile', [Auth::id(), Auth::user()->name]) }}"><i
                                                            class="fas fa-user me-2"></i> Profile</a>
                                                </li>
                                                <li><a class="dropdown-item" href="{{ route('friendship.friends') }}"><i
                                                            class="fas fa-user-friends me-2"></i> Friends</a></li>
                                                <li><a class="dropdown-item" href="{{ route('friendship.requests') }}"><i
                                                            class="fas fa-user-clock me-2"></i> Friend Requests</a></li>
                                                <li><a class="dropdown-item" href="{{ route('chat.conversations.page') }}"><i
                                                            class="fas fa-comments me-2"></i> Messages</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="{{ route('account') }}"><i
                                                            class="fas fa-cog me-2"></i> Account</a></li>
                                                @hasrole('admin')
                                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                                                class="fas fa-user-shield me-2"></i> Administration</a></li>
                                                @endhasrole
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST">
                                                        @csrf
                                                        <button class="dropdown-item" type="submit"><i
                                                                class="fas fa-sign-out-alt me-2"></i> Logout</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

@auth
<style>
.msg-icon-btn {
    position: relative; background: none; border: none; cursor: pointer;
    font-size: 20px; color: #555; padding: 4px 6px; line-height: 1;
}
.msg-icon-btn:hover { color: #fd8c99; }
.msg-badge {
    position: absolute; top: -4px; right: -4px;
    background: #fd8c99; color: #fff;
    font-size: 10px; font-weight: 700;
    border-radius: 50%; width: 17px; height: 17px;
    display: flex !important; align-items: center; justify-content: center;
    line-height: 1;
}
.msg-dropdown-menu {
    min-width: 300px; border-radius: 12px;
    box-shadow: 0 8px 28px rgba(0,0,0,.12); border: none;
}
.msg-dropdown-header {
    border-bottom: 1px solid #f0e8e0; font-size: 14px;
}
.msg-convo-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 14px; text-decoration: none; color: #252525;
    border-bottom: 1px solid #faf6f3; transition: background .15s;
}
.msg-convo-item:hover { background: #fdf6f0; color: #252525; }
.msg-convo-item img { width: 38px; height: 38px; border-radius: 50%; object-fit: cover; flex-shrink: 0; }
.msg-convo-name { font-weight: 600; font-size: 13px; margin-bottom: 2px; }
.msg-convo-preview { font-size: 12px; color: #888; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 190px; }
.msg-convo-unread { background: #fd8c99; color: #fff; border-radius: 50%; min-width: 18px; height: 18px; font-size: 10px; font-weight: 700; display: flex; align-items: center; justify-content: center; margin-left: auto; flex-shrink: 0; }
</style>

<script>
(function () {
    const UNREAD_URL = "{{ route('chat.unread') }}";
    const CONVOS_URL = "{{ route('chat.conversations') }}";
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    function updateBadge() {
        fetch(UNREAD_URL, { headers: { 'X-CSRF-TOKEN': CSRF } })
            .then(r => r.json())
            .then(data => {
                const badge = document.getElementById('msgBadge');
                if (data.count > 0) {
                    badge.textContent = data.count > 99 ? '99+' : data.count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            }).catch(() => {});
    }

    function loadConvos() {
        fetch(CONVOS_URL, { headers: { 'X-CSRF-TOKEN': CSRF } })
            .then(r => r.json())
            .then(convos => {
                const list = document.getElementById('msgConvoList');
                if (!convos.length) {
                    list.innerHTML = '<div class="px-3 py-3 text-muted" style="font-size:13px;">No conversations yet.</div>';
                    return;
                }
                list.innerHTML = convos.map(c => `
                    <a href="/chat/${c.user.id}" class="msg-convo-item">
                        <img src="${c.user.avatar_url || '/img/avatar/no_avatar.jpg'}" alt="">
                        <div style="min-width:0;">
                            <div class="msg-convo-name">${escHtml(c.user.name)}</div>
                            <div class="msg-convo-preview">${escHtml(c.last_msg)}</div>
                        </div>
                        ${c.unread > 0 ? `<span class="msg-convo-unread">${c.unread}</span>` : ''}
                    </a>`).join('');
            }).catch(() => {});
    }

    function escHtml(str) {
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
    }

    updateBadge();
    setInterval(updateBadge, 5000);

    // Allow any page (e.g. chat) to trigger an instant badge refresh
    window.addEventListener('chat:newMessage', updateBadge);

    document.getElementById('msgDropdownBtn')?.addEventListener('click', function () {
        loadConvos();
        updateBadge();
    });
})();
</script>
@endauth
