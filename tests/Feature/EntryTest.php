<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EntryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the page with the form to create a new entry.
     *
     * @return void
     */
    public function testNoLoggedUserCanNotSeeEntryPage()
    {
        $response = $this->get('/entry');
        $response->assertRedirect('/login');
    }

    /**
     * Test the page with the form to create a new entry.
     *
     * @return void
     */
    public function testLoggedUserCanSeeEntryPage()
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/entry');
        $response->assertStatus(200);
    }
}
