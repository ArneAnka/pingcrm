<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        // $hej = User::whereId(1)->with(['ip' => function($q){
        //     return $q->latest()->first();
        // }])->get();
        // dd($hej);
        return Inertia::render('Users/Index', [
            'filters' => Request::all('search', 'verified', 'trashed'),
            'users' => User::orderBy('name')
                ->filter(Request::only('search', 'verified', 'trashed'))
                ->get()
                ->transform(fn ($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'email_verified_at' => boolval($user->email_verified_at),
                    'photo' => $user->profile_photo_path ? URL::route('image', ['path' => $user->profile_photo_path, 'w' => 40, 'h' => 40, 'fit' => 'crop']) : null,
                    'active' => $user->ip()->latest()->first(),
                    'deleted_at' => $user->deleted_at,
                ]),
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')],
            'password' => ['nullable'],
            'photo' => ['nullable', 'image'],
        ]);

        Auth::user()->create([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'password' => Request::get('password'),
            'profile_photo_path' => Request::file('photo') ? Request::file('photo')->store('profile-photos') : null,
        ]);

        return Redirect::route('users')->with('success', 'User created.');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'photo' => $user->profile_photo_path ? URL::route('image', ['path' => $user->profile_photo_path, 'w' => 60, 'h' => 60, 'fit' => 'crop']) : null,
                'deleted_at' => $user->deleted_at,
                'ip_addresses' => $user->ip
            ],
        ]);
    }

    public function update(User $user)
    {
        Request::validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable'],
            'photo' => ['nullable', 'image'],
            'email_verified_at' => ['boolean']
        ]);

        // $user->update(Request::only('name', 'email', 'email_verified_at'));
        $user->update([
            'name' => Request::get('name'),
            'email' => Request::get('email'),
            'email_verified_at' => Request::get('email_verified_at') ? Carbon::now() : NULL,
        ]);

        if (Request::file('photo')) {
            $user->update(['profile_photo_path' => Request::file('photo')->store('profile-photos')]);
        }

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return Redirect::back()->with('success', 'User deleted.');
    }

    public function restore(User $user)
    {
        $user->restore();

        return Redirect::back()->with('success', 'User restored.');
    }
}
