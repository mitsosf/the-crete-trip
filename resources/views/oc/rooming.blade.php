@extends('layouts.oc.master')

@section('content')
    {{--@foreach($test as $testing)
        {{$testing.' ;'}}
    @endforeach--}}
    <h3 style="text-align: center">Rooming</h3>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>Hotel</th>
                    <th>2-beds</th>
                    <th>3-beds</th>
                    <th>4-beds</th>
                    <th>5-beds</th>
                    <th>6-beds</th>
                </tr>
                </thead>
                <tbody>
                @foreach($availableBeds as $availableBed)
                    <tr>
                        <td>{{$availableBed->name}}</td>
                        <td>{{$availableBed->twobeds.'/'.$hotels[$availableBed->id-1]->twobeds}}</td>
                        <td>{{$availableBed->threebeds.'/'.$hotels[$availableBed->id-1]->threebeds}}</td>
                        <td>{{$availableBed->fourbeds.'/'.$hotels[$availableBed->id-1]->fourbeds}}</td>
                        <td>{{$availableBed->fivebeds.'/'.$hotels[$availableBed->id-1]->fivebeds}}</td>
                        <td>{{$availableBed->sixbeds.'/'.$hotels[$availableBed->id-1]->sixbeds}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-2"></div>
    </div>

    <div class="box">
        <div class="row">
            <div class="col-sm-4">
                <div class="box-header">
                    <h3 class="box-title" style="text-align: center">Rooms</h3>
                </div>
                <!-- /.box-header -->
            </div>
            {{--<div class="col-sm-4" style="text-align: center">
                <h4>Number of places left:
                    <b style="color: red">
                        @if($beds>0)
                            {{$beds}}
                        @else
                            0, Well done team!
                        @endif
                    </b>
                </h4>
            </div>--}}
        </div>
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Actual</th>
                    <th class="hidden-xs">Hotel</th>
                    <th>Beds</th>
                    <th class="hidden-xs">Final</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rooms as $room)
                    <tr>
                        <td style="width: 20%;text-align: center"><a href="{{route('oc.viewRoomOccupants',$room->id)}}">Room {{$room->id}}</a></td>
                        <td>
                            <div style="text-align: center">{{$room->actual}}</div>
                        </td>
                        <td>
                            <div style="text-align: center">{{$room->hotel == 1 ? "MariLena": "MariRena"}}</div>
                        </td>
                        <td>
                            <div style="text-align: center">{{$room->beds}}</div>
                        </td>
                        <td>
                            <div style="text-align: center">{{$room->final == 1 ? "Final": "Open"}}</div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Actual</th>
                    <th class="hidden-xs">Hotel</th>
                    <th>Beds</th>
                    <th class="hidden-xs">Final</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection


@section('js')
    <script>
        $(document).ready($(function () {
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': true
            })
        }));
        $(document).ready($(function focusOnSearch() {
            $('div.dataTables_filter input').focus();
        }));
    </script>
@endsection