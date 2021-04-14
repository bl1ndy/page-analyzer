<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlCheckControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function testStore()
    {
        Http::fake();

        $data = [
            'url_id' => 1,
            'url_name' => 'https://www.example.com/'
        ];

        $dataForStorage = [
            'url_id' => 1,
            'status_code' => 200
        ];

        $response = $this->post('/urls/{url}/checks', $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('url_checks', $dataForStorage);
    }
}
