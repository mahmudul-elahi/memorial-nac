@extends('frontend.master')

@section('content')
    <section id="blog_artical">
        <div class="bg">
            <div class="container">

                <div class="heading">
                    <div class="row">
                        <div class="col-md-2 d-none d-lg-block">
                            <div class="back_button">
                                <a href="{{ route('blog.posts.view') }}"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="blog-heading">
                                <h3>{{ $post->title }}</h3>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-9">
                        <div class="blog-paragraph">
                            <div class="heading2">
                                <h3>{{ $post->description }}</h3>
                            </div>
                            <div class="paragraph">
                                {!! $post->body !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="comment">
                                    @auth
                                        <form id="commentForm" action="{{ route('blog.comments.store', $post->slug) }}"
                                            method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="comment" required class="form-control comment-input"
                                                    placeholder="Write your comment here..." id="commentInput">
                                            </div>

                                            <button type="submit" style="background: #fbe8d2;" class="btn btn-sm mt-2">
                                                <i class="fas fa-paper-plane"></i> Send
                                            </button>
                                        </form>
                                    @endauth

                                    @guest
                                        <p>
                                            Create an <a href="{{ route('register') }}">account</a> or <a
                                                href="{{ route('login') }}">login</a> for comment
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
                                                                href="{{ route('profile', [$comment->commentedBy->id, $comment->commentedBy->name]) }}">
                                                                <img src="{{ asset($comment->commentedBy->getAvatar()) }}"
                                                                    alt="user"></a>
                                                        </div>
                                                        <div class="author">
                                                            <p class="m-0">
                                                                <a class="text-dark"
                                                                    href="{{ route('profile', [$comment->commentedBy->id, $comment->commentedBy->name]) }}">
                                                                    {{ $comment->commentedBy->name }}</a>

                                                                <span
                                                                    class="m-0">{{ $comment->created_at->diffForHumans() }}</span>
                                                            </p>

                                                        </div>
                                                    </div>
                                                    <div class="comment-message">
                                                        <p>{{ $comment->comment }}</p>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                    <div class="col-md-3 d-none d-lg-block">
                        <div class="category">
                            <h3>Categories</h3>
                            <ul>
                                @foreach ($blogCategories as $category)
                                    <li>
                                        <a
                                            href="{{ route('blog.categories.show', $category->slug) }}">{{ $category->name }}</a><span>{{ $category->posts_count }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
