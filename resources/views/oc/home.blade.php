@extends('layouts.oc.master')
@section('content')
    <h2>Welcome to the famous Godmode</h2>
    <h6>This is a work in progress</h6>
    <div class="row" style="text-align: center">
        <h3>Number of hotel places left:</h3>
        <h2 style="color: red">
            @if($beds>0)
                {{$beds}}
            @else
                Well done team!
            @endif
        </h2>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4 style="text-align: center">Registrations</h4>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th style="text-align: center">Registered</th>
                            <th style="text-align: center">Paid Fee</th>
                            <th style="text-align: center">Conversion rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$registered}}</td>
                            <td>{{$paid}}</td>
                            <td>{{round(($paid/$registered)*100,2)}}%</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4 style="text-align: center">Boats</h4>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <table class="table" style="text-align: center">
                        <thead>
                        <tr>
                            <th style="text-align: center">Both Ways</th>
                            <th style="text-align: center">TO Crete</th>
                            <th style="text-align: center">FROM Crete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$bothWays}}</td>
                            <td>{{$toCrete}}</td>
                            <td>{{$fromCrete}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
            <div id="map" style="width: 600px; height: 400px;position: absolute; right: 40%;left: 40%"></div>
    </div>
@endsection