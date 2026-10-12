<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(DemoUserSeeder::class);
        $user = User::factory()->create([
            'name' => 'Wira Mahasiswa',
            'email' => 'wira@student.its.ac.id',
            'role' => 'mahasiswa',
        ]);

        $user->projects()->create([
            'judul' => 'Asisten Akademik',
            'deskripsi' => 'Ide proyek agentic ai untuk membantu kegiatan akademik',
            'tema_agent' => 'Ollama',
            'api_key_secure' => null,
        ]);
    }
}
