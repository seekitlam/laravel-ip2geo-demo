<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ip2geo;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\Response;
use Symfony\Component\HttpKernel\Attribute\WithHttpStatus;

class Ip2geoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();

        \App\Models\Ip2geo::factory()->create([
            'ip' => '192.168.1.1'
        ]);
    }

    public function testIndexMethodReturnsView()
    {
        Http::fake([
            'http://ip-api.com/json/192.168.1.1' => Http::response(['status' => 'success'], 200)
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('ip2geo');
    }

    public function testIndexMethodReturns500()
    {
        Http::fake([
            'http://ip-api.com/json/192.168.1.1' => Http::response(['status' => 'fail'], 200)
        ]);

        $response = $this->get('/');

        $response->assertStatus(500);
    }

    public function testIndexMethodReturns404()
    {
        Ip2geo::destroy(1);

        $response = $this->get('/');

        $response->assertStatus(404);
    }

    // public function testIndexMethodReturnsRequestException()
    // {
    //     Http::fake([
    //         'http://ip-api.com/json/192.168.1.1' => Http::throw(
    //             new RequestException(new Response(501, ['Content-Type' => 'application/json'], '{"status": "fail"}')
    //             )
    //             )
    //     ]);

    //     $response = $this->get('/');

    //     $response->assertStatus(501);
    // }
}
