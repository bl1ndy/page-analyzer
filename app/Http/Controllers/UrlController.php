<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('url.index', [
            'urls' => DB::table('urls')->paginate(5)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'url.name' => 'required|unique:urls,name'
        ]);

        DB::table('urls')->insert([
            'name' => $data['url']['name'],
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ]);

        flash('Url added successfully')->success();

        return redirect()->route('urls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = DB::table('urls')
            ->where('id', '=', $id)
            ->get();

        return view('url.show', ['url' => $url]);
    }
}
