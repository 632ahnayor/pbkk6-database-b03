@extends('layouts.app')

@section('title', $pageTitle)

@section('content')
<style>
    main {
        padding: 0;
    }

    .project-page {
        --project-background: white;
        --project-card-background: white;
        --project-border: #e0e7ef;
        --project-heading: #023880;
        --project-text: #536273;
        min-height: 100vh;
        padding: 0.1px 0;
        background: var(--project-background);
    }

    .project-page--dark {
        --project-background: #111827;
        --project-card-background: #1f2937;
        --project-border: #374151;
        --project-heading: #bfdbfe;
        --project-text: #d1d5db;
    }

    .project-section {
        width: min(1100px, calc(100% - 2rem));
        margin: 0 auto 3rem;
    }

    .project-section__header {
        margin-bottom: 1.25rem;
        margin-top: 1.25rem;
    }

    .project-section__header h1 {
        margin: 0 0 0.25rem;
        color: var(--project-heading);
        font-weight: bolder;
        font-size:xx-large;
    }

    .project-section__header p {
        margin: 0;
        color: var(--project-text);
        line-height: 1.5;
        font-size: large;
    }

    .project-card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr));
        gap: 1.25rem;
    }

    .project-card {
        padding: clamp(1.5rem, 3vw, 2rem);
        border: 1px solid var(--project-border);
        border-radius: 12px;
        background: var(--project-card-background);
        box-shadow: 0 8px 24px rgb(2 56 128 / 7%);
    }

    .project-card h2 {
        margin: 0 0 0.75rem;
        color: var(--project-heading);
        font-size: 1.25rem;
        font-weight: bold;
    }

    .project-card ol,
    .project-card p {
        margin: 0;
        color: var(--project-text);
        line-height: 1.65;
    }
</style>

<div @class(['project-page', 'project-page--dark' => $mode === 'dark'])>
<section class="project-section">
    <header class="project-section__header">
        <h1>Gmail Inbox Manager</h1>
        <p>Project Idea v3.0</p>
    </header>
    <div class="project-card-grid">
        <article class="project-card">
            <h2>Project Overview</h2>
            <p>Sistem yang dirancang ini adalah agentic AI inbox manager otonom yang dibuat untuk mengubah Gmail dari tugas harian yang menyita waktu menjadi platform komunikasi cerdas yang rapi secara otomatis. Berbeda dari aplikasi email biasa yang mengandalkan filter kaku dan aturan pasif, asisten AI ini bekerja secara proaktif dan mampu mengambil keputusan yang lebih alami sesuai preferensi dan konteks pengguna. Kemampuan utamanya berfokus pada dua hal: memilah tumpukan email secara otomatis—seperti spam, junk promosi, hingga thread lama yang sudah tidak relevan—serta menangani email masuk melalui fitur pembalasan otomatis yang kontekstual. Dengan mengambil alih tugas pemeliharaan inbox yang rutin ini, proyek ini mampu memangkas beban administratif digital, membantu pengguna menjaga target "Inbox Zero" secara konsisten, dan memastikan pesan-pesan penting tetap mendapat respons yang cepat dan akurat.</p>
        </article>
        <article class="project-card">
            <h2>Problem & Solution</h2>
            <p>Banyak profesional menghabiskan hingga 28% waktu kerja mereka hanya untuk mengurus email yang menumpuk—mulai dari memilah promosi, spam yang lolos filter, hingga pesan lama yang sudah kedaluwarsa. Di sisi lain, keterlambatan membalas pesan penting sering kali membuat peluang berharga terlewat, sementara fitur auto-reply biasa terlalu kaku untuk menjawab pertanyaan yang butuh penanganan spesifik. Solusi yang ditawarkan menjawab kedua kendala ini melalui pembersihan inbox secara otomatis sekaligus komunikasi yang kontekstual. Agen AI ini akan terus memindai email masuk maupun arsip lama untuk menyaring junk dan mengarsipkan pesan kusam berdasarkan kebijakan retensi yang fleksibel. Begitu ada email penting masuk, sistem langsung menganalisis riwayat percakapan, menangkap inti pesannya, lalu menyusun atau mengirim balasan yang personal dan sesuai konteks—memangkas waktu respons sekaligus menjaga inbox utama tetap bersih dan fokus pada hal-hal penting.</p>
        </article>
        <article class="project-card">
            <h2>Technical Architecture</h2>
            <p>Dari sisi teknis, sistem ini menerapkan arsitektur agen Reasoning and Acting (ReAct) berbasis LLM untuk merencanakan dan mengeksekusi tindakan melalui Gmail REST API dengan protokol keamanan OAuth 2.0. Untuk mengklasifikasikan email, agen ini menggabungkan vector embeddings dengan model bahasa kontekstual, sehingga kemampuannya jauh melampaui filter kata kunci biasa dalam menilai maksud, sentimen, dan tingkat urgensi pesan. Pada proses pembalasan otomatis, sistem memanfaatkan Retrieval-Augmented Generation (RAG) untuk mengambil konteks dari riwayat interaksi sebelumnya maupun basis data pengguna, memastikan pesan yang dihasilkan tetap relevan dan akurat. Terakhir, aspek keamanan dan kendali pengguna dijaga melalui mekanisme Human-in-the-Loop (HITL), di mana tindakan berrisiko tinggi atau pesan dengan tingkat keyakinan rendah akan diarahkan ke dashboard pengguna untuk dikonfirmasi terlebih dahulu, lengkap dengan pemfilter data pribadi (PII) untuk mencegah kebocoran informasi sensitif.</p>
        </article>
    </div>
</section>
<section class="project-section">
    <header class="project-section__header">
        <h1>ByeByeCleaner: Local Junk File Manager</h1>
        <p>Project Idea v2.0</p>
    </header>
    <div class="project-card-grid">
        <article class="project-card">
            <h2>Q: Apa itu ByeByeCleaner?</h2>
            <p>A: ByeByeCleaner adalah asisten AI otonom berbasis lokal yang mengelola dan merapikan tumpukan file usang di perangkat pengguna. Berbeda dari pembersih biasa yang hanya menghapus file besar, agen ini memahami konteks file untuk memberikan rekomendasi tindakan yang relevan—apakah sebuah file sebaiknya dibuang ke Trash, diarsipkan, atau di-backup ke cloud.</p>
        </article>
        <article class="project-card">
            <h2>Q: Masalah apa yang diselesaikan oleh produk ini?</h2>
            <p>A: Banyak orang kehabisan ruang penyimpanan bukan karena kekurangan kapasitas, melainkan karena kelelahan mengambil keputusan (decision fatigue) saat memilah file lama. Proses manual memakan waktu berjam-jam, sementara pembersihan massal memicu rasa takut kehilangan dokumen penting.</p>
        </article>
        <article class="project-card">
            <h2>Q: Apa bedanya ByeByeCleaner dengan aplikasi bawaan seperti Disk Cleanup atau CleanMyMac?</h2>
            <p>A: Aplikasi tradisional menggunakan filter kaku berbasis tanggal atau ekstensi. ByeByeCleaner menggunakan Agentic AI untuk analisis berbasis konteks.</p>
        </article>
    </div>
</section>
<section class="project-section">
    <header class="project-section__header">
        <h1>SprintSync: Team SPRINT Helper</h1>
        <p>Project Idea v1.0. Context-Based Scheduler, Inbox Manager & Meeting Setup</p>
    </header>
    <div class="project-card-grid">
        <article class="project-card">
            <h2>Problem</h2>
            <p>Freelancer dan tim sprint sering kehilangan banyak waktu setiap minggunya hanya untuk koordinasi jadwal dan menghadapi kalender yang terfragmentasi. Aplikasi penjadwalan saat ini bersifat pasif—hanya menampilkan slot kosong secara membabi buta, sehingga memecah waktu kerja fokus (deep work) dan membuat tenggat waktu proyek terganggu.</p>
        </article>
        <article class="project-card">
            <h2>What is SprintSync?</h2>
            <p>Kami membangun agentic AI penjadwal otomatis yang mengintegrasikan Email, Kalender, Task Tracker (seperti Jira/Linear/Trello), dan Zoom. Berbeda dengan kalender biasa, agen ini memahami prioritas dan deadline sprint, sehingga waktu kerja fokus diperlakukan sebagai komitmen penting yang tidak boleh sembarangan tertimpa meeting.</p>
        </article>
        <article class="project-card">
            <h2>Feature</h2>
            <p>Fitur utamanya mencakup negosiasi email mandiri (membaca permintaan masuk, menilai tingkat urgensi, dan menyepakati jadwal tanpa repot balas-membalas email), penyesuaian jadwal dinamis (menggeser rapat berprioritas rendah secara otomatis jika ada keperluan mendesak), serta orkestrasi Zoom otomatis (membuat tautan, mengatur jeda waktu antar-rapat, dan menyusun ringkasan agenda dari konteks pesan sebelumnya).</p>
        </article>
    </div>
</section>
</div>

@endsection
