@props(['href' => '/'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'site-brand']) }} style="display:flex; align-items:center; text-decoration:none;">
    <img
        src="{{ asset('images/MarketLink_logo_transparent.png') }}"
        alt="MarketLink"
        width="150"
        style="display:block; width:150px; max-width:42vw; height:auto; object-fit:contain;"
    >
</a>