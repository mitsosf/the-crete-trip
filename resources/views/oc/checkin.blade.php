@extends('layouts.oc.master')

@section('content')
    <div style="text-align: center">
        <h1 style="margin-bottom: 2%">You are about to check in:</h1>
        <h1>Name: <u style="color: red">{{$user->name.' '.$user->surname}}</u></h1>
        <h1>Room No: <u style="color: red">{{$room->actual}}</u></h1>
        @if($room->first_id == "No")
            <i class="fa fa-key"></i>
        @endif
        <h2>ID/Passport: <u style="color: red">{{$user->document}}</u></h2>
        <h2>ESNcard: <b style="color: red">{{$user->esncard}}</b></h2>
        <h4>Section: <b style="color: red">{{$user->section}}</b></h4>
        <h2>T-shirt: <b style="color: red">{{$user->tshirt}}</b></h2>
        <a id="confirm" href="{{route('oc.doCheckin',$user->id)}}" class="btn btn-success">Confirm</a>
        <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready($(function focusOnConfirm() {
            $('#confirm').focus();
        }));
    </script>
@endsection