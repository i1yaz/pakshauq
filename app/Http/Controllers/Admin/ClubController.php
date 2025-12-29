<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Club;
use App\Services\TournamentService;
use Illuminate\Http\Request;

class ClubController extends Controller
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
    {   $page = request()->query('page');
        $page = ($page === null) ? 1 : $page;
        $records = 5;

        $clubs = (new TournamentService())->getSortedClub($records);
        return view('admin.club.index', compact('clubs', 'page', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.club.create');
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
            'sort' => 'required|integer|min:0',
            'owner' => 'required'
        ]);
        $response = (new TournamentService())->storeClub($request);
        if ($response) {
            return redirect('admin/club')->with('success', 'Club has been added!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function show(Club $club)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function edit(Club $club)
    {
        return view('admin.club.edit', compact('club'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Club $club)
    {
        $this->validate($request, [
            'name' => 'required',
            'sort' => 'required|integer|min:0',
            'owner' => 'required'
        ]);
        $response = (new TournamentService())->updateClub($request, $club);
        if ($response) {
            return redirect('admin/club')->with('success', 'Changes saved!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Club  $club
     * @return \Illuminate\Http\Response
     */
    public function destroy(Club $club)
    {
        if ($club->delete()) {
            return redirect()->back()->with('success', 'Club has been deleted!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
}
