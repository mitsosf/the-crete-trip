@extends('layouts.oc.master')

@section('content')
    <h2>Welcome bags</h2>
    <div style="text-align: center"><h2 style="color: green">Pending: {{$residentCount}}</h2></div>
    <div class="container">
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Bag</th>
                    <th>Name</th>
                    <th>ESNcard</th>
                    <th>ID</th>
                    <th>Room</th>
                </tr>
                </thead>
                <tbody>
                @foreach($residents as $resident)
                    <tr>
                        <td><a href="{{route('oc.giveWelcomeBag',$resident->id)}}" class="btn btn-primary">Give Bag</a></td>
                        <td>{{$resident->name." ".$resident->surname}}</td>
                        <td>{{$resident->esncard}}</td>
                        <td>{{$resident->document}}</td>
                        <td>{{$resident->rooming}}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Bag</th>
                    <th>Name</th>
                    <th>ESNcard</th>
                    <th>ID</th>
                    <th>Room</th>
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