<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DemoUserSeeder::class);

        $wira = User::firstOrCreate(
            ['email' => 'wira@student.its.ac.id'],
            [
                'name' => 'Wira Mahasiswa',
                'role' => 'mahasiswa',
                'password' => 'password',
            ]
        );

        $wira->projects()->firstOrCreate(
            ['judul' => 'Asisten Akademik'],
            [
                'deskripsi' => 'Ide proyek agentic ai untuk membantu kegiatan akademik',
                'tema_agent' => 'Ollama',
                'api_key_secure' => null,
            ]
        );

        foreach (range(1, 15) as $number) {
            $student = User::firstOrCreate(
                ['email' => sprintf('week6.mahasiswa.%02d@student.its.ac.id', $number)],
                [
                    'name' => fake()->name(),
                    'role' => 'mahasiswa',
                    'password' => 'password',
                ]
            );

            $projectsToCreate = max(0, 2 - $student->projects()->count());

            if ($projectsToCreate > 0) {
                $student->projects()->saveMany(
                    Project::factory()->count($projectsToCreate)->make()
                );
            }
        }

        $demoLecturer = User::firstOrCreate(
            ['email' => 'dosenpbkk@its.ac.id'],
            [
                'name' => 'Dosen PBKK',
                'role' => 'dosen',
                'password' => 'password',
            ]
        );

        foreach ([
            [
                'judul' => 'Asisten Riset Agentic AI',
                'deskripsi' => 'Asisten untuk membantu pencarian dan perangkuman referensi penelitian.',
                'tema_agent' => 'Ollama',
            ],
            [
                'judul' => 'Perencana Akademik Cerdas',
                'deskripsi' => 'Agent untuk menyusun rencana studi berdasarkan prasyarat mata kuliah.',
                'tema_agent' => 'OpenAI',
            ],
        ] as $project) {
            $demoLecturer->projects()->firstOrCreate(
                ['judul' => $project['judul']],
                [
                    'deskripsi' => $project['deskripsi'],
                    'tema_agent' => $project['tema_agent'],
                    'api_key_secure' => null,
                ]
            );
        }
    }
}
