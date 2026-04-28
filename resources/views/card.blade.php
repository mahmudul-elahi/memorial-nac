 <div class="card border-0 rounded-3">

    <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}">
        <div class="card-img-top img-responsive img-responsive-16by9 shadow" style="background-image: url({{ asset($item->getThumb()) }});"></div>
    </a>

    <div class="card-body">    
        <h3 class="card-title font-weight-bold text-truncate">
            <a href="{{ route('show.obituary', [$item->id, $item->slug]) }}" class="text-reset">
                {{ $item->title }}
            </a>
        </h3>

        <div class="card-subtitle">
    <span class="badge bg-cyan-lt">
        {{ Carbon\Carbon::create($item->details->birth_date)->format('d M, Y') }}
    </span>

    <span class="badge bg-cyan-lt">
        {{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}
    </span>
</div>


        <cite class="text-muted">
            {{ Str::limit(strip_tags($item->description), 135) }} 
        </cite>
        
    </div>

    <div class="card-footer">
        <div class="d-flex align-items-center">
            <a href="javascript:void(0);" onclick="storeCondolence({{ $item->id }})" class="btn btn-pill btn-dark">
                <svg xmlns="http://www.w3.org/2000/svg" id="like-icon-{{ $item->id }}" class="icon @if(Auth::check()) @if(Auth::user()->hasLiked($item)) icon-filled text-success @else text-muted @endif @else text-muted @endif" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 15h10v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2v-4z" /><path d="M12 9a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3" /><path d="M12 11a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3" /><line x1="12" y1="15" x2="12" y2="9" /></svg>
                {{__('app.send_flower')}}
            </a> 

            <!-- 
            If there are more than 3 condolences, users are shown with a final badge of (+N users subtracted 3)
            -->
            @if($item->likers->count() > 3)
            <div class="d-inline-flex ms-2">
                <div class="avatar-list avatar-list-stacked">
                    @foreach($item->likers->take(3) as $user)
                    <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $user->name }}" style="background-image: url({{ asset($user->getAvatar()) }})"></span>
                    @endforeach
                    <span class="avatar avatar-sm avatar-rounded">{{__('+:count', ['count'=>$item->likers->count()-3])}}</span>
                </div>
            </div>
            @endif

            <div class="ms-auto">
                <a href="{{ route('show.obituary', ['id'=>$item->id,'slug'=>$item->slug]) }}#comments" class="btn btn-link">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" /><line x1="12" y1="12" x2="12" y2="12.01" /><line x1="8" y1="12" x2="8" y2="12.01" /><line x1="16" y1="12" x2="16" y2="12.01" /></svg>
                    {{__('app.count_comment_card', ['count'=>$item->comments->count()])}}
                </a>
            </div>

        </div>
    </div>

</div>