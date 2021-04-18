<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class UrlCheckControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate');
    }

    public function testStore(): void
    {
        $currentDate = Carbon::now('Europe/Moscow')->toDateTimeString();
        $data = [
            'id' => 1,
            'name' => 'http://test.com',
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ];
        $id = DB::table('urls')->insertGetId($data);
        $url = $data['name'];
        $expected = [
            'url_id'   => $id,
            'status_code' => 200,
            'keywords'    => 'url, check, store, test',
            'h1'          => 'URL check store test',
            'description' => 'url check store test',
        ];
        $expectedInUrls = [
            'last_check' => $currentDate,
            'last_status_code' => 200
        ];
        $html = file_get_contents(__DIR__ . '/../fixtures/url_check_test.html');

        Http::fake([$url => Http::response($html)]);
        $response = $this->post(route('urls.checks.store', $id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('url_checks', $expected);
        $this->assertDatabaseHas('urls', $expectedInUrls);
    }
}
