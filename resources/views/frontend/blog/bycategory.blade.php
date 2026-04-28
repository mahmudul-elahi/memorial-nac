@extends('frontend.master')

@section('content')
    {{-- Blog Section Start --}}


    <section id="blog_posts">
        <div class="bg">
            <div class="container">

                <div class="row">

                    <div class="col-md-12 col-lg-9">
                        <div class="row gy-4">

                            @foreach ($posts as $post)
                                <div class="col-md-4">
                                    <div class="blogs-post-card h-100">
                                        <div class="card-image">
                                            <img src="{{ asset($post->getThumbnail()) }}" class="w-100" alt="card-image1">
                                        </div>

                                        <div class="card-text">
                                            <div class="date">
                                                <p class="mb-0">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>

                                            <h4>{{ Str::limit($post->title, 15) }}</h4>

                                            <h5>{{ Str::limit($post->description, 50) }}</h5>
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
                        <div class="pagination-container">
                            {{ $posts->links() }}
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
        </div>
    </section>

    {{-- Blog Section End --}}
@endsection
