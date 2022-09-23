<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        return view('auth.register');
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        $this->authorize('viewAny', User::class);
    }

    public function show(Request $request,$id)
    {

        $this->authorize('view', $request->user(),$id);
    }

    public function delete(User $user)
    {
        $this->authorize('delete',$user);
    }


    public function forceDelete(User $user)
    {
        $this->authorize('delete',$user);

    }

    public function update(User $user,$id)
    {
        $this->authorize('update',$user,$id);

    }
    public function edit(Request $request,$id)
    {
        $user=$request?->user();
        $this->authorize('edit',$user,$id);

        return view('components.user.edit', ['user' => $user]);
    }

    public function restore(User $user)
    {
        $this->authorize('delete',$user);

    }


}
