@extends('layouts.oc.master')

@section('content')
    <h2>MariRena</h2>
    <div style="text-align: center"><h2 style="color: green">Checked in: {{$checkedIn.'/'.$residentCount}}</h2></div>
    <div class="container">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Check-in</th>
                    <th>Name</th>
                    <th>ESNcard</th>
                    <th>ID</th>
                    <th>Section</th>
                </tr>
                </thead>
                <tbody>
                @foreach($residents as $resident)
                    <tr>
                        @if($resident->checkin == "No")
                            <td><a href="{{route('oc.checkin',$resident->id)}}" class="btn btn-primary">Check-in</a></td>
                        @else
                            <td><a href="{{route('oc.uncheckin',$resident->id)}}" class="btn btn-danger">Uncheck-in</a></td>
                        @endif
                        <td>{{$resident->name." ".$resident->surname}}</td>
                        <td>{{$resident->esncard}}</td>
                        <td>{{$resident->document}}</td>
                        <td>{{$resident->section}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Check-in</th>
                    <th>Name</th>
                    <th>ESNcard</th>
                    <th>ID</th>
                    <th>Section</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
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