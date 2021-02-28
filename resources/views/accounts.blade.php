@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h5>Checquing Accounts</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">+ Create Checquings Account</button>
            </div>
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Transfer</th>
                        <th scope="col">Pay Bills</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                    @if ($account->type == 'chequing')
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$account->id}}</td>
                        <td>{{$account->balance}}</td>
                        <td><a href="#" class="btn btn-primary">Transfer</a></td>
                        <td><a href="#" class="btn btn-primary">Pay Bills</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h5>Savings Accounts</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary">+ Create Savings Account</button>
            </div>
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Account Number</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Transfer</th>
                        <th scope="col">Pay Bills</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                    @if ($account->type == 'savings')
                    <tr>
                        <th scope="row">{{$loop->index+1}}</th>
                        <td>{{$account->id}}</td>
                        <td>{{$account->balance}}</td>
                        <td><a href="#" class="btn btn-primary">Transfer</a></td>
                        <td><a href="#" class="btn btn-primary">Pay Bills</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection