@extends('layouts.app')

@section('content')
    <div class="container mt-2">
    <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
                @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->from_account_id }} ({{ $transaction->from_name }})</td>
                    <td>{{ $transaction->to_account_id }} ({{ $transaction->to_name }})</td>
                    <td>{{ $transaction->amount }}</td>
                    <td>
                        @if($transaction->type == 'Internal')
                        <i class="bi bi-arrow-left-right" style="color: blue;"></i>
                        @endif
                        @if($transaction->type == 'Outgoing')
                        <i class="bi bi-arrow-up-right" style="color: red;"></i>
                        @endif
                        @if($transaction->type == 'Incoming')
                        <i class="bi bi-arrow-down-left" style="color: green;"></i>
                        @endif
                        @if($transaction->type == 'Bill Payment')
                        <i class="bi bi-file-earmark-text"></i>
                        @endif
                        &nbsp; {{ $transaction->type }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection