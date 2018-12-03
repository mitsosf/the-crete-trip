@extends('layouts.oc.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <?php $user = DB::table('users')->where('id', $id)->get()->first()?>
                    <div class="panel-heading"><h3>Participant: {{$user->name.' '.$user->surname}}</h3></div>
                    <table class="table">
                        <tbody>
                        @if($user->fee!='No')
                            <h3 style="text-align: center;color: green;">Paid fee: {{$user->feedate}}
                                ({{Carbon\Carbon::parse($user->feedate)->diffForHumans()}})</h3>
                        @endif
                        @if($user->tickets!='No')
                            <h3 style="text-align: center;color: green;">Paid ferry: {{$user->ticketsdate}}
                                ({{Carbon\Carbon::parse($user->ticketsdate)->diffForHumans()}})</h3>
                        @endif
                        <tr>
                            <td>Full Name:</td>
                            <td>{{$user->name.' '.$user->surname}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>ESNcard no:</td>
                            <td>
                                <p><b>{{$user->esncard}}:</b> {{$user->esncardstatus}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>ID/Passport no:</td>
                            <td>{{$user->document}}</td>
                        </tr>
                        <tr>
                            <td>Date of birth:</td>
                            <td>{{$user->birthday}}</td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>{{$user->gender}}</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>{{$user->country}}</td>
                        </tr>
                        <tr>
                            <td>Transportation TO/FROM Crete:</td>
                            <td>{{$user->boat}}</td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td>{{$user->city}}</td>
                        </tr>
                        <tr>
                            <td>Facebook:</td>
                            <td>{{$user->facebook}}</td>
                        </tr>
                        <tr>
                            <td>Allergies:</td>
                            <td>{{$user->allergies}}</td>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                            <td>{{$user->comments}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div style="text-align: center"><a class="btn btn-danger" href="{{url()->previous()}}">Back</a></div>
            </div>
        </div>
    </div>
@endsection