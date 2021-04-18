<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use DiDom\Query;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;
use RuntimeException;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $url = DB::table('urls')->find($id);
        $currentDate = Carbon::now('Europe/Moscow')->toDateTimeString();

        try {
            $response = Http::get($url->name);
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');
        } catch (ConnectionException | RuntimeException $e) {
            flash('Can not resolve this URL. Please, try again later')->error();
            return redirect()->route('urls.show', $id);
        }

        DB::table('url_checks')->insert([
            'url_id' => $id,
            'status_code' => $response->status(),
            'h1' => $h1,
            'keywords' => $keywords,
            'description' => $description,
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        DB::table('urls')
            ->where('id', '=', $id)
            ->update([
                'last_check' => $currentDate,
                'last_status_code' => $response->status()
            ]);

        flash('Url checked successfully')->success();

        return redirect()->route('urls.show', $id);
    }

    /**
     * Get status code, h1, keywords & description from page
     *
     * @param string $url
     * @return array
     */
    private function getCodeAndContent($url)
    {
        $statusCode = Http::get($url)->status();

        $document = new Document();
        $document->loadHtmlFile($url);

        $h1 = optional($document->first('h1'))->text();
        $keywords = optional($document->first('meta[name=keywords]'))->getAttribute('content');
        $description = optional($document->first('meta[name=description]'))->getAttribute('content');

        return [$statusCode, $h1, $keywords, $description];
    }
}
