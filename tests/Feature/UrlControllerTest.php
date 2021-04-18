<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UrlControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function testIndex(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testShow(): void
    {
        $response = $this->get(route('urls.show', ['url' => 1]));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = [
            'url' => [
                'name' => 'https://urlfortest.com/'
            ]
        ];

        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('urls', $data['url']);
    }
}
