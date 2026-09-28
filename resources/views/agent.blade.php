@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    main {
        padding: 0;
    }

    .agent-section {
        width: min(1100px, calc(100% - 2rem));
        margin: 0 auto 3rem;
    }

    .agent-section__header {
        margin-bottom: 1.25rem;
    }

    .agent-section__header h1 {
        margin: 0 0 0.25rem;
        color: #023880;
        font-weight: bolder;
        font-size: xx-large;
    }

    .agent-section__header p {
        margin: 0;
        color: #536273;
        line-height: 1.5;
        font-size: large;
    }

    .agent-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
        gap: 1.25rem;
    }

    .agent-card {
        padding: clamp(1.5rem, 3vw, 2rem);
        border: 1px solid #e0e7ef;
        border-radius: 12px;
        background: white;
        box-shadow: 0 8px 24px rgb(2 56 128 / 7%);
    }

    .agent-card h2 {
        margin: 0 0 0.75rem;
        color: #023880;
        font-size: 1.25rem;
        font-weight: bold;
    }

    .agent-card ol,
    .agent-card p {
        margin: 0;
        color: #536273;
        line-height: 1.65;
    }
</style>

<section class="agent-section">
    <header class="agent-section__header">
        <h1>{{ $title }}</h1>
        @if ($subtitle)
            <p>{{ $subtitle }}</p>
        @endif
    </header>

    <div class="agent-card-grid">
        @foreach ($cards as $card)
            <article class="agent-card">
                <h2>{{ $card['title'] }}</h2>
                <p>{{ $card['text'] }}</p>
            </article>
        @endforeach
    </div>
</section>

@endsection
