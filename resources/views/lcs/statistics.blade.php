@extends('layouts.lcs.master')

@section('route'){{route('lc.asParticipant')}}@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Participants' ratio</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="participants" width="20" height="20"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h4 style="text-align: center">Totals</h4>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">Participants</th>
                                        <td style="text-align: center">{{$fee+$boat}}</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th style="text-align: center">Total (fee+ferry)</th>
                                        <td style="text-align: center">{{$sum}} €</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h4 style="text-align: center">Bank deposits</h4>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center">Deposited</th>
                                        <td style="text-align: center">{{$deposited}} €</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th style="text-align: center">Pending</th>
                                        <td style="text-align: center">{{$pending}} €</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="text-align: center">Fees by date</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Money</th>
                                    <th>Participants</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactionsFee as $transaction)
                                    <tr>
                                        <th>{{$transaction->date}} ({{Carbon\Carbon::parse($transaction->date)->diffForHumans()}})</th>
                                        <td>{{$transaction->money}} €</td>
                                        <td>{{$transaction->participants}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <div class="row">
                    <div class="box">
                        <div class="box-header">
                            <h3 style="text-align: center">Boat by date</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Money</th>
                                    <th>Participants</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactionsBoat as $transaction)
                                    <tr>
                                        <th>{{$transaction->date}} ({{Carbon\Carbon::parse($transaction->date)->diffForHumans()}})</th>
                                        <td>{{$transaction->money}} €</td>
                                        <td>{{$transaction->participants}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        new Chart(document.getElementById("participants"), {
            type: 'doughnut',
            data: {
                labels: ["Registered", "Fee", "Boat"],
                datasets: [
                    {
                        label: "Population (millions)",
                        backgroundColor: ["#ffbb33", "#5bc0de", "#5cb85c"],
                        data: [{{$registered}},{{$fee}},{{$boat}}]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Number of participants'
                }
            }
        });
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