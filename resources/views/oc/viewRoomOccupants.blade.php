@extends('layouts.oc.master')

@section('content')
    <div style="text-align: center;margin-bottom: auto">
        <h3>Rooming Platform</h3>
        <p>Your room preference is secured</p>
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
                <?php
                    $index = 1;
                    $roommates = $occupants;
                ?>
                @foreach($roommates as $roommate)
                    <tr>
                        <td class="hidden-xs">{{$index}}</td>
                        <td><i class="fa fa-key"></i><a href="{{route('oc.viewParticipant',$roommate->id)}}"> {{$roommate->name.' '.$roommate->surname}}</a></td>
                        <td class="hidden-xs">{{$roommate->section}}</td>
                        <td><a href="{{$roommate->facebook}}" target="_blank"><i class="fa fa-facebook-square"></i></a></td>
                    </tr>
                    <?php $index++?>
                @endforeach
                </tbody>
            </table>
            <div style="text-align: center"><a class="btn btn-danger" href="{{route('oc.rooming')}}">Back</a></div>
        </div>
    </div>
@endsection