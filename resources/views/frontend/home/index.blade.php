@extends('frontend.master')



@section('content')
    {{--  Anniversaries-Section-Start --}}


    <section id="anniversaries">
        <div class="container">

            @if (session('success'))
                <div id="floating-alert" class="alert alert-success text-dark alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif



            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="anniversaries-text">
                        <h3>They Just Joined Us</h3>
                        <p>Recently added memorials celebrating the lives of beloved pets.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="slick-slider">
                        @foreach ($items as $item)
                            <div class="col-md-4">
                                <div class="anniversarie-card">
                                    <div class="card-image">
                                        <a class="w-100 h-100"
                                            href="{{ route('show.obituary', [$item->id, $item->slug]) }}">
                                            <img src="{{ asset($item->getThumb()) }}" class="h-100 w-100" alt="card-image1">
                                        </a>
                                    </div>
                                    <div class="card-text">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="aminal-name mb-0">{{ Str::limit($item->title, 10) }}</h6>
                                            <p class="aminal-type mb-0">{{ optional($item->category)->name }}</p>
                                        </div>

                                        <div class="date d-flex">
                                            <img style="width: 20px;" src="{{ asset('assets/frontend/images/grave.svg') }}"
                                                alt="">
                                            <span>
                                                {{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}</span>
                                        </div>

                                        <div class="d-grid">
                                            <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}"
                                                class="btn btn-primary" type="button">View Memorial</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Anniversaries-Section-End --}}


    {{-- Trending-Section-Start --}}

    @if ($trending->isNotEmpty())
        <section id="trending">
            <div class="container">

                <div class="row">
                    <div class="col-md-7 mx-auto">
                        <div class="anniversaries-text">
                            <h3><i class="fas fa-fire" style="color:#fd8c99;"></i> Trending</h3>
                            <p>Most loved memorials, ranked by hearts received.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="slick-slider">
                            @foreach ($trending as $item)
                                <div class="col-md-4">
                                    <div class="anniversarie-card">
                                        <div class="card-image">
                                            <a class="w-100 h-100"
                                                href="{{ route('show.obituary', [$item->id, $item->slug]) }}">
                                                <img src="{{ asset($item->getThumb()) }}" class="h-100 w-100"
                                                    alt="card-image">
                                            </a>
                                        </div>
                                        <div class="card-text">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="aminal-name mb-0">{{ Str::limit($item->title, 10) }}</h6>
                                                <span class="trending-likes">
                                                    <i class="fas fa-heart" style="color:#fd8c99;"></i>
                                                    {{ $item->likers_count }}
                                                </span>
                                            </div>

                                            <div class="date d-flex">
                                                <img style="width: 20px;"
                                                    src="{{ asset('assets/frontend/images/grave.svg') }}" alt="">
                                                <span>
                                                    {{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}
                                                </span>
                                            </div>

                                            <div class="d-grid">
                                                <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}"
                                                    class="btn btn-primary" type="button">View Memorial</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </section>
    @endif

    {{-- Trending-Section-End --}}


    {{--  Blogs-Section-Start --}}

    <section id="blogs">
        <div class="container p-md-0 p-4">

            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="blogs-text">
                        <h3>Blogs</h3>
                        <p>Latest Insights, news and stories of pets</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="row gy-4">
                        @foreach ($posts as $post)
                            <div class="col-md-12 col-lg-4">
                                <div class="blogs-card h-100">
                                    <div class="card-image">
                                        <img src="{{ asset($post->getThumbnail()) }}" class="h-100 w-100"
                                            alt="card-image1">
                                    </div>

                                    <div class="card-text">
                                        <div class="date">
                                            <p class="mb-0">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>

                                        <h4>{{ Str::limit($post->title, 25) }}</h4>

                                        <h5> {{ Str::limit($post->description, 70) }}</h5>
                                    </div>
                                    <div class="view-blog">
                                        <a href="{{ route('blog.posts.show', $post->slug) }}">
                                            <i class="fas fa-external-link-alt"></i>
                                            Read more
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Blogs-Section-End --}}


    {{-- Recent-Section-End --}}

    <section id="recent">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mx-auto">
                    <div class="recent-text">
                        <h3>Anniversaries</h3>
                        <p>Remembering our cherished companions who left paw prints on our hearts. Today, we honor their
                            memories
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="slick-slider">
                        @forelse ($anniversaries as $item)
                            <div class="col-md-4">
                                <div class="recent-card">
                                    <div class="card-image">
                                        <a class="w-100 h-100"
                                            href="{{ route('show.obituary', [$item->id, $item->slug]) }}">
                                            <img src="{{ asset($item->getThumb()) }}" class="h-100 w-100"
                                                alt="card-image1">
                                        </a>
                                    </div>
                                    <div class="card-text">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="aminal-name mb-0">{{ Str::limit($item->title, 10) }}</h6>
                                            <p class="aminal-type mb-0">{{ optional($item->category)->name }}</p>
                                        </div>

                                        <div class="date d-flex">
                                            <img style="width: 20px;"
                                                src="{{ asset('assets/frontend/images/grave.svg') }}" alt="">
                                            <span>
                                                {{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}</span>
                                        </div>

                                        <div class="d-grid">
                                            <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}"
                                                class="btn btn-primary" type="button">View Memorial</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No anniversary in this month</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Recent-Section-End --}}

    {{-- Testimonial-Section-Start --}}

    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="text">
                        <h3>Honoring Memories, One Review at a Time</h3>
                        <p>Share your thoughts and read the <span>heartfelt experiences of others.</span></p>
                    </div>

                    <div class="slider-button">
                        <button class="btn" id="prev-btn">
                            <i class="fas fa-angle-left"></i>
                        </button>
                        <button class="btn" id="next-btn">
                            <i class="fas fa-angle-right"></i>
                        </button>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="slider">
                        @forelse($latestComments as $comment)
                            <div class="slider-item">
                                <div class="author d-flex flex-row">
                                    <div class="author-img">
                                        <img class="rounded-circle" src="{{ asset($comment->user->getAvatar()) }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <h5><a href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                                {{ $comment->user->name }}
                                            </a>
                                        </h5>
                                        <p>{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>

                                <div class="message">
                                    <p>{{ Str::limit($comment->content, 85, '...') }}</p>
                                </div>
                            </div>
                        @empty
                            <p>There is nothing to show</p>
                        @endforelse





                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Testimonial-Section-End --}}



    {{-- Testimonial-Section-Start --}}


    <section id="findout">
        <div class="container">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <div class="findout-bg"
                        style=" background: url('{{ asset($pageImage->image_url) }}') no-repeat center/cover;">
                        <div class="row">
                            <div class="col-md-5 ms-auto">
                                <div class="findout">
                                    <h3>You can add your pet’s memorial</h3>
                                    <p>Create an ever lasting tribute for your beloved Pet</p>

                                    <div class="d-grid">
                                        <button class="btn">Find out more <i class="fas fa-star"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- Testimonial-Section-End --}}
