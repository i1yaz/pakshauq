<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Setting;
use App\Services\TournamentService;
use App\Services\WebsiteService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    // Middleware for Admin
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sliders = (new TournamentService())->getAllSliders();
        $settings = Setting::get();
        return view('admin.website.index', compact('sliders', 'settings'));
    }
    public function create()
    {
        return view('admin.website.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sliders.*' => 'file|image'
        ]);
        $response = (new TournamentService())->storeSliders($request);
        WebsiteService::flushCache();
        if ($response) {
            return redirect('admin/website')->with('success', 'Sliders has been added!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
    public function autoUpdateTime(Request $request)
    {
        $response = Setting::updateOrCreate(
            ['key' => 'auto_update_time'],
            [
                'group_type' => Setting::AUTO_UPDATE_TIME_GROUP,
                'value' => $request->auto_update_time
            ]
        );
        WebsiteService::flushCache();
        if ($response) {
            return redirect('admin/website')->with('success', 'Setting has been saved!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
    public function firstWinnerLastWinnerConditions(Request $request)
    {

        $response1 = Setting::updateOrCreate(
            ['key' => "first_{$request->pigeons}",'type' => $request->pigeons],
            [
                'value' => $request->first_winner_condition,
                'group_type' => Setting::FIRST_WINNER_LAST_WINNER_GROUP,
                'type' => $request->pigeons,
                'description' => "First Winner Condition",
            ]
        );

        $response2 = Setting::updateOrCreate(
            ['key' => "last_{$request->pigeons}",'type' => $request->pigeons],
            [
                'value' => $request->last_winner_condition,
                'group_type' => Setting::FIRST_WINNER_LAST_WINNER_GROUP,
                'type' => $request->pigeons,
                'description' => "Last Winner Condition",
            ]
        );
        WebsiteService::flushCache();
        if ($response1 && $response2) {
            return redirect('admin/website')->with('success', 'Setting has been saved!');
        } else {
            return redirect()->back()->withErrors('Something is wrong!');
        }
    }
}
