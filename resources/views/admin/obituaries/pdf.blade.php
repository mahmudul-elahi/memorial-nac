<img src="{{ asset('img/logo/logo_necrologi.png') }}" alt="" title="">

<div class="">
    <img src="{{ asset($item->getThumb()) }}" width="150px" height="150px" alt="" title="">
</div>

<h2 class="text-muted">
    {{ $item->title }}
</h2>

<div class="">
    {!! $item->description !!}
</div>