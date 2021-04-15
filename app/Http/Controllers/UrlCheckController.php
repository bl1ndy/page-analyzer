<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use DiDom\Document;
use DiDom\Query;
use Carbon\Carbon;
use Illuminate\Http\Client\ConnectionException;

class UrlCheckController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $urlId = $request->input()['url_id'];
        $url = $request->input()['url_name'];
        $currentDate = Carbon::now()->toDateTimeString();

        try {
            $statusCode = Http::get($url)->status();
        } catch (ConnectionException $e) {
            flash('Can not resolve this URL. Please, try again later')->error();
            return redirect()->route('urls.show', ['url' => $urlId]);
        }

        $document = new Document();
        $document->loadHtmlFile($url);

        $h1 = $document->has('h1')
            ? $document->find('h1')[0]->text()
            : null;
        $keywords = $document->has('//meta[@name="keywords"]', 'XPATH')
            ? $document->find('//meta[@name="keywords"]', Query::TYPE_XPATH)[0]->getAttribute('content')
            : null;
        $description = $document->has('//meta[@name="description"]', 'XPATH')
            ? $document->find('//meta[@name="description"]', Query::TYPE_XPATH)[0]->getAttribute('content')
            : null;


        DB::table('url_checks')->insert([
            'url_id' => $urlId,
            'status_code' => $statusCode,
            'h1' => $h1,
            'keywords' => $keywords,
            'description' => $description,
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        DB::table('urls')
            ->where('id', '=', $urlId)
            ->update([
                'last_check' => $currentDate,
                'last_status_code' => $statusCode
            ]);

        flash('Url checked successfully')->success();

        return redirect()->route('urls.show', ['url' => $urlId]);
    }
}
