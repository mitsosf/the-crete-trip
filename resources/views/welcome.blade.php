@extends('layouts.app')

@section('background')style='background: #2e3192'@endsection

@section('content')
    <div style="text-align: center;margin-top: 2%">
        <h2 style="color: white">Welcome to</h2>
        <img src="images/tctlandingwhite.png" style="width: 25%;height: 25%;"><br>
        <div class="row">
            <a href="{{route('register')}}">
                <button type="button" class="btn btn-primary"
                        style="background-color: #EC008C !important; margin-top: 5%"><h4>Register NOW!</h4></button>
            </a>
            {{--<a href="{{route('login')}}">
                <button type="button" class="btn btn-primary"
                        style="background-color: #5cb85c !important; margin-top: 5%;margin-left: 2%"><h4>My account</h4>
                </button>
            </a>--}}
        </div>
    </div>

@endsection
