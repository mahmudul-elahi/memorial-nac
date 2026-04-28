@extends('frontend.master')

@section('content')
    <section id="memorial_artical">
        <div class="bg">
            <div class="container">

                <div class="row">
                    <div class="col-md-3">
                        <div class="animal-details">
                            <div class="image">
                                <img src="{{ asset($item->getThumb()) }}" alt="Details">
                            </div>

                            <div class="text">
                                <h3>
                                    <a href="{{ route('profile', [$item->user->id, $item->user->name]) }}"
                                        style="color: inherit; text-decoration: none;">
                                        {{ $item->user->name }}
                                    </a>
                                </h3>
                                <p>{{ $item->category->name }} <span style="font-size: 18px">
                                        @if ($item->details->sex == 'male')
                                            <i class="fas fa-mars" style="color: #ADD8E6"></i>
                                        @else
                                            <i class="fas fa-venus" style="color: #FFB6C1"></i>
                                        @endif
                                    </span>
                                    <span><i class="far fa-eye"></i> {{ $item->views->count() }}</span>
                                </p>

                                <div class="date-section">
                                    <div class="birth d-flex gap-2 align-items-center">
                                        <div class="icon">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div class="date">
                                            <p class="m-0">Date of birth
                                                <span>{{ Carbon\Carbon::create($item->details->birth_date)->format('d M, Y') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="dead d-flex gap-2 align-items-center pt-3">
                                        <div class="icon">
                                            <img style=" width: 20px;" src="{{ asset('assets/frontend/images/grave.svg') }}"
                                                alt="">
                                        </div>
                                        <div class="date">
                                            <p class="m-0">Date of dead
                                                <span>{{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bio">
                                    <h4>{{ $item->title }}’s Bio</h4>
                                    <p>{!! Str::limit(strip_tags($item->description), 100) !!}</p>
                                </div>

                                <div class="social">
                                    <a href="#" style="--icon-color: #3b5998;"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" style="--icon-color: #e4405f;"><i class="fab fa-instagram"></i></a>
                                    <a href="#" style="--icon-color: #1da1f2;"><i class="fab fa-twitter"></i></a>
                                    <a href="#" style="--icon-color: #0077b5;"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" style="--icon-color: #25D366;"><i class="fab fa-whatsapp"></i></a>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="blog-paragraph">
                            <div class="heading2">
                                <h3> {{ $item->title }}’s Story: A Life Filled with Love and Joy </h3>
                            </div>
                            <div class="paragraph">
                                {!! $item->description !!}
                            </div>

                            <div class="like-section mt-3">
                                @auth
                                    <form action="{{ route('store.condolence', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @if (Auth::user()->hasLiked($item))
                                            <button type="submit" class="btn btn-like liked">
                                                <i class="fas fa-heart"></i>
                                                <span>{{ $item->likers()->count() }}</span>
                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-like">
                                                <i class="far fa-heart"></i>
                                                <span>{{ $item->likers()->count() }}</span>
                                            </button>
                                        @endif
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-like">
                                        <i class="far fa-heart"></i>
                                        <span>{{ $item->likers()->count() }}</span>
                                    </a>
                                @endauth
                            </div>
                        </div>

                        @if ($item->images->count() > 2)
                            <div class="blog-images">
                                <div class="blog-images-slider">
                                    @foreach ($item->images as $image)
                                        <div class="blog-images-container">
                                            <img src="{{ asset('img/obituary/' . $item->id . '/' . $image->filename) }}"
                                                alt="Details">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif



                        <div class="row">
                            <div class="col-md-12">
                                <div class="comment">
                                    @auth
                                        <form id="commentForm" action="{{ route('comments.store', $item->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="content" required class="form-control comment-input"
                                                    placeholder="Write your comment here..." id="commentInput">
                                            </div>
                                            <button type="submit" style="background: #fbe8d2;" class="btn btn-sm mt-2">
                                                <i class="fas fa-paper-plane"></i> Send
                                            </button>
                                        </form>
                                    @endauth

                                    @guest
                                        <p>
                                            Create an <a style="color: #fd8c99;" href="{{ route('register') }}">account</a> or
                                            <a style="color: #fd8c99;" href="{{ route('login') }}">login</a> for comment
                                        </p>
                                    @endguest

                                    <div class="user-comment">
                                        <h4>Comment</h4>

                                        <div class="comments">
                                            @forelse($comments as $comment)
                                                <div class="comment-box">
                                                    <div class="comment-user d-flex align-items-center ">
                                                        <div class="author-image me-2">
                                                            <a class="text-dark"
                                                                href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                                                <img src="{{ asset($comment->user->getAvatar()) }}"
                                                                    alt="user"></a>
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
                                                <p>No comments yet.</p>
                                            @endforelse
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
