<?php

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('seeds fifteen students with two projects each and a lecturer portfolio', function () {
    $this->seed();

    $this->assertDatabaseHas('users', [
        'email' => 'andi@example.com',
        'role' => 'mahasiswa',
    ]);

    $students = User::where('email', 'like', 'week6.mahasiswa.%@student.its.ac.id')
        ->orderBy('email')
        ->get();

    expect($students)->toHaveCount(15);

    foreach ($students as $student) {
        expect($student->role)->toBe('mahasiswa')
            ->and($student->projects)->toHaveCount(2)
            ->and($student->projects->every(fn (Project $project) => $project->user_id === $student->id))->toBeTrue();
    }

    $lecturer = User::where('email', 'dosenpbkk@its.ac.id')->firstOrFail();

    expect($lecturer->role)->toBe('dosen')
        ->and($lecturer->projects)->toHaveCount(2)
        ->and(Hash::check('password', $lecturer->password))->toBeTrue();
});

it('can run the database seeder repeatedly without duplicating challenge data', function () {
    $this->seed();
    $this->seed();

    expect(User::where('email', 'like', 'week6.mahasiswa.%@student.its.ac.id')->count())->toBe(15)
        ->and(Project::whereHas('user', fn ($query) => $query->where('email', 'dosenpbkk@its.ac.id'))->count())->toBe(2);

    foreach (User::where('email', 'like', 'week6.mahasiswa.%@student.its.ac.id')->get() as $student) {
        expect($student->projects()->count())->toBe(2);
    }
});

it('shows only the authenticated users projects on the dashboard', function () {
    $owner = User::factory()->create(['role' => 'mahasiswa']);
    $otherUser = User::factory()->create(['role' => 'mahasiswa']);

    $ownerProject = $owner->projects()->create([
        'judul' => 'Project Milik Saya',
        'deskripsi' => 'Hanya pemilik yang boleh melihatnya pada dashboard.',
    ]);
    $otherUser->projects()->create([
        'judul' => 'Project Milik Orang Lain',
        'deskripsi' => 'Tidak boleh tampil pada dashboard pemilik pertama.',
    ]);

    $this->actingAs($owner)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee($ownerProject->judul)
        ->assertDontSee('Project Milik Orang Lain');
});
