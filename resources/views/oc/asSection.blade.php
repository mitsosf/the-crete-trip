@extends('layouts.oc.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="text-align: center">{{$sectionName}}'s registrations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>ESNcard</th>
                                <th class="hidden-xs">Fee</th>
                                <th class="hidden-xs">Tickets</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td style="width: 20%"><a
                                                href="{{route('oc.asParticipant',$user->id)}}">{{$user->name." ".$user->surname}}
                                            <span
                                                    class="glyphicon glyphicon-new-window"
                                                    aria-hidden="true"></span></a></td>
                                    @if($user->esncardstatus === "active")
                                        <td class="success">
                                    @elseif($user->esncardstatus === "available")
                                        <td class="info">
                                    @elseif($user->esncardstatus === "expired")
                                        <td class="warning">
                                    @else
                                        <td class="danger">
                                            @endif
                                            {{$user->esncard}}</td>
                                        <td class="hidden-xs">
                                            @if($user->fee != 'No')
                                                <div style="text-align: center">{{$user->fee}}</div>
                                            @elseif($user->fee === 'No')
                                                <div style="text-align: center">No</div>
                                            @endif
                                        </td>
                                        <td class="hidden-xs">
                                            @if($user->tickets != 'No')
                                                <div style="text-align: center">{{$user->tickets}}</div>
                                            @elseif($user->tickets === 'No')
                                                <div style="text-align: center">No</div>
                                            @endif
                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>ESNcard</th>
                                <th class="hidden-xs">Fee</th>
                                <th class="hidden-xs">Tickets</th>
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