<?php

it('serves the form on GET', function () {
    $this->get(route('form.get'))
        ->assertOk()
        ->assertSee('action="'.route('form.post').'"', false);
});

it('requires every form field', function () {
    $this->from(route('form.get'))
        ->post(route('form.post'), [])
        ->assertRedirect(route('form.get'))
        ->assertSessionHasErrors(['nama', 'email', 'kategori', 'pesan']);
});

it('validates form field requirements', function () {
    $this->from(route('form.get'))
        ->post(route('form.post'), [
            'nama' => 'Al',
            'email' => 'student@example.com',
            'kategori' => 'invalid',
            'pesan' => 'Too short',
        ])
        ->assertRedirect(route('form.get'))
        ->assertSessionHasErrors(['nama', 'email', 'kategori', 'pesan']);
});

it('accepts valid form data', function () {
    $this->post(route('form.post'), [
        'nama' => 'Ayu',
        'email' => 'ayu@gmail.com',
        'kategori' => 'akademik',
        'pesan' => 'Saya ingin menyampaikan masukan.',
    ])
        ->assertRedirect(route('form.get'))
        ->assertSessionHas('status', 'Masukan berhasil dikirim.');
});
