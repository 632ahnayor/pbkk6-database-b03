<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgentController extends Controller
{
    
    public function agent($tema = null) {
        $options = [
            'gmail' => [
                'pageTitle' => 'Gmail Inbox Manager',
                'title' => 'Gmail Inbox Manager',
                'subtitle' => 'Project Idea v3.0',
                'cards' => [
                    [
                        'title' => 'Project Overview',
                        'text' => 'Sistem yang dirancang ini adalah agentic AI inbox manager otonom yang dibuat untuk mengubah Gmail dari tugas harian yang menyita waktu menjadi platform komunikasi cerdas yang rapi secara otomatis. Berbeda dari aplikasi email biasa yang mengandalkan filter kaku dan aturan pasif, asisten AI ini bekerja secara proaktif dan mampu mengambil keputusan yang lebih alami sesuai preferensi dan konteks pengguna. Kemampuan utamanya berfokus pada dua hal: memilah tumpukan email secara otomatis—seperti spam, junk promosi, hingga thread lama yang sudah tidak relevan—serta menangani email masuk melalui fitur pembalasan otomatis yang kontekstual. Dengan mengambil alih tugas pemeliharaan inbox yang rutin ini, proyek ini mampu memangkas beban administratif digital, membantu pengguna menjaga target "Inbox Zero" secara konsisten, dan memastikan pesan-pesan penting tetap mendapat respons yang cepat dan akurat.'
                    ],
                    [
                        'title' => 'Problem & Solution',
                        'text' => 'Banyak profesional menghabiskan hingga 28% waktu kerja mereka hanya untuk mengurus email yang menumpuk—mulai dari memilah promosi, spam yang lolos filter, hingga pesan lama yang sudah kedaluwarsa. Di sisi lain, keterlambatan membalas pesan penting sering kali membuat peluang berharga terlewat, sementara fitur auto-reply biasa terlalu kaku untuk menjawab pertanyaan yang butuh penanganan spesifik. Solusi yang ditawarkan menjawab kedua kendala ini melalui pembersihan inbox secara otomatis sekaligus komunikasi yang kontekstual. Agen AI ini akan terus memindai email masuk maupun arsip lama untuk menyaring junk dan mengarsipkan pesan kusam berdasarkan kebijakan retensi yang fleksibel. Begitu ada email penting masuk, sistem langsung menganalisis riwayat percakapan, menangkap inti pesannya, lalu menyusun atau mengirim balasan yang personal dan sesuai konteks—memangkas waktu respons sekaligus menjaga inbox utama tetap bersih dan fokus pada hal-hal penting.'
                    ],
                    [
                        'title' => 'Technical Architecture',
                        'text' => 'Dari sisi teknis, sistem ini menerapkan arsitektur agen Reasoning and Acting (ReAct) berbasis LLM untuk merencanakan dan mengeksekusi tindakan melalui Gmail REST API dengan protokol keamanan OAuth 2.0. Untuk mengklasifikasikan email, agen ini menggabungkan vector embeddings dengan model bahasa kontekstual, sehingga kemampuannya jauh melampaui filter kata kunci biasa dalam menilai maksud, sentimen, dan tingkat urgensi pesan. Pada proses pembalasan otomatis, sistem memanfaatkan Retrieval-Augmented Generation (RAG) untuk mengambil konteks dari riwayat interaksi sebelumnya maupun basis data pengguna, memastikan pesan yang dihasilkan tetap relevan dan akurat. Terakhir, aspek keamanan dan kendali pengguna dijaga melalui mekanisme Human-in-the-Loop (HITL), di mana tindakan berrisiko tinggi atau pesan dengan tingkat keyakinan rendah akan diarahkan ke dashboard pengguna untuk dikonfirmasi terlebih dahulu, lengkap dengan pemfilter data pribadi (PII) untuk mencegah kebocoran informasi sensitif.'
                    ],
                    
                ],
            ],
            'local-junk' => [
                'pageTitle' => 'ByeByeCleaner: Local Junk File Manager',
                'title' => 'ByeByeCleaner: Local Junk File Manager',
                'subtitle' => 'Project Idea v2.0',
                'cards' => [
                    [
                        'title' => 'Q: Apa itu ByeByeCleaner?',
                        'text' => 'A: ByeByeCleaner adalah asisten AI otonom berbasis lokal yang mengelola dan merapikan tumpukan file usang di perangkat pengguna. Berbeda dari pembersih biasa yang hanya menghapus file besar, agen ini memahami konteks file untuk memberikan rekomendasi tindakan yang relevan—apakah sebuah file sebaiknya dibuang ke Trash, diarsipkan, atau di-backup ke cloud.'
                    ],
                    [
                        'title' => 'Q: Masalah apa yang diselesaikan oleh produk ini?',
                        'text' => 'A: Banyak orang kehabisan ruang penyimpanan bukan karena kekurangan kapasitas, melainkan karena kelelahan mengambil keputusan (decision fatigue) saat memilah file lama. Proses manual memakan waktu berjam-jam, sementara pembersihan massal memicu rasa takut kehilangan dokumen penting.'
                    ],
                    [
                        'title' => 'Q: Apa bedanya ByeByeCleaner dengan aplikasi bawaan seperti Disk Cleanup atau CleanMyMac?',
                        'text' => 'A: Aplikasi tradisional menggunakan filter kaku berbasis tanggal atau ekstensi. ByeByeCleaner menggunakan Agentic AI untuk analisis berbasis konteks.'
                    ],
                    
                ],
            ],
        ];

        $data = $options[strtolower($tema ?? '')] ?? [
            'pageTitle' => 'General Assistant Agent',
            'title' => 'General Assistant Agent',
            'subtitle' => '',
            'cards' => [
                [
                    'title' => 'Versatile Task Execution',
                    'text' => 'Handles daily administrative, scheduling, research, and communication tasks seamlessly to boost overall productivity.',
                ],
                [
                    'title' => 'Adaptive Workflow Integration',
                    'text' => 'Quickly aligns with specific user preferences and operational processes to deliver consistent, accurate output.',
                ],
                [
                    'title' => 'Proactive & Clear Communication',
                    'text' => 'Anticipates next steps, tracks ongoing tasks, and maintains clear status updates to keep workflows running smoothly.',
                ],
                
            ]
        ];

        return view('agent', $data);
    }
}
