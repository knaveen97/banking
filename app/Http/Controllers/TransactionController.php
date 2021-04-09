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
        $transactions = Transaction::where('from_user_id', $user_id)->orWhere('to_user_id', $user_id)->get();
        foreach ($transactions as $transaction) {
            $from_user = User::find($transaction->from_user_id);
            $to_user = User::find($transaction->to_user_id);

            if($to_user->type === "bill"){
                $transaction['type'] = "Bill Payment";
                $transaction['from_name'] = "Me";
                $transaction['to_name'] = $to_user->firstname;
            }
            elseif ($from_user->id === $to_user->id) {
                $transaction['type'] = "Internal";
                $transaction['from_name'] = "Me";
                $transaction['to_name'] = "Me";
            } elseif ($from_user->id == $user_id) {
                $transaction['type'] = "Outgoing";
                $transaction['from_name'] = "Me";
                $transaction['to_name'] = $to_user->lastname . ', ' . $to_user->firstname;
            } elseif ($to_user->id == $user_id) {
                $transaction['type'] = "Incoming";
                $transaction['to_name'] = "Me";
                $transaction['from_name'] = $from_user->lastname . ', ' . $from_user->firstname;
            }
        }
        return view('transactions', [
            'transactions' => $transactions
        ]);
    }
}
