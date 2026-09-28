@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
    <style>
        main {
            padding: 0;
        }

        .about-hero {
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

        .about-hero::before,
        .about-hero::after {
            position: absolute;
            z-index: -1;
            inset: 0;
            content: "";
        }

        .about-hero::before {
            background: url('/images/gedung-if.jpg') center 100% / cover no-repeat;
            transform: scale(1.02);
        }

        .about-hero::after {
            background: linear-gradient(135deg, rgb(2 56 128 / 88%), rgb(0 112 192 / 68%));
        }

        .about-hero p {
            max-width: 760px;
            margin: 0;
            font-size: clamp(1.5rem, 4vw, 2.75rem);
            font-weight: 600;
            line-height: 1.3;
            text-wrap: balance;
            text-shadow: 0 2px 12px rgb(0 0 0 / 25%);
        }

        .about-second,
        .about-third {
            padding: clamp(3rem, 8vw, 6rem) clamp(1.5rem, 8vw, 7rem);
        }

        .about-second {
            background: #f4f7fb;
        }

        .about-third {
            background: #fff;
        }

        .about-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
            gap: 1.25rem;
            max-width: 1100px;
            margin: 0 auto;
        }

        .about-card {
            padding: clamp(1.5rem, 3vw, 2rem);
            border: 1px solid #e0e7ef;
            border-radius: 12px;
            background: white;
            box-shadow: 0 8px 24px rgb(2 56 128 / 7%);
        }

        .about-card h2 {
            margin: 0 0 0.75rem;
            color: #023880;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .about-card ol,
        .about-card p {
            margin: 0;
            color: #536273;
            line-height: 1.65;
        }
    </style>

    <section class="about-hero">
        <p>Selamat datang di</p>
        <p>Departemen Teknik Informatika</p>
    </section>

    <section class="about-second">
        <div class="about-card-grid">
            <article class="about-card">
                <h2>Program Studi</h2>
                <p>Departemen Teknik Informatika menyediakan Program Studi Sarjana (S1) Teknik Informatika, Teknik Informatika (IUP), Rekayasa Perangkat Lunak, Rekayasa Kecerdasan Artifisial, Master (S2) Teknik Informatika dan Doktor (S3) Ilmu Komputer.</p>
            </article>
            <article class="about-card">
                <h2>Jalur Pendaftaran</h2>
                <p>ITS menyediakan jalur pendaftaran program studi sarjana (S1) melalui SNMPTN, SBMPTN, Program Kemitraan dan Mandiri (PKM). Program studi pascasarjana (S2 dan S3) melalui pascasarjana. Bagi calon mahasiswa internasional melalui International Office.</p>
            </article>
        </div>
    </section>

    <section class="about-third">
        <div class="about-card-grid">
            <article class="about-card">
                <h2>Sejarah</h2>
                <p>Pendidikan tinggi diarahkan untuk mempersiapkan bangsa Indonesia dalam menghadapi era pembangunan industri dan informasi. Untuk itu pemerintah melalui Direktorat Jendral Pendidikan Tinggi pada tahun 1985 menginstruksikan untuk membuka Program Studi S1 baru untuk bidang ilmu teknologi komputer di empat universitas atau institut di mana ITS termasuk di dalamnya. Di ITS, program ini awalnya diberi nama Program Studi Teknik Komputer. Namun sejak tahun 1993, nama Program Studi Teknik Komputer diubah menjadi Jurusan Teknik Komputer. Akhirnya, pada tahun 1996 secara resmi jurusan ini berganti nama menjadi Jurusan Teknik Informatika berdasarkan Surat Keputusan Direktur Jendral Pendidikan Tinggi Nomor 224/DIKTI/Kep/1996, tanggal 11 Juli 1996.</p>
                <p></p>
                <p>Selain program Sarjana (S1), Jurusan Teknik Informatika juga menyelenggarakan program Pasca Sarjana (S2) yang dirintis sejak tahun 1994, dengan surat keputusan Direktur Jendral Pendidikan Tinggi No. 2851/D/T/2001. Dan pada tahun 2011, Jurusan Teknik Informatika mulai menyelenggarakan program Doktor (S3). Selain itu, program studi terbaru yakni Rekayasa Perangkat Lunak (S1) dan Rekayasa Kecerdasan Artifisial (S1) diselenggarakan mulai tahun 2023.</p>
            </article>
            <article class="about-card">
                <h2>Visi</h2>
                <p>Sejalan dengan visi ITS yaitu menjadi perguruan tinggi dengan reputasi internasional dalam ilmu pengetahuan, teknologi, dan seni, terutama yang menunjang industri dan kelautan yang berwawasan lingkungan, maka  visi Departemen Informatika adalah menjadi inovator bidang informatika yang unggul di tingkat nasional dengan reputasi internasional, serta berperan aktif dalam upaya memajukan dan mensejahterakan bangsa</p>

                <p>Visi Departemen Teknik Informatika (DTIF) berfokus untuk menjadi lembaga pendidikan yang unggul dan inovatif-inventif dalam informatika cerdas, mendukung transformasi digital dan berkontribusi kepada masyarakat dengan reputasi internasional.</p>
            </article>
            <article class="about-card">
                <h2>Misi</h2>
                <p>DTIF memiliki misi sebagai berikut:</p>
                <ol>
                    <li>Menyelenggarakan proses pembelajaran yang berkualitas, dan memenuhi standar nasional maupun internasional,</li>
                    <li>Melaksanakan penelitian yang inovatif, bermutu, dan bermanfaat,</li>
                    <li>Meningkatkan pemanfaatan teknologi informasi dan komunikasi untuk masyarakat,</li>
                    <li>Menjalin kemitraan dengan berbagai lembaga, baik di dalam maupun di luar negeri.</li>
                </ol>
            </article>
        </div>
    </section>
@endsection
