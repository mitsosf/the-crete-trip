@extends('layouts.lcs.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="box box-success box-solid">
                    <div class="box-header with-border">
                        <h2 class="box-title">You have successfully registered for The Crete Trip 2018!</h2>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Please verify the data you provided and if you find any errors contact us using the <a href="https://thecretetrip.org/contact">contact form</a>.
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>My account</h3></div>
                    <?php $user = Auth::user()?>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Full Name:</td>
                            <td>{{$user->name.' '.$user->surname}}</td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>ESNcard no:</td>
                            <td>
                                <b id="esncard">{{$user->esncard}}
                                    @if($user->esncardstatus != 'active')
                                        <button class="btn btn-default" id="edit-esncard"><i
                                                    class="fa fa-pencil-square-o"></i></button>
                                    @endif
                                </b>
                            </td>
                        </tr>
                        <tr>
                            <td>ID/Passport no:</td>
                            <td>{{$user->document}}</td>
                        </tr>
                        <tr>
                            <td>Date of birth:</td>
                            <td>{{$user->birthday}}</td>
                        </tr>
                        <tr>
                            <td>Gender:</td>
                            <td>{{$user->gender}}</td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>{{$user->phone}}</td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td>{{$user->country}}</td>
                        </tr>
                        <tr>
                            <td>Transportation TO/FROM Crete:</td>
                            <td>{{$user->boat}}</td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td>{{$user->city}}</td>
                        </tr>
                        <tr>
                            <td>Facebook:</td>
                            <td>{{$user->facebook}}</td>
                        </tr>
                        <tr>
                            <td>Allergies:</td>
                            <td>{{$user->allergies}}</td>
                        </tr>
                        <tr>
                            <td>Comments:</td>
                            <td>{{$user->comments}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="edit-esncard-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit ESNcard</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="new-esn-card">New ESNcard no:</label>
                            <input class="form-control" type="text" id="new-esn-card" name="new-esn-card"
                                   value="{{Auth::user()->esncard}}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('js')
    <script src="{{asset('js/editEsnCard.js')}}"></script>
    <script>
        var token = '{{Session::token()}}';
        var url = '{{route('lc.editesncard')}}'
    </script>
@endsection

@section('route'){{route('lc.home')}}@endsection