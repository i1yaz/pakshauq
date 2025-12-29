<?php

namespace App\Http\Controllers\ClubAdmin;

use App\User;
use App\Models\Admin\Club;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Validation\Rule;
use App\Models\Admin\Tournament;
use Illuminate\Support\Facades\DB;
use App\Services\TournamentService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $page = request()->query('page');
        $page = ($page === null) ? 1 : $page;
        $records = 20;
        // $users = (new TournamentService())->getAllUsers($records);
        $moderators = DB::table('tournament_moderator')
                ->where('club_id', Auth::user()->club_id)
                ->join('users', 'tournament_moderator.user_id', '=', 'users.id')
                ->select('users.id', 'users.name', 'users.email', 'users.username','users.phone', 'users.created_by','users.super_admin') 
                ->distinct();
        $self = DB::table('users')
            ->where('id', Auth::id())
            ->orWhere('created_by', Auth::user()->id)
            ->select('id', 'name', 'email','username','phone','created_by','super_admin');
        $users = $moderators->union($self)->paginate($records);

        return view('admin.club_admin.user.index', compact('users', 'page', 'records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::id() == $user->created_by) {
            $tournaments = Tournament::where('club_id',Auth::user()->club_id)->where('status',true)->get();
            $tournamentsOfThisUser = (new UserService())->getTournamentsOfThisUser($user);
            return view('admin.club_admin.user.edit', compact('user', 'tournaments', 'tournamentsOfThisUser'));
        }
        return redirect()->back()->withErrors('Sorry you don\'t have permission!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['required', 'string', 'min:5'],
            'tournament' => ['sometimes', 'required']

        ]);
        $response = (new UserService())->update($request, $user);
        if ($response) {
            return redirect()->back()->with('success', 'Changes has been saved');
        } else {
            return redirect()->back()->withErrors('Sorry you don\'t have permission!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::id() == $user->created_by) {
            $response = $user->delete();
            (new UserService())->destroyTournamentManagedByThisUser($user);
        }
        if ($response) {
            return redirect()->back()->with('success', 'Admin has been deleted!');
        } else {
            return redirect()->back()->withErrors('Sorry you don\'t have permission!');
        }
    }
}
