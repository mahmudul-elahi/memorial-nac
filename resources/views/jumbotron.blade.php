<div class="container">
    <div class="bg-transparent border-0">
        <div class="card-body">
            <div class="row flex-lg-row-reverse align-items-center py-4">

                <div class="col d-none d-md-block">
                    <div class="d-flex justify-content-center">
                        <div class="avatar-list avatar-list-stacked">
                            @foreach($itemsForJumbo as $item)
                            <a href="{{ route('show.obituary', ['id'=>$item->id, 'slug'=>$item->slug]) }}" title="{{ $item->title }}">
                                <span class="avatar avatar-rounded avatar-xl" style="background-image: url({{ asset($item->getThumb()) }})"></span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h2 class="display-6 font-weight-bold">
                        {{__('app.jumbo_title')}}
                    </h2>
                    <p class="lead">
                        {{__('app.jumbo_content')}}
                    </p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('insert.obituary') }}" class="btn btn-pill btn-dark btn-lg px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            {{__('app.send_button')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hr"></div>