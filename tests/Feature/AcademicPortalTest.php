<?php

use App\Models\Proposal;
use App\Models\User;
use Database\Seeders\DemoUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('registers new users as mahasiswa even when a privileged role is submitted', function () {
    $this->post(route('register'), [
        'name' => 'New Student',
        'email' => 'new-student@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role' => 'dosen',
    ])->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'new-student@example.com',
        'role' => 'mahasiswa',
    ]);
});

it('seeds the requested demo users with their roles and shared password', function () {
    $this->seed(DemoUserSeeder::class);

    foreach ([
        'andi@example.com' => ['Andi', 'mahasiswa'],
        'budi@example.com' => ['Budi', 'mahasiswa'],
        'asdos@example.com' => ['Asdos', 'asdos'],
        'dosen@example.com' => ['Dosen', 'dosen'],
    ] as $email => [$name, $role]) {
        $user = User::where('email', $email)->firstOrFail();

        expect($user->name)->toBe($name)
            ->and($user->role)->toBe($role)
            ->and(Hash::check('password', $user->password))->toBeTrue();
    }
});

it('authenticates the seeded users through the Breeze login form', function () {
    $this->seed(DemoUserSeeder::class);

    foreach (['andi', 'budi', 'asdos', 'dosen'] as $username) {
        $user = User::where('email', $username.'@example.com')->firstOrFail();

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect(route('dashboard', absolute: false));

        $this->assertAuthenticatedAs($user);
        $this->post(route('logout'));
        $this->assertGuest();
    }
});

it('protects admin routes from guests and students but allows asdos and dosen', function () {
    $this->get(route('admin.index'))->assertRedirect(route('login'));

    $student = User::factory()->create(['role' => 'mahasiswa']);
    $this->actingAs($student)->get(route('admin.index'))->assertForbidden();

    foreach (['asdos', 'dosen'] as $role) {
        $user = User::factory()->create(['role' => $role]);

        $this->actingAs($user)
            ->get(route('admin.index'))
            ->assertOk();
    }
});

it('assigns new proposals to the signed-in student and restricts title edits to their owner', function () {
    $owner = User::factory()->create(['role' => 'mahasiswa']);
    $otherStudent = User::factory()->create(['role' => 'mahasiswa']);

    $this->actingAs($owner)
        ->post(route('proposals.store'), [
            'title' => 'AI Study Assistant',
            'description' => 'An assistant for course materials.',
            'user_id' => $otherStudent->id,
        ])
        ->assertRedirect(route('dashboard'));

    $proposal = Proposal::firstOrFail();
    expect($proposal->user_id)->toBe($owner->id);

    $this->get(route('proposals.edit', $proposal))->assertOk();
    $this->patch(route('proposals.update', $proposal), ['title' => 'Updated AI Study Assistant'])
        ->assertRedirect(route('dashboard'));
    expect($proposal->fresh()->title)->toBe('Updated AI Study Assistant');

    $this->actingAs($otherStudent)
        ->patch(route('proposals.update', $proposal), ['title' => 'Unauthorized edit'])
        ->assertForbidden();
});

it('shows the grade entry navigation only to staff and allows staff to record grades', function () {
    $student = User::factory()->create(['role' => 'mahasiswa']);
    $proposal = Proposal::create([
        'user_id' => $student->id,
        'title' => 'AI Study Assistant',
    ]);

    $this->actingAs($student)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertDontSee(route('admin.grades.index'));

    $asdos = User::factory()->create(['role' => 'asdos']);
    $this->actingAs($asdos)
        ->get(route('dashboard'))
        ->assertOk()
        ->assertSee(route('admin.grades.index'));

    $this->patch(route('admin.grades.update', $proposal), ['grade' => 92.5])
        ->assertRedirect(route('admin.grades.index'));

    expect((float) $proposal->fresh()->grade)->toBe(92.5);
});

it('keeps the query-parameter local demo separate from authenticated users', function () {
    $this->get(route('local-login'))
        ->assertOk();
    $this->assertGuest();

    $this->get(route('home', ['user' => 'Andi']))
        ->assertOk()
        ->assertSee('Selamat datang, Andi!');
    $this->assertGuest();

    $signedInUser = User::factory()->create(['name' => 'Authenticated Student', 'role' => 'mahasiswa']);
    $this->actingAs($signedInUser)
        ->get(route('home', ['user' => 'Andi']))
        ->assertSee('Selamat datang, Authenticated Student!');
});
