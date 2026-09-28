@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    .form-section {
        max-width: 760px;
        margin: 0 auto;
        padding: 2rem;
        border-radius: 12px;
        background: #fff;
        box-shadow: 0 8px 24px rgb(15 23 42 / 10%);
    }

    .form-section h1 {
        margin: 0 0 2rem;
        color: #111827;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 750;
        line-height: 1.1;
        text-align: center;
    }

    .form-grid {
        display: grid;
        grid-template-columns: minmax(150px, 1fr) minmax(0, 2fr);
        gap: 1.25rem 1.5rem;
        align-items: start;
    }

    .form-grid label {
        padding-top: 0.7rem;
        color: #1f2937;
        font-weight: 600;
    }

    .form-grid input,
    .form-grid select,
    .form-grid textarea {
        box-sizing: border-box;
        width: 100%;
        padding: 0.7rem 0.8rem;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        background: #fff;
        color: #111827;
        font: inherit;
    }

    .form-grid textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-grid input:focus,
    .form-grid select:focus,
    .form-grid textarea:focus {
        border-color: #2563eb;
        outline: 3px solid #bfdbfe;
    }

    .field-control {
        min-width: 0;
    }

    .form-error {
        margin: 0.4rem 0 0;
        color: #b91c1c;
    }

    .form-actions {
        grid-column: 1 / -1;
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 0.25rem;
    }

    .form-button {
        padding: 0.75rem 1.25rem;
        border: 0;
        border-radius: 6px;
        font: inherit;
        font-weight: 600;
        cursor: pointer;
    }

    .submit-button {
        background-color: #2563eb;
        color: #fff;
    }

    .submit-button:hover {
        background-color: #1d4ed8;
    }

    .reset-button {
        background-color: #e5e7eb;
        color: #1f2937;
    }

    .reset-button:hover {
        background-color: #d1d5db;
    }

    .form-button:focus-visible {
        outline: 3px solid #93c5fd;
        outline-offset: 3px;
    }

    @media (max-width: 600px) {
        .form-section {
            padding: 1.25rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }

        .form-grid label {
            padding-top: 0.75rem;
        }

        .form-actions {
            margin-top: 1rem;
        }
    }
</style>

<section class="form-section">
    <h1>Simple Secure Form</h1>

    @if (session('status'))
        <x-status-banner :message="session('status')" />
    @endif

    <form class="form-grid" method="POST" action="{{ route('form.post') }}">
        @csrf

        <label for="nama">
            Nama Mahasiswa
        </label>
        <div class="field-control">
            <input id="nama" name="nama" type="text"
                value="{{ old('nama') }}" minlength="3" required
                @error('nama') aria-describedby="nama-error" @enderror>
            @error('nama')
                <p class="form-error" id="nama-error" role="alert">{{ $message }}</p>
            @enderror
        </div>

        <label for="email">
            Email ITS
        </label>
        <div class="field-control">
            <input id="email" name="email" type="email"
                value="{{ old('email') }}" pattern="[^@]+@student\.its\.ac\.id" required
                @error('email') aria-describedby="email-error" @enderror>
            @error('email')
                <p class="form-error" id="email-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <label for="kategori">
            Kategori Masukan
        </label>
        <div class="field-control">
            <select id="kategori" name="kategori" required
                @error('kategori') aria-describedby="kategori-error" @enderror>
                <option value="" disabled @selected(!old('kategori'))>Pilih kategori</option>
                <option value="akademik" @selected(old('kategori') === 'akademik')>Akademik</option>
                <option value="sarana" @selected(old('kategori') === 'sarana')>Sarana Prasarana</option>
                <option value="kegiatan" @selected(old('kategori') === 'kegiatan')>Kegiatan Mahasiswa</option>
            </select>
            @error('kategori')
                <p class="form-error" id="kategori-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <label for="pesan">
            Isi Pesan
        </label>
        <div class="field-control">
            <textarea id="pesan" name="pesan" minlength="15" required
                @error('pesan') aria-describedby="pesan-error" @enderror>{{ old('pesan') }}</textarea>
            @error('pesan')
                <p class="form-error" id="pesan-error" role="alert">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-actions">
            <button class="form-button submit-button" type="submit">Submit</button>
            <button class="form-button reset-button" type="reset">Reset</button>
        </div>
    </form>
</section>
@endsection