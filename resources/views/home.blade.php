@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <style>
        main {
            padding: 0;
        }

        .home-page {
            --home-section-background: #f4f7fb;
            --home-card-background: white;
            --home-card-title: #023880;
            --home-card-text: #536273;
            --home-focus: #023880;
            background: white;
        }

        .home-page--dark {
            --home-section-background: #111827;
            --home-card-background: #1f2937;
            --home-card-title: #bfdbfe;
            --home-card-text: #d1d5db;
            --home-focus: #93c5fd;
            background: #111827;
            color: #f9fafb;
        }

        .home-hero {
            position: relative;
            display: grid;
            min-height: calc(100vh - 3.125rem);
            min-height: calc(100svh - 3.125rem);
            place-items: center;
            overflow: hidden;
            padding: clamp(2rem, 6vw, 5rem);
            isolation: isolate;
            color: white;
            text-align: center;
        }

        .home-hero-slides {
            position: absolute;
            z-index: -2;
            inset: 0;
            display: flex;
            transition: transform 700ms ease-in-out;
        }

        .home-hero-slide {
            flex: 0 0 100%;
            min-width: 0;
        }

        .home-hero-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .home-hero::after {
            position: absolute;
            z-index: -1;
            inset: 0;
            content: "";
        }

        .home-hero::after {
            background: linear-gradient(135deg, rgb(2 56 128 / 88%), rgb(0 112 192 / 68%));
        }

        .home-page--dark .home-hero::after {
            background: linear-gradient(135deg, rgb(3 7 18 / 90%), rgb(17 24 39 / 78%));
        }

        .home-hero-content {
            position: relative;
            z-index: 1;
        }

        .home-hero h1 {
            margin: 0;
            font-size: clamp(2.5rem, 7vw, 5rem);
            font-weight: bold;
            text-shadow: 0 2px 12px rgb(0 0 0 / 25%);
        }

        .home-hero h2 {
            margin: 0.5rem 0 0;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            text-shadow: 0 2px 12px rgb(0 0 0 / 25%);
        }

        .home-hero-control {
            position: absolute;
            z-index: 2;
            top: 50%;
            display: grid;
            width: 2.75rem;
            height: 2.75rem;
            place-items: center;
            transform: translateY(-50%);
            border: 1px solid rgb(255 255 255 / 55%);
            border-radius: 50%;
            background: rgb(2 56 128 / 65%);
            color: white;
            font: inherit;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .home-hero-control:hover {
            background: rgb(2 56 128 / 90%);
        }

        .home-hero-control:focus-visible,
        .home-hero-dot:focus-visible {
            outline: 3px solid white;
            outline-offset: 3px;
        }

        .home-hero-prev {
            left: clamp(0.75rem, 3vw, 2rem);
        }

        .home-hero-next {
            right: clamp(0.75rem, 3vw, 2rem);
        }

        .home-hero-dots {
            position: absolute;
            z-index: 2;
            right: 0;
            bottom: 1.5rem;
            left: 0;
            display: flex;
            justify-content: center;
            gap: 0.6rem;
        }

        .home-hero-dot {
            width: 0.65rem;
            height: 0.65rem;
            padding: 0;
            border: 0;
            border-radius: 999px;
            background: rgb(255 255 255 / 55%);
            cursor: pointer;
        }

        .home-hero-dot[aria-pressed="true"] {
            width: 2rem;
            background: white;
        }

        .home-second {
            display: grid;
            min-height: 280px;
            place-items: center;
            padding: clamp(3rem, 8vw, 6rem) clamp(1.5rem, 8vw, 7rem);
            background: var(--home-section-background);
        }

        .home-card {
            display: flex;
            align-items: center;
            gap: clamp(1.25rem, 4vw, 2rem);
            width: min(100%, 620px);
            padding: clamp(1.25rem, 3vw, 2rem);
            border: 2px solid transparent;
            border-radius: 12px;
            background-color: var(--home-card-background);
            box-shadow: 0 12px 32px rgb(2 56 128 / 16%), 0 3px 8px rgb(15 23 42 / 8%);
            color: inherit;
            text-align: left;
            text-decoration: none;
            transition: border-color 200ms ease, box-shadow 200ms ease, transform 200ms ease;
        }

        .home-card:hover,
        .home-card:focus-visible {
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgb(96 165 250 / 16%), 0 16px 40px rgb(2 56 128 / 24%);
            transform: translateY(-3px);
        }

        .home-card:focus-visible {
            outline: 3px solid var(--home-focus);
            outline-offset: 4px;
        }

        .home-card-image {
            position: relative;
            flex: 0 0 clamp(96px, 24vw, 150px);
            aspect-ratio: 0.75;
            overflow: hidden;
            border-radius: 10px;
            background: #e0e7ef;
        }

        .home-card-image img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 250ms ease, transform 250ms ease;
        }

        .home-card-image-secondary {
            opacity: 0;
        }

        .home-card:hover .home-card-image-primary {
            opacity: 0;
            transform: scale(1.04);
        }

        .home-card:hover .home-card-image-secondary {
            opacity: 1;
            transform: scale(1.04);
        }

        .home-card-content {
            min-width: 0;
        }

        .home-card h2 {
            margin: 0;
            color: var(--home-card-title);
            font-size: 1.25rem;
        }

        .home-card p {
            margin-top: 0.75rem;
            margin-bottom: 0;
            color: var(--home-card-text);
        }

        @media (prefers-reduced-motion: reduce) {
            .home-hero-slides {
                transition: none;
            }

            .home-card,
            .home-card-image img {
                transition: none;
            }
        }

        @media (max-width: 420px) {
            .home-card {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>

    <div @class(['home-page', 'home-page--dark' => $mode === 'dark'])>
    <x-welcome-toast :user="$user" />

    <section class="home-hero" aria-label="Selamat datang">
        <div class="home-hero-slides" aria-hidden="true">
            <div class="home-hero-slide"><img src="/images/rektorat.jpg" alt=""></div>
            <div class="home-hero-slide"><img src="/images/perpustakaan.jpg" alt=""></div>
            <div class="home-hero-slide"><img src="/images/rektorat.jpg" alt=""></div>
            <div class="home-hero-slide"><img src="/images/pengukuhan.png" alt=""></div>
        </div>

        <button class="home-hero-control home-hero-prev" type="button" aria-label="Gambar sebelumnya">&lsaquo;</button>
        <div class="home-hero-content">
            <h1>Vivat!</h1>
            <h2>Hidup ITS!</h2>
        </div>
        <button class="home-hero-control home-hero-next" type="button" aria-label="Gambar berikutnya">&rsaquo;</button>
        <div class="home-hero-dots" aria-label="Pilih gambar">
            <button class="home-hero-dot" type="button" aria-label="Gambar 1" aria-pressed="true"></button>
            <button class="home-hero-dot" type="button" aria-label="Gambar 2" aria-pressed="false"></button>
            <button class="home-hero-dot" type="button" aria-label="Gambar 3" aria-pressed="false"></button>
            <button class="home-hero-dot" type="button" aria-label="Gambar 4" aria-pressed="false"></button>
        </div>
    </section>

    <section class="home-second">
        <a class="home-card" href="{{ route('mahasiswa.show', ['nrp' => '5025241115']) }}">
            <div class="home-card-image" aria-label="Foto Royan Habibi Alfatih">
                <img class="home-card-image-primary" src="/images/royan_casual.jpg" alt="Royan Habibi Alfatih">
                <img class="home-card-image-secondary" src="/images/royan_almamater.jpg" alt="" aria-hidden="true">
            </div>
            <div class="home-card-content">
                <h2>Nama: Royan Habibi Alfatih</h2>
                <p>NRP: 5025241115</p>
                <p style="font-size: smaller;">Click for more detail</p>
            </div>
        </a>
    </section>
    </div>

    <script>
        (() => {
            const hero = document.querySelector('.home-hero');
            const track = hero.querySelector('.home-hero-slides');
            const dots = [...hero.querySelectorAll('.home-hero-dot')];
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            let currentSlide = 0;
            let autoSlide;

            const showSlide = (index) => {
                currentSlide = (index + dots.length) % dots.length;
                track.style.transform = `translateX(-${currentSlide * 100}%)`;
                dots.forEach((dot, dotIndex) => {
                    dot.setAttribute('aria-pressed', String(dotIndex === currentSlide));
                });
            };

            const stopAutoSlide = () => {
                window.clearInterval(autoSlide);
            };

            const startAutoSlide = () => {
                stopAutoSlide();
                if (!reducedMotion.matches && !document.hidden) {
                    autoSlide = window.setInterval(() => showSlide(currentSlide + 1), 5000);
                }
            };

            hero.querySelector('.home-hero-prev').addEventListener('click', () => {
                showSlide(currentSlide - 1);
                startAutoSlide();
            });
            hero.querySelector('.home-hero-next').addEventListener('click', () => {
                showSlide(currentSlide + 1);
                startAutoSlide();
            });
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    showSlide(index);
                    startAutoSlide();
                });
            });

            document.addEventListener('visibilitychange', startAutoSlide);
            reducedMotion.addEventListener('change', startAutoSlide);
            startAutoSlide();
        })();
    </script>
@endsection
