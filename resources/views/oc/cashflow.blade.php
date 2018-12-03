@extends('layouts.oc.master')

@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="text-align: center">Total amounts</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="warning" style="text-align: center">Pending</th>
                        <th class="success" style="text-align: center">Deposited</th>
                        <th class="info" style="text-align: center">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="warning" style="text-align: center"><h3>{{$pending}}</h3></td>
                        <td class="success" style="text-align: center"><h3>{{$deposited}}</h3></td>
                        <td class="info" style="text-align: center"><h3><b>{{$total}}</b></h3></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
                                <th>Section</th>
                                <th class="hidden-xs warning">Pending</th>
                                <th class="hidden-xs success">Deposited</th>
                                <th class="info">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td style="text-align: center">{{$section->name}}</td>
                                    <td style="text-align: center">{{$section->pendingCash}}</td>
                                    <td style="text-align: center">{{$section->depositedCash}}</td>
                                    <td style="text-align: center">{{$section->allCash}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Section</th>
                                <th class="hidden-xs warning">Pending</th>
                                <th class="hidden-xs success">Deposited</th>
                                <th class="info">Total</th>
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