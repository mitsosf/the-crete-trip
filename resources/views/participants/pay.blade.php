@extends('layouts.participants.master')

@section('content')
    <div style="text-align: center;margin-top: 20%">
        <h3>Pay the event fee</h3>
        <p>Please pay the event fee, by clicking the button below. After we have received your payment, we will send you a payment confirmation by email.</p>
        <a class="btn btn-success" href="{{Auth::user()->glcomments}}">Pay Now</a>
    </div>

@endsection