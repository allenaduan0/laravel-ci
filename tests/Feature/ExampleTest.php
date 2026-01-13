<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    // public function test_the_application_returns_a_successful_response(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    public function test_the_root_redirects_to_profiles(): void
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect(route('profiles.index'));
    }

    public function test_profiles_index_returns_ok(): void
    {
        $response = $this->get(route('profiles.index'));
        $response->assertStatus(200);
    }
}
