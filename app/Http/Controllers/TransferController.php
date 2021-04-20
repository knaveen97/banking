<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class TransferController extends Controller
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
        return view('transfers', [
            'accounts' => $user->accounts()->get(),
        ]);
    }

    public function initiateTransfer(User $user, Request $request)
    {
        $user = Auth::user();
        $fromaccount = $request->input('fromaccount');
        $toaccount = $request->input('toaccount');
        $amount = $request->input('amount');

        if ($amount > 0) {
            if ($fromaccount != $toaccount) {
                if ($this->checkAccount($fromaccount)) {
                    if ($this->checkAccountUser($fromaccount)) {
                        if ($this->checkAccount($toaccount)) {
                            if ($this->checkBalance($fromaccount, $amount)) {
                                $this->updateBalances($fromaccount, $toaccount, $amount);
                                $this->createTransaction($fromaccount, $toaccount, $amount, $user->id);
                                return redirect('/transfer')->with('success', 'Amount transferred successfully. Check transactions tab for more details');
                            } else {
                                return redirect('/transfer')->with('error', 'Insufficient balance');
                            }
                        } else {
                            return redirect('/transfer')->with('error', 'To Account doesnot exist');
                        }
                    } else {
                        return redirect('/transfer')->with('error', 'From Account doesnot belong to user');
                    }
                } else {
                    return redirect('/transfer')->with('error', 'From Account doesnot exist');
                }
            } else {
                return redirect('/transfer')->with('error', 'From Account and To Account cannot be same');
            }
        }
        else{
            return redirect('/transfer')->with('error', 'Amount must be greater than 0');
        }
    }

    public function checkAccount($accountID)
    {
        if (Account::where('id', '=', $accountID)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAccountUser($accountID)
    {
        if (Account::find($accountID)->user->id == Auth::user()->id) {
            return true;
        } else {
            return false;
        }
    }

    public function checkBalance($accountID, $amount)
    {
        if (Account::find($accountID)->balance >= $amount) {
            return true;
        } else {
            return false;
        }
    }

    public function updateBalances($fromaccount, $toaccount, $amount)
    {
        $fromAccountObj = Account::find($fromaccount);
        $toAccountObj = Account::find($toaccount);
        $fromAccountObj->balance -= $amount;
        $fromAccountObj->save();
        $toAccountObj->balance += $amount;
        $toAccountObj->save();
    }

    public function createTransaction($fromaccount, $toaccount, $amount, $user_id)
    {
        $transaction = new Transaction;
        $transaction->from_user_id = $user_id;
        $transaction->to_user_id = Account::find($toaccount)->user->id;
        $transaction->from_account_id = $fromaccount;
        $transaction->to_account_id = $toaccount;
        $transaction->amount = $amount;
        $transaction->trans_type = "transfer";
        $transaction->save();
    }
}
