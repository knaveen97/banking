@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h5>Checquing Accounts</h5>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <form method="POST" action="/accounts/create">
                    @csrf
                    <input type="submit" class="btn btn-primary" name="reason" value="+ Create Checquings Account"></a>
                </form>
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
                    <?php $i = 0; ?>
                    @foreach ($accounts as $account)
                    @if ($account->type == 'chequing')
                    <tr>
                        <th scope="row">{{++$i}}</th>
                        <td>{{$account->id}}</td>
                        <td>{{$account->balance}}</td>
                        <td>
                            <form method="POST" action="/profile">
                                @csrf
                                <a href="#" class="btn btn-primary">Transfer</a>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="/profile">
                                @csrf
                                <a href="#" class="btn btn-primary">Pay Bills</a>
                            </form>
                        </td>
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
                <form method="POST" action="/accounts/create">
                    @csrf
                    <input type="submit" class="btn btn-primary"  name="reason" value="+ Create Savings Account"></a>
                </form>
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
                    <?php $i = 0; ?>
                    @foreach ($accounts as $account)
                    @if ($account->type == 'savings')
                    <tr>
                        <th scope="row">{{++$i}}</th>
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