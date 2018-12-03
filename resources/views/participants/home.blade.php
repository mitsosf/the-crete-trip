@extends('layouts.participants.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(Auth::user()->rooming === "No" && Auth::user()->section!= "ESN UOC - HERAKLION" && Auth::user()->section!= "ESN TEI OF CRETE" && $rooming === '1')
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h2 class="box-title">**Rooming Platform*{{$rooming}}*</h2>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            The rooming platform is now available! <a href="{{route('participants.rooming')}}">Click here to register for a room</a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                @endif
                    @if(Auth::user()->rooming === "random")
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h2 class="box-title">Random rooming complete</h2>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                You successfully registered for a random room. You will be informed once we'll assign you your roommates.
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @endif
                @if(Auth::user()->section === "International Guests (ESNers)")
                    <div class="box box-warning box-solid" style="text-align: center">
                        <div class="box-header with-border">
                            <h2 class="box-title">Pay the event fee</h2>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <p>Please click here to pay the event fee</p>
                            <a href="{{Auth::user()->glcomments}}" class="btn btn-success">Pay now</a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                @endif
                @if(Auth::user()->fee === "No")
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h2 class="box-title">You have successfully registered for The Crete Trip 2018!</h2>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                            <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            Please verify the data you provided and if you find any errors contact us using the <a
                                    href="https://thecretetrip.org/contact">contact form</a>.
                        </div>
                        <!-- /.box-body -->
                    </div>
                @endif
                @if(Auth::user()->fee === 'No')
                    @if(Auth::user()->esncardstatus == "available")
                        <div class="box box-warning box-solid">
                            <div class="box-header with-border">
                                <h2 class="box-title">Your ESNcard is valid, but not activated!!</h2>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                Please register and/or activate your ESNcard on <a
                                        href="https://esncard.org" target="_blank">ESNcard.org</a>. You can then
                                logout
                                and
                                log back in to see your status change!
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @elseif(Auth::user()->esncardstatus == "expired")
                        <div class="box box-danger box-solid">
                            <div class="box-header with-border">
                                <h2 class="box-title">You have successfully registered for The Crete Trip 2018!</h2>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                Please verify the data you provided and if you find any errors contact us using the
                                <a
                                        href="https://thecretetrip.org/contact">contact form</a>.
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @elseif(Auth::user()->esncardstatus == "invalid")
                        <div class="box box-danger box-solid">
                            <div class="box-header with-border">
                                <h2 class="box-title">You have either not submitted an ESNcard or your ESNcard
                                    number is
                                    invalid. </h2>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                                class="fa fa-times"></i></button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                If you want to pay the reduced fee, please enter a valid and activated ESNcard
                                number.
                            </div>
                            <!-- /.box-body -->
                        </div>
                    @else

                    @endif
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>My account</h3></div>
                    <?php $user = Auth::user()?>
                    <h4 class="hidden-xs" style="text-align: center;margin-top: 3%"><u>Next steps:</u></h4>
                    <div class="row hidden-xs">
                        <div class="col-md-3" style="text-align: center"><b>1.</b> Registration</div>
                        <div class="col-md-3" style="text-align: center"><b>2.</b> Fee Payment</div>
                        <div class="col-md-3" style="text-align: center"><b>3.</b> Group Transportation</div>
                        <div class="col-md-3" style="text-align: center"><b>4.</b> Room Selection</div>
                    </div>
                    @if(Auth::user()->rooming!='No')
                        <div class="progress active hidden-xs">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                 aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                <span class="hidden-lg hidden-md hidden-sm">Room Selection</span>
                            </div>
                        </div>
                    @elseif(Auth::user()->tickets!='No')
                        <div class="progress active hidden-xs">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                <span class="hidden-lg hidden-md">Group Transportation</span>
                            </div>
                        </div>
                    @elseif(Auth::user()->fee!='No')
                        <div class="progress active hidden-xs">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                 aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                <span class="hidden-lg hidden-md">Fee Payment</span>
                            </div>
                        </div>
                    @else
                        <div class="progress active hidden-xs">
                            <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
                                <span class="hidden-lg hidden-md">Registration</span>
                            </div>
                        </div>
                    @endif
                    <h4 style="text-align: center;margin-top: 3%"><u>My details:</u></h4>
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
        var url = '{{route('participants.editesncard')}}'
    </script>
@endsection