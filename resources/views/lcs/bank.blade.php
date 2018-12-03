@extends('layouts.lcs.master')

@section('content')
    <div style="text-align: center;margin-top: 15%">
        <h3>Bank Details:</h3>
        <h5>Account No: <b>788 00 2002 012700</b></h5>
        <h5>Bank Name: <b>ALPHA BANK</b></h5>
        <h5>Beneficiary Name: <b>AFOI STEFANAKI O.E. - BACCARA HOLIDAY SERVICES</b></h5>
        <h3>Reference: <u style="color: red"><b
                        style="color: red">{{Auth::user()->section}}</b></u>

        </h3>
        <h2 style="color: red">Make sure you include the reference when you deposit!!!</h2>
    </div>
@endsection

@section('route'){{route('lc.asParticipant')}}@endsection