@extends('layouts.lcs.master')

@section('route'){{route('lc.asParticipant')}}@endsection

@section('content')
    <div class="container">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="text-align: center">Payments pending approval</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th class="hidden-xs">Comments</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $total=0?>
                    @foreach($payments as $payment)
                        @if($payment->approved ==='No')
                            <tr class="info">
                                <td>{{Carbon\Carbon::parse($payment->created_at)->diffForHumans()}}</td>
                                <td>{{$payment->amount}}</td>
                                <td class="hidden-xs">{{$payment->comments}}</td>
                            </tr>
                            <?php $total = $total + $payment->amount?>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Total Pending:</th>
                        <th class="info"><h5><b>{{$total}}</b></h5></th>
                        <th class="hidden-xs"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title" style="text-align: center">Approved uploads</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th class="hidden-xs">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total=0?>
                        @foreach($payments as $payment)
                            @if($payment->approved ==='Yes')
                                <tr class="success">
                                    <td>{{Carbon\Carbon::parse($payment->created_at)->diffForHumans()}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td class="hidden-xs">{{$payment->comments}}</td>
                                </tr>
                                <?php $total = $total + $payment->amount?>
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total approved:</th>
                            <th class="success"><h5><b>{{$total}}</b></h5></th>
                            <th class="hidden-xs"></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready($(function () {
            $('#example').DataTable({
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
@endsection

@section('route'){{route('lc.asParticipant')}}@endsection
