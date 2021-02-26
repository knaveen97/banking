@extends('layouts.app')

@section('content')
<div class="container mt-2">
<h1>Welcome {{ Auth::user()->lastname }}, {{ Auth::user()->firstname }} </h1>
</div>
@endsection
