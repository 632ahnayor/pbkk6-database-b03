@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    .fallback-page {
        display: grid;
        place-items: center;
        padding: 2rem 1rem;
    }

    .fallback-card {
        width: min(100%, 420px);
        padding: clamp(2rem, 6vw, 3rem);
        border: 1px solid #e0e7ef;
        border-radius: 12px;
        background: white;
        box-shadow: 0 12px 32px rgb(2 56 128 / 12%);
        text-align: center;
    }

    .fallback-card h1 {
        margin: 0;
        color: #023880;
        font-size: clamp(4rem, 16vw, 6rem);
        line-height: 1;
    }

    .fallback-card p {
        margin: 1rem 0 1.5rem;
        color: #536273;
        font-size: 1rem;
    }

    .fallback-home {
        display: inline-block;
        padding: 0.75rem 1.25rem;
        border-radius: 6px;
        background: #2563eb;
        color: white;
        font-weight: 600;
        text-decoration: none;
    }

    .fallback-home:hover {
        background: #1d4ed8;
    }

    .fallback-home:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 3px;
    }
</style>

<section class="fallback-page">
    <section class="fallback-card" aria-labelledby="fallback-title">
        <h1 id="fallback-title">404</h1>
        <p>Halaman yang anda cari tidak ditemukan</p>
        <a class="fallback-home" href="{{ route('home') }}">Home</a>
    </section>
</section>
@endsection