<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class BillPaymentController extends Controller
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
        $payees = Account::where('type', 'bill')->get();
        foreach ($payees as $payee) {
            $payee['name'] = $payee->user->lastname;
        }
        return view('billpayments', [
            'accounts' => $user->accounts()->get(),
            'payees' => $payees,
        ]);
    }

    public function payBill(Request $request){
        $user = Auth::user();
        $fromaccount = $request->input('fromaccount');
        $payee = $request->input('payee');
        $amount = $request->input('amount');

        if ($amount > 0) {
            if ($fromaccount != $payee) {
                if ($this->checkAccount($fromaccount)) {
                    if ($this->checkAccountUser($fromaccount)) {
                        if ($this->checkPayee($payee)) {
                            if ($this->checkBalance($fromaccount, $amount)) {
                                $this->updateBalances($fromaccount, $payee, $amount);
                                $this->createTransaction($fromaccount, $payee, $amount, $user->id);
                                return redirect('/bills')->with('success', 'Amount transferred successfully. Check transactions tab for more details');
                            } else {
                                return redirect('/bills')->with('error', 'Insufficient balance');
                            }
                        } else {
                            return redirect('/bills')->with('error', 'Payee doesnot exist');
                        }
                    } else {
                        return redirect('/bills')->with('error', 'From Account doesnot belong to user');
                    }
                } else {
                    return redirect('/bills')->with('error', 'From Account doesnot exist');
                }
            } else {
                return redirect('/bills')->with('error', 'From Account and payee cannot be same');
            }
        }
        else{
            return redirect('/bills')->with('error', 'Amount must be greater than 0');
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

    public function checkPayee($payee)
    {
        if (Account::where('id', '=', $payee)->exists()) {
           if(Account::find($payee)->user->type == 'bill'){
               return true;
           }
        }
        return false;
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

    public function updateBalances($fromaccount, $payee, $amount)
    {
        $fromAccountObj = Account::find($fromaccount);
        $payeeObj = Account::find($payee);
        $fromAccountObj->balance -= $amount;
        $fromAccountObj->save();
        $payeeObj->balance += $amount;
        $payeeObj->save();
    }

    public function createTransaction($fromaccount, $payee, $amount, $user_id)
    {
        $transaction = new Transaction;
        $transaction->from_user_id = $user_id;
        $transaction->to_user_id = Account::find($payee)->user->id;
        $transaction->from_account_id = $fromaccount;
        $transaction->to_account_id = $payee;
        $transaction->amount = $amount;
        $transaction->trans_type = "bill";
        $transaction->save();
    }
}
