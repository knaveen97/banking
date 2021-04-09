@extends('layouts.app')

@section('content')
<div class="container mt-2">
<form class="row g-3" method="POST" action="/transfer/initiate">
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
            <label for="toaccount" class="form-label">To Account</label>
            <input type="number" class="form-control" id="toaccount" name="toaccount">
        </div>
        <div class="col-12">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount to transfer">
        </div>
        
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Transfer</button>
        </div>
    </form>
</div>
@endsection