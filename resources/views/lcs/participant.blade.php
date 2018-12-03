@extends('layouts.lcs.master')

@section('route'){{route('lc.asParticipant')}}@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <?php $user = DB::table('users')->where('id', $id)->get()->first()?>
                    <div class="panel-heading"><h3>Participant: {{$user->name.' '.$user->surname}}</h3></div>
                    <table class="table">
                        <tbody>
                        @if($user->fee!='No')
                            <h3 style="text-align: center;color: green;">Paid fee: {{$user->feedate}} ({{Carbon\Carbon::parse($user->feedate)->diffForHumans()}})</h3>
                        @endif
                        @if($user->tickets!='No')
                            <h3 style="text-align: center;color: green;">Paid ferry: {{$user->ticketsdate}} ({{Carbon\Carbon::parse($user->ticketsdate)->diffForHumans()}})</h3>
                        @endif
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
                    <div style="text-align: center"><a class="btn btn-danger" href="{{route('lc.home')}}">Back</a></div>
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
                                   value="{{$user->esncard}}">
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
    <script src="{{asset('js/editParticipantEsnCard.js')}}"></script>
    <script>
        var token = '{{Session::token()}}';
        var url = '{{route('lc.editparticipantesncard')}}';
        var id = '{{$id}}';
    </script>
@endsection