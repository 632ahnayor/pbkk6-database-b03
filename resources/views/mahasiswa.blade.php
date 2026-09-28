@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    main {
        padding: 0;
    }

    .mahasiswa-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
        gap: 1.25rem;
        max-width: 800px;
        margin: 2rem auto 0;
    }

    .mahasiswa-test {
        margin: 2rem 1rem 0;
        text-align: center;
    }

    .mahasiswa-test .blue-button {
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

    .mahasiswa-test .blue-button:hover {
        background-color: #1d4ed8;
    }

    .mahasiswa-test .blue-button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 3px;
    }

    .mahasiswa-test .red-button {
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

    .mahasiswa-test .red-button:hover {
        background-color: #d81d1d;
    }

    .mahasiswa-test .red-button:focus-visible {
        outline: 3px solid #fd9393;
        outline-offset: 3px;
    }

</style>

<section>
    <div class="mahasiswa-card-grid">
        <x-info-card title="Profil Mahasiswa">
            <p>Nama: {{ $nama }}</p>
            <p>NRP: {{ $nrp }}</p>
            <p>Hobi: {{ $hobi }}</p>
            <p>IPK: {{ $ipk }} / 4.00</p>
        </x-info-card>
        
    </div>
</section>


<section class="mahasiswa-test">
    <a class="blue-button" href="{{ route('home') }}">Home</a>
    <a class="blue-button" href="{{ route('mahasiswa.show', ['nrp' => '5025241115']) }}">5025241115</a>
    <a class="blue-button" href="{{ route('mahasiswa.show', ['nrp' => '5025123456']) }}">5025123456</a>
    
    <a class="red-button" href="{{ route('mahasiswa.show', ['nrp' => '50']) }}">50</a>
    <a class="red-button" href="{{ route('mahasiswa.show', ['nrp' => 'abc']) }}">abc</a>
    <a class="red-button" href="{{ url('/mahasiswa') }}">mahasiswa</a>
    
</section>
@endsection