@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <form class="row g-3" method="POST" action="/bills/pay">
        @csrf
        <div class="col-md-6">
            <label for="fromaccount" class="form-label">From Account</label>
            <select class="form-control" id="fromaccount" name="fromaccount">
                @foreach ($accounts as $account)
                <option value="{{$account->id}}">{{$account->id}} - {{$account->type}} - ${{$account->balance}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="payee" class="form-label">Payee</label>
            <select class="form-control" id="payee" name="payee">
                @foreach ($payees as $payee)
                <option value="{{$payee->id}}">{{$payee->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-12">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount to pay">
        </div>

        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Pay Bill</button>
        </div>
    </form>
</div>

@endsection