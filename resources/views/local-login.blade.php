@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <style>
        .local-login {
            min-height: 100%;
            padding: clamp(3rem, 8vw, 6rem) clamp(1.25rem, 5vw, 4rem);
            background: #f4f7fb;
            color: #172033;
        }

        .local-login__content {
            width: min(100%, 72rem);
            margin: 0 auto;
        }

        .local-login h1 {
            margin: 0;
            color: #023880;
            font-size: clamp(2.5rem, 7vw, 5rem);
            line-height: 1.05;
            text-align: center;
        }

        .local-login__intro {
            max-width: 42rem;
            margin: 1rem auto 3rem;
            color: #536273;
            font-size: 1.1rem;
            line-height: 1.6;
            text-align: center;
        }

        .local-login__cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1.25rem;
        }

        .local-login__card {
            display: flex;
            min-height: 13rem;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.75rem;
            border: 2px solid transparent;
            border-radius: 14px;
            background: white;
            box-shadow: 0 12px 32px rgb(2 56 128 / 12%);
            color: inherit;
            text-decoration: none;
            transition: border-color 180ms ease, box-shadow 180ms ease, transform 180ms ease;
        }

        .local-login__card:hover,
        .local-login__card:focus-visible {
            transform: translateY(-3px);
            border-color: #60a5fa;
            box-shadow: 0 0 0 4px rgb(96 165 250 / 16%), 0 16px 40px rgb(2 56 128 / 18%);
        }

        .local-login__card:focus-visible {
            outline: 3px solid #023880;
            outline-offset: 4px;
        }

        .local-login__card h2 {
            margin: 0;
            color: #023880;
            font-size: 1.75rem;
        }

        .local-login__card p {
            margin: 0.75rem 0 0;
            color: #536273;
            line-height: 1.5;
        }

        .local-login__action {
            margin-top: 1.5rem !important;
            color: #023880 !important;
            font-weight: 700;
        }

        @media (max-width: 720px) {
            .local-login__cards {
                grid-template-columns: 1fr;
            }

            .local-login__card {
                min-height: 10rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .local-login__card {
                transition: none;
            }
        }
    </style>

    <section class="local-login">
        <div class="local-login__content">
            <h1>Local Login Demo</h1>
            <p class="local-login__intro">
                Pilih pengguna untuk melihat pesan sambutan di halaman utama. Demo ini hanya memakai query parameter dan tidak melakukan autentikasi sungguhan. Demo ini untuk memenuhi Challenge 2 Pertemuan 4 Alert Status Interaktif.
            </p>

            <div class="local-login__cards">
                <a class="local-login__card" href="{{ route('home', ['user' => 'Guest']) }}">
                    <div>
                        <h2>Guest</h2>
                        <p>Lihat halaman utama sebagai pengunjung.</p>
                    </div>
                    <p class="local-login__action">Lanjut sebagai Guest &rarr;</p>
                </a>

                <a class="local-login__card" href="{{ route('home', ['user' => 'Andi']) }}">
                    <div>
                        <h2>Andi</h2>
                        <p>Lihat halaman utama dengan pesan sambutan Andi.</p>
                    </div>
                    <p class="local-login__action">Lanjut sebagai Andi &rarr;</p>
                </a>

                <a class="local-login__card" href="{{ route('home', ['user' => 'Budi']) }}">
                    <div>
                        <h2>Budi</h2>
                        <p>Lihat halaman utama dengan pesan sambutan Budi.</p>
                    </div>
                    <p class="local-login__action">Lanjut sebagai Budi &rarr;</p>
                </a>
            </div>
        </div>
    </section>
@endsection
