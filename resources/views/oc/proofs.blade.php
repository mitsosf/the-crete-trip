@extends('layouts.oc.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="text-align: center">Pending Sections</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Approve</th>
                            <th>File</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Section</th>
                            <th class="hidden-xs">Date</th>
                            <th class="hidden-xs">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td style="text-align: center"><a href="{{route('oc.doApprovePayment',$section->id)}}"
                                                                  class="btn btn-success" role="button">Approve</a></td>
                                <td>
                                    <a href="{{route('home').\Illuminate\Support\Facades\Storage::url($section->path)}}">Click
                                        to open</a></td>
                                <td>{{$section->amount}}</td>
                                <td class="hidden-xs">{{$section->section}}</td>
                                <td class="hidden-xs">{{$section->created_at}}</td>
                                <td class="hidden-xs">{{$section->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Approve</th>
                            <th>File</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Section</th>
                            <th class="hidden-xs">Date</th>
                            <th class="hidden-xs">Comments</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="text-align: center">Approved Sections</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>File</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Section</th>
                            <th class="hidden-xs">Approved on</th>
                            <th class="hidden-xs">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($approvedSections as $section)
                            <tr>
                                <td>
                                    <a href="{{route('home').\Illuminate\Support\Facades\Storage::url($section->path)}}">Click
                                        to open</a></td>
                                <td>{{$section->amount}}</td>
                                <td class="hidden-xs">{{$section->section}}</td>
                                <td class="hidden-xs">{{$section->updated_at}}</td>
                                <td class="hidden-xs">{{$section->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>File</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Section</th>
                            <th class="hidden-xs">Approved on</th>
                            <th class="hidden-xs">Comments</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="text-align: center">Individual</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example3" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Approve</th>
                            <th>File</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Section</th>
                            <th class="hidden-xs">Date</th>
                            <th class="hidden-xs">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($individuals as $individual)
                            <tr>
                                <td style="text-align: center"><a
                                            href="{{route('oc.doApprovePayment',$individual->id)}}"
                                            class="btn btn-success" role="button">Approve</a></td>
                                <td>
                                    <a href="{{route('home').\Illuminate\Support\Facades\Storage::url($individual->path)}}">Click
                                        to open</a></td>
                                <td>{{$individual->amount}}</td>
                                <td class="hidden-xs">{{$individual->section}}</td>
                                <td class="hidden-xs">{{$individual->created_at}}</td>
                                <td class="hidden-xs">{{$individual->comments}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Approve</th>
                            <th>File</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Section</th>
                            <th class="hidden-xs">Date</th>
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
@endsection

@section('js')
    <script>
        $(document).ready($(function () {
            $('#example1').DataTable({
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
    <script>
        $(document).ready($(function () {
            $('#example3').DataTable({
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