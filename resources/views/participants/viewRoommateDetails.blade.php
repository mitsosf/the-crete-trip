@extends('layouts.participants.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <?php $user = $roommate?>
                    <div class="panel-heading"><h3>Roommate's details:</h3></div>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Full Name:</td>
                            <td>{{$user->name.' '.$user->surname}}</td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>{{$user->gender}}</td>
                        </tr>
                        <tr>
                            <td>Facebook:</td>
                            <td>{{$user->facebook}}</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center"><a class="btn btn-danger" href="{{route('participants.rooming')}}">Back</a></div>
                </div>
            </div>
        </div>
    </div>
@endsection