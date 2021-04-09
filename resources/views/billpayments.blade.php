@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <form class="row g-3">
    @csrf
        <div class="col-md-6">
            <label for="fromaccount" class="form-label">From Account</label>
            <input type="number" class="form-control" id="fromaccount">
        </div>
        <div class="col-md-6">
            <label for="payee" class="form-label">Payee</label>
            <input type="text" class="form-control" id="payee">
        </div>
        <div class="col-12">
            <label for="amount" class="form-label">Amount</label>
            <input type="text" class="form-control" id="amount" placeholder="Enter bill amount">
        </div>
        
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Pay Bill</button>
        </div>
    </form>
</div>

@endsection