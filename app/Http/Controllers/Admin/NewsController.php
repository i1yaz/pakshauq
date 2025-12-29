<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\News;
use App\Services\TournamentService;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    // Middleware for Admin
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = (new TournamentService())->getAllNews();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $response = (new TournamentService())->storeNews($request);
        if ($response) {
            return redirect('admin/news')->with('success', 'News has been added!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $response = (new TournamentService())->updateNews($request, $news);
        if ($response) {
            return redirect('admin/news')->with('success', 'Changes saved!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            return redirect()->back()->with('success', 'News has been deleted!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
}
