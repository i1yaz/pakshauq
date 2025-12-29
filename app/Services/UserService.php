<?php

namespace App\Services;

use App\Models\Admin\Tournament;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function destroy(User $user)
    {
        if (Auth::user()->super_admin && $user->id != 1) {
            return $user->delete();
        }
    }
    public function update(Request $request, User $user)
    {
        if (Auth::user()->super_admin || Auth::id() == $user->id || Auth::id() == $user->created_by) {
            $user = User::find($user->id);
            $user->name = $request->name;
            $user->username = strtolower($request->username);
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->city = $request->city;
            $user->password = Hash::make($request->password);
            $user->club_id = $request->club ?? 0;
            $user->update();
            $this->tournamentModerator($user, $request);
            return true;
        }
    }

    public function destroyTournamentManagedByThisUser(User $user)
    {
        return DB::table('tournament_moderator')->where('user_id', $user->id)->delete();
    }

    public function tournamentModerator(User $user, $request)
    {
        $this->destroyTournamentManagedByThisUser($user);
        if ($request->tournament == null) {
            return true;
        }
        foreach ($request->tournament as $tournament_id) {
            DB::table('tournament_moderator')->insert([
                'user_id' => $user->id,
                'tournament_id' => $tournament_id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
        return true;
    }
    public function getTournaments()
    {
        return Tournament::get();
    }
    public function getTournamentsOfThisUser(User $user)
    {
        return DB::table('tournament_moderator')->where('user_id', $user->id)->get();
    }
    
}
