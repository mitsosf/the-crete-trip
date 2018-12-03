@extends('layouts.lcs.master')

@section('route'){{route('lc.asParticipant')}}@endsection

@section('content')
    <?php $user = DB::table('users')->where('id', $id)->get()->first()?>
    <div style="text-align: center;margin-top: 15%">
        <h3>Are you sure {{$user->name.' '.$user->surname}} is paying?</h3>
        @if($user->section === "ESN UOC - HERAKLION" || $user->section === "ESN TEI OF CRETE")
            @if($user->esncardstatus === 'active')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value}}
                        €</h2></h5>
            @elseif($user->esncardstatus === 'available')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value+10}}
                        €</h2></h5>
                <h3>The ESNcard is valid but <b style="color: red">not activated</b>. To get the discount, the card must
                    be
                    activated at <a href="https://esncard.org">ESNcard.org</a> and then repeat the payment process.</h3>
            @elseif($user->esncardstatus === 'expired')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value+10}}
                        €</h2></h5>
                <h3>This ESNcard is <b style="color: red">expired</b>. To get the discount, the participant must get a
                    new
                    card and activate it at <a href="https://esncard.org">ESNcard.org</a>. Then repeat the payment
                    process.
                </h3>
            @elseif($user->esncardstatus === 'invalid')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value+10}}
                        €</h2></h5>
                <h3>This ESNcard is invalid or doesn't exist. To get the discount, please register a valid ESNcard. Then
                    repeat the payment process.</h3>
            @else
                <h3>ESNcard error on our end, please contact Tech support!</h3>
            @endif
        @else
            @if($user->esncardstatus === 'active')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','fee')->get()->first()->value}}
                        €</h2></h5>
            @elseif($user->esncardstatus === 'available')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','fee')->get()->first()->value+10}}
                        €</h2></h5>
                <h3>The ESNcard is valid but <b style="color: red">not activated</b>. To get the discount, the card must
                    be
                    activated at <a href="https://esncard.org">ESNcard.org</a> and then repeat the payment process.</h3>
            @elseif($user->esncardstatus === 'expired')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','fee')->get()->first()->value+10}}
                        €</h2></h5>
                <h3>This ESNcard is <b style="color: red">expired</b>. To get the discount, the participant must get a
                    new
                    card and activate it at <a href="https://esncard.org">ESNcard.org</a>. Then repeat the payment
                    process.
                </h3>
            @elseif($user->esncardstatus === 'invalid')
                <h5 style="color: red;">Amount: <h2
                            style="color: red">{{DB::table('event')->where('attribute','fee')->get()->first()->value+10}}
                        €</h2></h5>
                <h3>This ESNcard is invalid or doesn't exist. To get the discount, please register a valid ESNcard. Then
                    repeat the payment process.</h3>
            @else
                <h3>ESNcard error on our end, please contact Tech support!</h3>
            @endif
        @endif
        <h4><b>Make sure this email is correct: <span style="color: red"> {{$user->email}}</span></b></h4>
        <h3>All payments are <b><u>final</u></b>. Pay?</h3>
        <a href="{{route('lc.doPayFee',$user->id)}}" class="btn btn-success" role="button" id="pay">Yes</a>
        <a href="{{route('lc.home')}}" class="btn btn-danger" role="button">Cancel</a>
        <div class="row">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <div id="loading-img"></div>
        </div>
    </div>
@endsection

@section('style')
    <style>
        #loading-img {
            background: url("http://www.chimply.com/images/samples/classic-spinner/animatedEllipse.gif") center center no-repeat;
            display: none;
            height: 50px;
            width: 50px;
            position: absolute;
            top: 33%;
            left: 1%;
            right: 1%;
            margin: auto;
        }
    </style>
@endsection

@section('js')
    <script>
        $("#pay").click(function () {
            $("#loading-img").css({"display": "block"});
        });
    </script>
@endsection