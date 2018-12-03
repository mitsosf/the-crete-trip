@extends('layouts.lcs.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="box-header">
                                <h3 class="box-title" style="text-align: center">Boat TO Crete</h3>
                            </div>
                            <!-- /.box-header -->
                        </div>
                    </div>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Facebook</th>
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
                                    <td>
                                        <div style="text-align: center"><a class="btn btn-success" href="tel:{{$user->phone}}" target="_blank"><i
                                                        class="glyphicon glyphicon-earphone"></i> {{$user->phone}}</a></div>
                                    </td>
                                    <td class="hidden-xs">
                                        <div style="text-align: center"><a href="{{$user->facebook}}" target="_blank"><i class="fa fa-facebook-square"></i> {{$user->facebook}}</a></div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th class="hidden-xs">Facebook</th>
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
