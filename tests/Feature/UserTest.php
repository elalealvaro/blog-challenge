<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function testUserProfilePage()
    {
        $user = factory(User::class)->create();
        $response = $this->get($user->permalink);
        $response->assertStatus(200);
    }

    /**
     * Test that a user can login on the site.
     */
    public function testUserCanLogin()
    {
        $user_data = [
            'email' => 'testuser1@test.com',
            'password' => 'password'
        ];

        factory(User::class)->create($user_data);
        $response = $this->post('/login', $user_data);

        $response->assertStatus(302);
    }

    /**
     * Test that a user can register on the site.
     */
    public function testUserCanRegister()
    {
        $response = $this->post('/register', [
            'username' => 'testuser1',
            'email' => 'testuser1@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $this->assertCount(1, User::all());
    }

    /**
     * Test that short passwords does not work on registration form.
     */
    public function testShortPasswordFailsOnRegistration()
    {
        $response = $this->post('/register', [
            'username' => 'testuser1',
            'email' => 'testuser1@test.com',
            'password' => 'abc',
            'password_confirmation' => 'abc'
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }

    /**
     * Test that a wrong email does not work on registration form.
     */
    public function testWrongEmailFailsOnRegistration()
    {
        $response = $this->post('/register', [
            'username' => 'testuser1',
            'email' => 'wrongemail',
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, User::all());
    }

    /**
     * Test that different password and confirmation password does not work on registration form.
     */
    public function testDifferentPasswordsFailsOnRegistration()
    {
        $response = $this->post('/register', [
            'username' => 'testuser1',
            'email' => 'testuser1@test.com',
            'password' => 'password1',
            'password_confirmation' => 'password2'
        ]);

        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }
}
