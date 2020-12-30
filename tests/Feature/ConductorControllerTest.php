<?php

namespace Tests\Feature;

use App\Models\Conductor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ConductorControllerTest extends TestCase
{
    use RefreshDatabase;

    private Conductor $conductor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->conductor = Conductor::firstOrFail();
    }

    public function testLogin()
    {
        $response = $this->post('/api/conductor/login', [
            'username' => 'juan',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
    }

    public function testLog()
    {
        Sanctum::actingAs($this->conductor);

        $response = $this->post('/api/conductor/log', [
            'id' => 1
        ]);

        $response->assertStatus(200);
    }

    public function testLogListPeriod()
    {
        Sanctum::actingAs($this->conductor);

        $response = $this->json('GET', '/api/conductor/logs', [
            'page' => 1,
            'limit' => 5,
            'from' => now()->addDays(-1)->toDateString(),
            'to' => now()->addDays(1)->toDateString(),
        ]);

        $response->assertStatus(200);
    }

    public function testLogListSearch()
    {
        Sanctum::actingAs($this->conductor);

        $response = $this->json('GET', '/api/conductor/logs', [
            'page' => 1,
            'limit' => 5,
            'search' => 'pedro'
        ]);

        $data = Arr::get($response->json(), 'list');

        $response->assertStatus(200);
        $this->assertEquals(1, count($data));

        $response = $this->json('GET', '/api/conductor/logs', [
            'page' => 1,
            'limit' => 5,
            'search' => 'tiburcio'
        ]);

        $data = Arr::get($response->json(), 'list');

        $response->assertStatus(200);
        $this->assertEquals(0, count($data));
    }

    public function testLogListByResident()
    {
        Sanctum::actingAs($this->conductor);

        $response = $this->json('GET', '/api/conductor/logs', [
            'page' => 1,
            'limit' => 5,
            'resident_id' => 1
        ]);

        $data = Arr::get($response->json(), 'list');

        $response->assertStatus(200);
        $this->assertEquals(1, count($data));
    }
}
