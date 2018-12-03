@extends('layouts.lcs.master')

@section('route'){{route('lc.asParticipant')}}@endsection

@section('content')
    <?php $user = DB::table('users')->where('id', $id)->get()->first();
    $boat = $user->boat;?>
    <div style="text-align: center;margin-top: 15%" class="container">
        <h3>Are you sure {{$user->name.' '.$user->surname}} is paying?</h3>
        @if($user->boat === "Travel BOTH WAYS with the group")
            <h5 style="color: red;">Amount:
                <h2 id="price"
                        style="color: red">{{DB::table('event')->where('attribute','boat')->get()->first()->value}}
                    €</h2>
            </h5>
        @elseif($user->boat === "Travel INDIVIDUALLY to Crete and return WITH THE GROUP")
            <h5 style="color: red;">Amount:
                <h2 id="price"
                        style="color: red">{{(DB::table('event')->where('attribute','boat')->get()->first()->value)/2}}
                    €</h2>
            </h5>
        @elseif($user->boat === "Travel WITH THE GROUP to Crete and return INDIVIDUALLY")
            <h5 style="color: red;">Amount:
                <h2 id="price"
                        style="color: red">{{(DB::table('event')->where('attribute','boat')->get()->first()->value)/2}}
                    €</h2>
            </h5>
        @else
            <h5 style="color: red;">Amount:
                <h2 id="price"
                        style="color: red">{{DB::table('event')->where('attribute','boat')->get()->first()->value}}
                    €</h2>
            </h5>
        @endif
        <form method="POST" action="{{route('lc.doPayFerry')}}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('boat') ? ' has-error' : '' }}">
                <h4>Select trip* (previous choice preselected)</h4>
            </div>

            <input class="form-group" type="hidden" name="userID" value="{{$user->id}}">

            <select id="boat" name="boat" required style="width: 40%;">
                <option value="Travel BOTH WAYS with the group"
                        @if ($user->boat == 'Travel BOTH WAYS with the group') selected="selected" @endif>Travel
                    BOTH WAYS with the group
                </option>
                <option value="Travel WITH THE GROUP to Crete and return INDIVIDUALLY"
                        @if ($user->boat == 'Travel WITH THE GROUP to Crete and return INDIVIDUALLY') selected="selected" @endif>
                    Travel WITH THE GROUP to Crete and return INDIVIDUALLY
                </option>
                <option value="Travel INDIVIDUALLY to Crete and return WITH THE GROUP"
                        @if ($user->boat == 'Travel INDIVIDUALLY to Crete and return WITH THE GROUP') selected="selected" @endif>
                    Travel INDIVIDUALLY to Crete and return WITH THE GROUP
                </option>
            </select>
            @if ($errors->has('boat'))
                <span class="help-block">
                                        <strong>{{ $errors->first('boat') }}</strong>
                                    </span>
            @endif
            <div class="row">
                <div class="col-md-12" style="text-align: center">

                    <h4><b>Make sure this email is correct: <span
                                    style="color: red"> {{$user->email}}</span></b>
                    </h4>
                    <h3>All payments are <b><u>final</u></b>. Pay?</h3>
                    <button type="submit" class="btn btn-success">
                        Pay Ferry!
                    </button>
                    <a href="{{route('lc.home')}}" class="btn btn-danger" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <div id="loading-img"></div>
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
    <script>
        $('#boat').on('change', function(e) {
            var v = $(this).val();


            if('Travel BOTH WAYS with the group' === v) {
                document.getElementById("price").innerHTML = "{{$boatFee.' €'}}";
            } else if('Travel WITH THE GROUP to Crete and return INDIVIDUALLY' === v) {
                document.getElementById("price").innerHTML = "{{($boatFee/2).' €'}}";
            } else if('Travel INDIVIDUALLY to Crete and return WITH THE GROUP' === v) {
                document.getElementById("price").innerHTML = "{{($boatFee/2).' €'}}";
            }
        });


    </script>
@endsection