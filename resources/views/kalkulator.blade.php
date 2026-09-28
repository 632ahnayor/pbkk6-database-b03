@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    .kalkulator h1{
        margin: 0 0 1.25rem;
        font-size: xxx-large;
        font-weight: 600;
    }

    .kalkulator-result {
        max-width: 680px;
        margin-bottom: 1.5rem;
        padding: 1.5rem;
        border: 1px solid #e0e7ef;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 8px 24px rgb(2 56 128 / 7%);
    }

    .kalkulator-result h3 {
        margin: 0 0 1rem;
        font-size: x-large;
        font-weight: 400;
        line-height: 1.6;
    }

    .kalkulator-result p {
        margin: 0;
        line-height: 1.6;
    }

    .kalkulator-result .warning {
        margin-bottom: 1rem;
        color: #b91c1c;
    }

    .kalkulator-test .blue-button {
        padding: 0.75rem 1.25rem;
        border: 0;
        border-radius: 6px;
        display: inline-block;
        background-color: #2563eb;
        color: white;
        font: inherit;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
    }

    .kalkulator-test .blue-button:hover {
        background-color: #1d4ed8;
    }

    .kalkulator-test .blue-button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 3px;
    }

    .kalkulator-test .red-button {
        padding: 0.75rem 1.25rem;
        border: 0;
        border-radius: 6px;
        display: inline-block;
        background-color: #eb2525;
        color: white;
        font: inherit;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
    }

    .kalkulator-test .red-button:hover {
        background-color: #d81d1d;
    }

    .kalkulator-test .red-button:focus-visible {
        outline: 3px solid #fd9393;
        outline-offset: 3px;
    }
</style>

<section class="kalkulator">
    <h1>Kalkulator Rute Dinamis</h1>

    <div class="kalkulator-result">
        @if ($warning)
            <p class="warning" role="alert"><strong>Peringatan:</strong> {{ $warning }}</p>
        @endif

        <h3>
            Hasil dari {{ $angka1 }} {{ $operasi }} {{ $angka2 }}
            adalah <strong>{{ $warning ? '?' : $hasil }}</strong>.
        </h3>

        <p>
            Operasi yang tersedia: tambah, kurang, kali, bagi, modulo, pangkat.
        </p>
    </div>
</section>

<section class="kalkulator-test">
    <a class="blue-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'tambah']) }}">Tambah</a>
    <a class="blue-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'kurang']) }}">Kurang</a>
    <a class="blue-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'kali']) }}">Kali</a>
    <a class="blue-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'bagi']) }}">Bagi</a>
    <a class="blue-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'modulo']) }}">Modulo</a>
    <a class="blue-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'pangkat']) }}">Pangkat</a>
    <a class="red-button" href="{{ route('kalkulator', ['angka1' => 'a', 'angka2' => 7, 'operasi' => 'kali']) }}">a x 7</a>
    <a class="red-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 7, 'operasi' => 'operasi']) }}">Operasi</a>
    <a class="red-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 0, 'operasi' => 'bagi']) }}">Bagi 0</a>
    <a class="red-button" href="{{ route('kalkulator', ['angka1' => 6, 'angka2' => 0, 'operasi' => 'modulo']) }}">Modulo 0</a>
    
</section>
@endsection
