<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class ProfileController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function get()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function patch(User $user)
    {
        $data = request()->validate([
            'firstname' => ['required', 'alpha', 'max:255'],
            'lastname' => ['required', 'alpha', 'max:255'],
            'dateofbirth' => ['required', 'date', 'before:yesterday'],
            'gender' => ['required', 'in:male,female,other'],
        ]);

        $user = Auth::user();
        $user->fill($data);
        $user->save();
        return back()->with('success','Profile updated successfully!');
    }
}
