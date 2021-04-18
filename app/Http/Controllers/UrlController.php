<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('url.index', [
            'urls' => DB::table('urls')
                ->orderBy('id')
                ->paginate(5),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUrlRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUrlRequest $request)
    {
        $data = $request->validated();
        $currentDate = Carbon::now('Europe/Moscow')->toDateTimeString();
        $url = $data['url']['name'];

        if (DB::table('urls')->where('name', $url)->exists()) {
            $urlId = DB::table('urls')
                ->where('name', '=', $url)
                ->first()
                ->id;
            flash('Url already exists')->success();
            return redirect()->route('urls.show', $urlId);
        }

        DB::table('urls')->insert([
            'name' => $url,
            'created_at' => $currentDate,
            'updated_at' => $currentDate
        ]);

        flash('Url added successfully')->success();

        return redirect()->route('urls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $url = DB::table('urls')
            ->where('id', '=', $id)
            ->first();

        $checks = DB::table('url_checks')
            ->where('url_id', '=', $id)
            ->orderByDesc('created_at')
            ->paginate(5);

        return view(
            'url.show',
            [
                'url' => $url,
                'checks' => $checks,
            ]
        );
    }
}
