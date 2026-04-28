@extends('layouts.app')
@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">

            <div class="col-auto">
                <span class="avatar avatar-rounded avatar-lg" style="background-image: url({{ asset($user->getAvatar()) }})"></span>
            </div>

            <div class="col">
                <div class="page-title text-muted">
                    {{__('app.pn_the_profile_of', ['name'=>$user->name])}}
                </div>
                <div class="page-subtitle">
                    <div class="row">
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572"></path></svg>
                            <span class="text-reset font-weight-bold">
                                {{ $user->likes()->count() }}
                            </span>
                        </div>
                        <div class="col-auto">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><line x1="12" y1="12" x2="12" y2="12.01" /><line x1="8" y1="12" x2="8" y2="12.01" /><line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                            <span class="text-reset font-weight-bold">
                                {{__('app.count_user_comments', ['count'=>$user->comments->count()])}}
                            </span>
                        </div>
                        <div class="col-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="3" y1="21" x2="21" y2="21"></line><path d="M10 21v-4a2 2 0 0 1 4 0v4"></path><line x1="10" y1="5" x2="14" y2="5"></line><line x1="12" y1="3" x2="12" y2="8"></line><path d="M6 21v-7m-2 2l8 -8l8 8m-2 -2v7"></path></svg>
                            <span class="text-reset font-weight-bold">
                                {{ trans_choice('app.count_user_obituaries', $user->items->count()) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                
            </div>
        </div>
    </div>
</div>

<div class="hr text-muted"></div>

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
          <div class="col">
              <div class="page-title text-muted">
                  {{__('app.latest_obituaries_title')}}
              </div>
              {{-- <div class="page-subtitle">
                  {{__('app.latest_obituaries_subtitle')}}
              </div> --}}
          </div>
          <!-- Page title actions -->
          <div class="col-auto ms-auto d-print-none">
              <div class="btn-list">

              </div>
          </div>
      </div>
  </div>
</div>

<div class="page-body">
    <div class="container-xl">

        <div class="row row-cards">

            <div class="col-lg-12">
                <div class="row row-cards">
                    @forelse($user->items as $item)
                    <div class="col-lg-3">
                        @include('card')
                    </div>
                    @empty
                        {{__('app.no_results')}}
                    @endforelse
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            {{__('app.latest_comments')}}
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="divide-y">
                            @forelse($user->comments->take(10) as $comment)
                            <div>
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar avatar-rounded" style="background-image: url({{ asset($comment->user->getAvatar()) }})"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-reset">
                                            "<cite>{{ $comment->content }}</cite>" <a href="{{ route('show.obituary', [$comment->item->id, $comment->item->slug]) }}" class="font-weight-bold">{{ $comment->item->title }}</a>
                                        </div>

                                        <div class="text-muted">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <span class="text-reset">
                                {{__('app.this_user_has_no_comments_yet')}}
                            </span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
            </div>

        </div>
    </div>
</div>

@endsection()