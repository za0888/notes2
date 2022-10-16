<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use App\Policies\Permissions;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register', ['teams' => Team::all() ?? null]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],

            'team_id' => [
                'required',
                'numeric'
            ],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'team_id' => $request->team,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
    }

    public function show(Request $request, $id)
    {

        $this->authorize('view', $request->user(), $id);
    }

    public function delete(User $user)
    {
        $this->authorize('delete', $user);
    }


    public function forceDelete(User $user)
    {
        $this->authorize('delete', $user);

    }

// $id will be resolved as user with $id
    public function update(User $user, $id)
    {
        $this->authorize('update', $user, $id);

    }

    public function edit(Request $request, $id)
    {
        $user = $request?->user();
        $this->authorize('edit', $user, $id);

        return view('components.user.edit', ['user' => $user]);
    }

    public function restore(User $user)
    {
        $this->authorize('delete', $user);

    }


}
