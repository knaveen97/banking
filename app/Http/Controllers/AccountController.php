<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
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
    public function index(User $user)
    {
        $user = Auth::user();
        return view('accounts',[
            'accounts' => $user->accounts()->get(),
        ]);
    }

    public function createAccount(User $user, Request $request)
    {
        $user = Auth::user();
        $reason = $request->input('reason');
        $type = '';
        if($reason === '+ Create Savings Account')
        {
            $type = 'savings';
        }
        elseif($reason === '+ Create Chequings Account')
        {
            $type = 'chequing';
        }

        if($type === ''){
            return redirect('/accounts')->with('danger','Invalid Request. Please try again');
        }

        Account::create([
            'user_id' => $user->id,
            'type' => $type,
            'balance' => 0,
        ]);

        return redirect('/accounts')->with('success','Account created successfully!');
    }
}
