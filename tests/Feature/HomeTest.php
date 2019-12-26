<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the homepage of the site.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test login page.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test register page.
     *
     * @return void
     */
    public function testRegisterPage()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    /**
     * Test forgot password page.
     *
     * @return void
     */
    public function testForgotPasswordPage()
    {
        $response = $this->get('/password/reset');
        $response->assertStatus(200);
    }
}
