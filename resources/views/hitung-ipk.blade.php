@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    .hitungipk-form {
        display: grid;
        gap: 1rem;
        max-width: 420px;
    }

    .hitungipk h1 {
        max-width: 500px;
        margin: 0;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 600;
        line-height: 1.5;
        text-wrap: balance;
        text-shadow: 0 2px 12px rgb(0 0 0 / 10%);
    }

    .hitungipk-form label {
        display: grid;
        gap: 0.4rem;
        color: #263547;
        font-weight: 600;
    }

    .hitungipk-form input {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        font: inherit;
    }

    .hitungipk-form input:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 2px;
    }

    .hitungipk-form .blue-button {
        justify-self: start;
        padding: 0.75rem 1.25rem;
        border: 0;
        border-radius: 6px;
        background-color: #2563eb;
        color: white;
        font: inherit;
        font-weight: 600;
        cursor: pointer;
    }

    .hitungipk-form .blue-button:hover {
        background-color: #1d4ed8;
    }

    .hitungipk-form .blue-button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 3px;
    }


</style>

<section class="hitungipk">
    <h1>Hitung IPK 2 Semester</h1>

    <form class="hitungipk-form" method="POST" action="{{ route('hitung-ipk.calculate') }}">
        @csrf

        <label for="ip1">
            IP Semester 1
            <input id="ip1" name="ip1" type="number" min="0" max="4" step="any"
                value="{{ old('ip1', $ip1 ?? '') }}" required
                @error('ip1') aria-describedby="ip1-error" @enderror>
        </label>
        @error('ip1')
            <p id="ip1-error" role="alert">{{ $message }}</p>
        @enderror

        <label for="ip2">
            IP Semester 2
            <input id="ip2" name="ip2" type="number" min="0" max="4" step="any"
                value="{{ old('ip2', $ip2 ?? '') }}" required
                @error('ip2') aria-describedby="ip2-error" @enderror>
        </label>
        @error('ip2')
            <p id="ip2-error" role="alert">{{ $message }}</p>
        @enderror

        <button class="blue-button" type="submit">Hitung</button>
    </form>

    @isset($hasil)
        <p>Rata-rata IP: <strong>{{ number_format($hasil, 2) }}</strong></p>
    @endisset
</section>

@endsection
