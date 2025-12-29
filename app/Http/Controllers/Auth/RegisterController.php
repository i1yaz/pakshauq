<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use App\Models\Admin\Club;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Admin\Tournament;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5'],
        ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new Response('', 201)
            : redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (Auth::user()->club_id > 0) {
            $data['club'] = 0;
            $data['created_by'] = Auth::user()->id;
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => strtolower($data['username']),
            'email' => $data['email'],
            'phone' => $data['phone'],
            'city' => $data['city'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => Carbon::now(),
            'club_id' => $data['club'] ?? 0,
            'created_by' => $data['created_by'] ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        $this->tournamentModerator($user, $data);
        return $user;
    }

    /**
     * Tournament managed by this user
     *
     * @param User $user $var Description
     **/
    public function tournamentModerator(User $user, $data)
    {
        if (request()->tournament == null) {
            return false;
        }
        foreach ($data['tournament'] as $tournament_id) {
            DB::table('tournament_moderator')->insert([
                'user_id' => $user->id,
                'tournament_id' => $tournament_id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }

        /**
     * Clubs managed by this user
     *
     * @param User $user $var Description
     **/
    public function clubModerator(User $user, $data)
    {
        if (request()->club == null) {
            return false;
        }
        foreach ($data['club'] as $tournament_id) {
            DB::table('club_moderator')->insert([
                'user_id' => $user->id,
                'club_id' => $tournament_id,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]);
        }
    }
    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        return redirect()->back()->with('success', 'Admin has been created!');
    }
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        

        if(Auth::user()->club_id > 0){
            $tournaments = Tournament::where('club_id',Auth::user()->club_id)->where('status',true)->get();
            return view('admin.club_admin.user.create', compact('tournaments'));
        }else{
            $tournaments = Tournament::where('status',true)->get();
            $clubs = Club::where('status',true)->get();
            return view('admin.user.create', compact('tournaments','clubs'));
        }
        
    }
}
