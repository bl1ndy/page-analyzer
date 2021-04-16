<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
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

        $url = DB::table('urls')->first()->name;
        $urlId = DB::table('urls')->first()->id;
        $data = [
            'url_name' => $url
        ];

        $dataForStorage = [
            'url_id' => $urlId,
            'status_code' => 200
        ];

        $response = $this->post('/urls/{url}/checks', $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $this->assertDatabaseHas('url_checks', $dataForStorage);
    }
}
