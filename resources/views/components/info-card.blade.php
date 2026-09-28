@props(['title'])

<article {{ $attributes->merge(['class' => 'info-card']) }}>
    <h2>{{ $title }}</h2>
    {{ $slot }}
</article>
