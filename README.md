# PBKK Evolution

Nama: Royan Habibi Alfatih<br>
NRP: 5025241115

## Tugas 4: Required

### Master Layout

`layouts/app.blade.php` menjadi kerangka bersama untuk halaman. Layout menyediakan judul dinamis dan memuat CSS melalui Vite.

```blade
{{-- resources/views/layouts/app.blade.php at line: 6 --}}
<title>@yield('title', 'PBKK Evolution')</title>
@fonts
@vite(['resources/css/app.css'])
```

Layout yang sama menyediakan navbar, area konten, dan footer.

```blade
{{-- resources/views/layouts/app.blade.php at line: 225 --}}
<nav class="navbar" aria-label="Main navigation">
    {{-- Tautan navigasi --}}
</nav>

<main>
    @yield('content')
</main>

<footer class="footer">
    <p>&copy; {{date('Y')}} PBKK Evolution</p>
    <p>Made by: Royan Habibi Alfatih</p>
    <a href="{{route('home')}}">Home</a>
</footer>
```

Halaman menggunakan layout tersebut dan mengisi judul serta kontennya melalui section Blade.

```blade
{{-- resources/views/home.blade.php at line: 1 --}}
@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <style>
        /* Gaya halaman beranda */
    </style>

    {{-- Konten beranda --}}
@endsection
```

### Routing dengan `PageController`

Route beranda (`/`), profil mahasiswa (`/profil-mahasiswa`), dan ide agen (`/ide-agent`) didefinisikan di `routes/web.php` dan menggunakan method pada `PageController`.

```php
// routes/web.php at line: 7
Route::get('/', [PageController::class, 'index'])
    ->name('home');
```

```php
// routes/web.php at line: 30
Route::get('/profil-mahasiswa', [PageController::class, 'profilMahasiswa'])
    ->name('profilMahasiswa');
Route::get('/ide-agent', [PageController::class, 'ideAgent'])
    ->name('ideAgent');
```

Kedua route tersebut mengarahkan pengguna ke halaman tujuan masing-masing.

```php
// app/Http/Controllers/PageController.php at line: 153
public function profilMahasiswa() {
    return redirect()->route('mahasiswa.show', ['nrp' => '5025241115']);
}

public function ideAgent() {
    return redirect()->route('agent', ['tema' => 'gmail']);
}
```

### Reusable Blade Components & Slots

`<x-info-card>` menampilkan kartu informasi dengan judul dan isi dari slot.

```blade
{{-- resources/views/components/info-card.blade.php at line: 1 --}}
@props(['title'])

<article {{ $attributes->merge(['class' => 'info-card']) }}>
    <h2>{{ $title }}</h2>
    {{ $slot }}
</article>
```

Contoh penggunaannya menampilkan nama dan NRP pada baris terpisah.

```blade
{{-- resources/views/mahasiswa.blade.php at line: 72 --}}
<x-info-card title="Profil Mahasiswa">
    <p>Nama: {{ $nama }}</p>
    <p>NRP: {{ $nrp }}</p>
    <p>Hobi: {{ $hobi }}</p>
    <p>IPK: {{ $ipk }} / 4.00</p>
</x-info-card>
```

`<x-status-banner>` menampilkan pesan status, misalnya setelah masukan berhasil dikirim.

```blade
{{-- resources/views/components/status-banner.blade.php at line: 1 --}}
@props(['message'])

<p {{ $attributes->class(['status-banner']) }} role="status" aria-live="polite">
    {{ $message }}
</p>
```

### Vite Asset Bundling

Vite memproses aset CSS dan JavaScript aplikasi. Plugin Laravel Vite juga dikonfigurasi untuk menyediakan font Instrument Sans dalam bobot 400, 500, dan 600. Directive `@fonts` pada layout memuat font yang dikonfigurasi, sedangkan `@vite` memuat CSS hasil build. Layout menetapkan Instrument Sans pada elemen `body`, sehingga font digunakan secara konsisten oleh halaman dan komponen yang mewarisi gaya tersebut.

```js
// vite.config.js at line: 8
laravel({
    input: ['resources/css/app.css', 'resources/js/app.js'],
    refresh: true,
    fonts: [
        bunny('Instrument Sans', {
            weights: [400, 500, 600],
        }),
    ],
}),
```

Layout utama memuat stylesheet aplikasi dan font, lalu menerapkan Instrument Sans ke seluruh konten halaman.

```blade
{{-- resources/views/layouts/app.blade.php at line: 7 --}}
@fonts
@vite(['resources/css/app.css'])
```

Font diterapkan pada `body` di layout agar menjadi font bawaan di seluruh halaman.

```css
/* resources/views/layouts/app.blade.php at line: 18 */
body {
    margin: 0;
    font-family: 'Instrument Sans', sans-serif;
}
```

## Tugas 4: Challenge

### Light/Dark Mode Parameter URL

Beranda membaca `mode` dari query string. Jika nilainya `dark`, halaman menggunakan kelas mode gelap; jika tidak, halaman menggunakan mode terang. Tombol pada navbar mengubah parameter URL tersebut.

Contoh URL: `/?mode=dark`

```php
// app/Http/Controllers/PageController.php at line: 16
$mode = $request->query('mode') === 'dark' ? 'dark' : 'light';

return view('home', [
    'pageTitle' => 'PBKK Evolution',
    'user' => $user,
    'mode' => $mode,
]);
```

Kelas mode pada halaman beranda mengikuti nilai tersebut.

```blade
{{-- resources/views/home.blade.php at line: 261 --}}
<div @class(['home-page', 'home-page--dark' => $mode === 'dark'])>
    <x-welcome-toast :user="$user" />
    {{-- Konten beranda --}}
</div>
```

Fitur ini hanya diimplementasikan di Beranda `/` dan Project Idea `/dashboard/project-idea`.

### Notifikasi Welcome Parameter URL

Parameter `user` pada URL menentukan nama yang disapa di beranda. Nama yang dikenal ditampilkan sebagai nama pengguna; jika parameter tidak cocok, aplikasi menyapa sebagai `Guest`. Komponen `<x-welcome-toast>` menampilkan notifikasi yang dapat ditutup dan menghilang otomatis.

Contoh URL: `/?user=Andi`

```php
// app/Http/Controllers/PageController.php at line: 10
$requestedUser = $request->query('user');
$user = match (is_string($requestedUser) ? strtolower($requestedUser) : null) {
    'andi' => 'Andi',
    'budi' => 'Budi',
    default => 'Guest',
};
```

```blade
{{-- resources/views/home.blade.php at line: 262 --}}
<x-welcome-toast :user="$user" />
```

```blade
{{-- resources/views/components/welcome-toast.blade.php at line: 1 --}}
@props(['user' => 'Guest'])

<div {{ $attributes->class(['welcome-toast']) }} role="status" aria-live="polite" data-welcome-toast>
    <span>Selamat datang, {{ $user }}!</span>
    <button class="welcome-toast__close" type="button" aria-label="Tutup notifikasi">&times;</button>
</div>
```
