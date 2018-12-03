@extends('layouts.oc.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="text-align: center">Section's registrations</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Section</th>
                                <th scope="col">Registered</th>
                                <th scope="col">Paid Fee</th>
                                <th scope="col">Conversion</th>
                                <th scope="col">Paid Boat</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td><a href="{{route('oc.asSection',$section->name)}}">{{$section->name}}</a></td>
                                    <td>{{$section->registered}}</td>
                                    <td>{{$section->paidFee}}</td>
                                    <td>{{$section->rate}}%</td>
                                    <td>{{$section->paidBoat}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="col">Section</th>
                                <th scope="col">Registered</th>
                                <th scope="col">Paid Fee</th>
                                <th scope="col">Conversion</th>
                                <th scope="col">Paid Boat</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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