<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
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
        $user_id = $user->id;
        $transactions = Transaction::where('from_account_id', $user_id)->orWhere('to_account_id', $user_id)->get();
        foreach ($transactions as $transaction) {
            $from_user = Account::find($transaction->from_account_id)->user;
            $to_user = Account::find($transaction->to_account_id)->user;
            if($from_user->id === $to_user->id){
                $transaction['type'] = "Internal";
            }
            elseif($from_user->id == $user_id){
                $transaction['type'] = "Outgoing";
            }
            elseif($to_user->id == $user_id){
                $transaction['type'] = "Incoming";
            }
        }
        return view('transactions', [
            'transactions' => $transactions 
        ]);
    }
}
