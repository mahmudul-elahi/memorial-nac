<nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none mobileNavbar">
    <div class="container">
        <div class="position-relative">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNavbar"
                aria-controls="mobileNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand ms-3" href="{{ route('index') }}">
                <img style="height: 20px;" src="{{ asset('assets/frontend/images/logo.png') }}" alt="">
            </a>

            <div class="collapse navbar-collapse" id="mobileNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}"><img
                                src="{{ asset('assets/frontend/images/hero/home.png') }}"
                                style="width: 18px; margin-right: 2px;" alt="icon"> Home</a>
                    </li>
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category', [$category->id, $category->slug]) }}"><img
                                    src="{{ asset('assets/frontend/images/hero/pet.png') }}"
                                    style="width: 18px; margin-right: 2px;" alt="icon">
                                {{ Str::before($category->name, ' ') }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.posts.view') }}"><img
                                src="{{ asset('assets/frontend/images/hero/blog-text.png') }}"
                                style="width: 18px; opacity: .6; margin-right: 2px;" alt="icon"> Blogs</a>
                    </li>
                </ul>
            </div>
        </div>

        @guest
            <div class="d-flex ms-auto button-container">
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm me-2 active">Register</a>
            </div>
        @endguest

        @auth
            <div class="d-flex ms-auto button-container-bottom align-items-center gap-2">
                <div class="d-flex align-items-center gap-2">

                    {{-- Message icon with unread badge --}}
                    <div class="dropdown msg-dropdown">
                        <button class="msg-icon-btn" type="button" id="msgDropdownBtnMobile"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="far fa-comment-dots"></i>
                            <span class="msg-badge" id="msgBadgeMobile" style="display:none;">0</span>
                        </button>
                        <div class="dropdown-menu msg-dropdown-menu p-0 dropdown-menu-end" aria-labelledby="msgDropdownBtnMobile">
                            <div class="msg-dropdown-header px-3 py-2">
                                <strong>Messages</strong>
                            </div>
                            <div id="msgConvoListMobile">
                                <div class="px-3 py-3 text-muted" style="font-size:13px;">Loading…</div>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown authenticated d-flex align-items-center">
                        <button class="ms-1 authenticated-btn" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset(Auth::user()->getAvatar()) }}" alt="Profile">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile', [Auth::id(), Auth::user()->name]) }}"><i
                                        class="fas fa-user me-2"></i> Profile</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('friendship.friends') }}"><i
                                        class="fas fa-user-friends me-2"></i> Friends</a></li>
                            <li><a class="dropdown-item" href="{{ route('friendship.requests') }}"><i
                                        class="fas fa-user-clock me-2"></i> Friend Requests</a></li>
                            <li><a class="dropdown-item" href="{{ route('chat.conversations.page') }}"><i
                                        class="fas fa-comments me-2"></i> Messages</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('account') }}"><i class="fas fa-cog me-2"></i>
                                    Account</a></li>
                            @hasrole('admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                            class="fas fa-user-shield me-2"></i>
                                        Administration</a></li>
                            @endhasrole
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt me-2"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endauth

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
        .msg-dropdown-header { border-bottom: 1px solid #f0e8e0; font-size: 14px; }
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
        document.addEventListener('DOMContentLoaded', function () {
            const UNREAD_URL = "{{ route('chat.unread') }}";
            const CONVOS_URL = "{{ route('chat.conversations') }}";
            const CONVOS_PAGE = "{{ route('chat.conversations.page') }}";
            const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            function escHtml(str) {
                return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
            }

            function updateMobileBadge() {
                fetch(UNREAD_URL, { headers: { 'X-CSRF-TOKEN': CSRF } })
                    .then(r => r.json())
                    .then(data => {
                        const badge = document.getElementById('msgBadgeMobile');
                        if (!badge) return;
                        if (data.count > 0) {
                            badge.textContent = data.count > 99 ? '99+' : data.count;
                            badge.style.display = 'flex';
                        } else {
                            badge.style.display = 'none';
                        }
                    }).catch(() => {});
            }

            function loadMobileConvos() {
                const list = document.getElementById('msgConvoListMobile');
                if (!list) return;
                list.innerHTML = '<div class="px-3 py-3 text-muted" style="font-size:13px;">Loading…</div>';

                fetch(CONVOS_URL, { headers: { 'X-CSRF-TOKEN': CSRF } })
                    .then(r => {
                        if (!r.ok) throw new Error('HTTP ' + r.status);
                        return r.json();
                    })
                    .then(convos => {
                        if (!Array.isArray(convos) || convos.length === 0) {
                            list.innerHTML = '<div class="px-3 py-3 text-muted" style="font-size:13px;">No conversations yet.</div>';
                            return;
                        }
                        list.innerHTML = convos.map(c => `
                            <div class="msg-convo-item" onclick="window.location.href='/chat/${c.user.id}'" style="cursor:pointer;">
                                <img src="${c.user.avatar_url || '/img/avatar/no_avatar.jpg'}" alt="${escHtml(c.user.name)}">
                                <div style="min-width:0;flex:1;">
                                    <div class="msg-convo-name">${escHtml(c.user.name)}</div>
                                    <div class="msg-convo-preview">${escHtml(c.last_msg || '')}</div>
                                </div>
                                ${c.unread > 0 ? `<span class="msg-convo-unread">${c.unread}</span>` : ''}
                            </div>`).join('')
                            + `<div onclick="window.location.href='${CONVOS_PAGE}'" class="d-block text-center py-2" style="font-size:12px;color:#fd8c99;border-top:1px solid #f0e8e0;cursor:pointer;">See all messages</div>`;
                    })
                    .catch(() => {
                        if (list) list.innerHTML = '<div class="px-3 py-3 text-muted" style="font-size:13px;">Could not load messages.</div>';
                    });
            }

            // Use Bootstrap's dropdown show event for reliable triggering
            const msgDropdown = document.querySelector('#msgDropdownBtnMobile')?.closest('.dropdown');
            if (msgDropdown) {
                msgDropdown.addEventListener('show.bs.dropdown', function () {
                    loadMobileConvos();
                    updateMobileBadge();
                });
            }

            updateMobileBadge();
            setInterval(updateMobileBadge, 5000);
            window.addEventListener('chat:newMessage', updateMobileBadge);
        });
        </script>
        @endauth
    </div>
</nav>
