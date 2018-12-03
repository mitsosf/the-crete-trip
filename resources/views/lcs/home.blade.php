@extends('layouts.lcs.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box-header">
                                <h3 class="box-title" style="text-align: center">Section's registrations</h3>
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
                        <div style="text-align: right;margin-bottom: 1%"><a class="btn btn-success"
                                                                            href="{{route('lc.exports.participants')}}"><i
                                        class="glyphicon glyphicon-list-alt"></i> Export to Excel</a></div>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th  class="hidden-xs">Facebook</th>
                                <th class="hidden-xs">Comments</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="width: 20%"><a
                                                href="{{route('lc.participant',$user->id)}}">{{$user->name." ".$user->surname}}
                                            <span
                                                    class="glyphicon glyphicon-new-window"
                                                    aria-hidden="true"></span></a>
                                    </td>
                                    {{-- @if($user->esncardstatus === "active")
                                         <td class="success hidden-xs">
                                     @elseif($user->esncardstatus === "available")
                                         <td class="info hidden-xs">
                                     @elseif($user->esncardstatus === "expired")
                                         <td class="warning hidden-xs">
                                     @else
                                         <td class="danger hidden-xs">
                                             @endif
                                             {{$user->esncard}}</td>--}}
                                    <td>
                                        <div style="text-align: center"><a class="btn btn-success" href="tel:{{$user->phone}}" target="_blank"><i class="glyphicon glyphicon-earphone"></i> {{$user->phone}}</a></div>
                                    </td>
                                    <td  class="hidden-xs">
                                        <div style="text-align: center"><a href="{{$user->facebook}}" target="_blank"><i class="fa fa-facebook-square"></i> {{$user->facebook}}</a></div>
                                    </td>
                                    <td class="hidden-xs">
                                        @if($user->glcomments != '')
                                            <div style="text-align: center">{{$user->glcomments}}</div>
                                        @elseif($user->glcomments === '')
                                            <div style="text-align: center"><a href="#" class="btn btn-info"
                                                                               role="button"><i
                                                            class="glyphicon glyphicon-pencil"></i> Comment</a>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Facebook</th>
                                <th class="hidden-xs">Comments</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
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

@section('route'){{route('lc.asParticipant')}}@endsection
