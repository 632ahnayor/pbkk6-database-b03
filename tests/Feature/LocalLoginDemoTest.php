<?php

it('shows the local login demo choices without authenticating', function () {
    $this->get(route('local-login'))
        ->assertOk()
        ->assertSee('Local Login Demo')
        ->assertSee('href="'.route('home', ['user' => 'Guest']).'"', false)
        ->assertSee('href="'.route('home', ['user' => 'Andi']).'"', false)
        ->assertSee('href="'.route('home', ['user' => 'Budi']).'"', false);

    $this->assertGuest();
});

it('uses the selected query user on the home page without authenticating', function (string $user) {
    $this->get(route('home', ['user' => $user]))
        ->assertOk()
        ->assertSee('Selamat datang, '.$user.'!');

    $this->assertGuest();
})->with(['Guest', 'Andi', 'Budi']);

it('links the demo after the feedback form in the week four navigation', function () {
    $this->get(route('local-login'))
        ->assertOk()
        ->assertSeeInOrder([
            'href="'.route('form.get').'">Form Masukan</a>',
            'href="'.route('local-login').'">Local Login Demo</a>',
        ], false);
});
