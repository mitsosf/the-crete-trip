@extends('layouts.participants.master')

@section('content')
    {{--@if(Auth::user()->rooming === "No")
        <div style="text-align: center;margin-bottom: auto">
            <h3>Rooming Platform</h3>


            <p>Here you can create a room or join one.</p>
            <p style="margin: auto">Please keep in mind that <b><u>we can not guarantee that the room size you choose will be available or that you will be in the room with the people you choose, but
                        we will do our best to honour your wishes.</u></b></p>
            <p>The rooming platform will be open until <b style="color: red">08/05/2018@23:59 (EEST)</b></p>
            <a class="btn btn-success" href="{{route('participants.createRoom')}}">Create Room</a>
            <a class="btn btn-primary" href="{{route('participants.joinRoom')}}">Join Room</a>
            <a class="btn btn-warning" href="{{route('participants.randomRoom')}}">Random Room</a>
            <div class="hidden-lg hidden-md hidden-print" style="width: 100%;margin: 3% auto 0;">
                <img id="example" src="{{asset('images/tct_rooming_instr.png')}}" width="100%" height="auto" alt="">
            </div>
            <div class="hidden-xs hidden-sm" style="width: 60%;margin: 3% auto 0;">
                <img id="example" src="{{asset('images/tct_rooming_instr.png')}}" width="100%" height="auto" alt="">
            </div>
        </div>--}}
    @if(Auth::user()->rooming === "No")
        @if(Auth::user()->section == "ESN TEI OF CRETE" || Auth::user()->section == "ESN UOC - HERAKLION")
            <div style="text-align: center;margin-top: 20%;color: red"><h2>You don't have a room because you are a participant from Heraklion! Enjoy the event!</h2></div>
        @else
            <div style="text-align: center;margin-top: 20%;color: red"><h2>Standby. You'll be assigned a room soon</h2></div>
        @endif
    @elseif(Auth::user()->rooming === "random")
        <div style="text-align: center;margin-bottom: auto">
            <h3>Rooming Platform</h3>
            <p>You have selected a random room!</p>
            <p>You successfully registered for a random room. You will be informed once we'll assign you your roommates.</p>
        </div>
    @elseif($roomIsFinal)
        <div style="text-align: center;margin-bottom: auto">
            <h3>Rooming Platform</h3>
            <p>Your room preference is secured</p>
            <h4>Real room number: {{$roomActual}}</h4>
            <p>The current occupants of your room are:</p>
            <div class="container">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="hidden-xs">#</th>
                        <th>Name</th>
                        <th class="hidden-xs">ESN Section</th>
                        <th>FB</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $index = 1?>
                    @foreach($roommates as $roommate)
                        <tr>
                            <td class="hidden-xs">{{$index}}</td>
                            <td><i class="fa fa-key"></i><a href="{{route('participants.viewRoommateDetails',$roommate->id)}}"> {{$roommate->name.' '.$roommate->surname}}</a></td>
                            <td class="hidden-xs">{{$roommate->section}}</td>
                            <td><a href="{{$roommate->facebook}}" target="_blank"><i class="fa fa-facebook-square"></i></a></td>
                        </tr>
                        <?php $index++?>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div style="text-align: center;;margin-bottom: auto">
            <h3>Rooming Platform</h3>
            <p>You have successfully joined a room.</p>
            <p>The room codes are:</p>

            <h3>Room ID: <b style="color: red;font-size: 130%;"> {{$roomID}}</b></h3>
            <h3>Room Code: <b style="color: red;font-size: 130%;"> {{$roomCode}}</b></h3>
            The current occupants of this room are:
            <div class="container">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="hidden-xs">#</th>
                        <th>Name</th>
                        <th class="hidden-xs">ESN Section</th>
                        <th>FB</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $index = 1?>
                    @foreach($roommates as $roommate)
                        <tr>
                            <td class="hidden-xs">{{$index}}</td>
                            <td><i class="fa fa-key"></i><a href="#"> {{$roommate->name.' '.$roommate->surname}}</a></td>
                            <td class="hidden-xs">{{$roommate->section}}</td>
                            <td><a href="{{$roommate->facebook}}" target="_blank"><i class="fa fa-facebook-square"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@section('js')
    <script>
        $(document).ready($(function () {
            $('#example2').DataTable({
                'paging': false,
                'lengthChange': true,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': true
            })
        }));
    </script>
@endsection