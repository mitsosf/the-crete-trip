@extends('layouts.participants.master')

@section('content')
    <div style="text-align: center;margin-top: 10%">
        <h3>Create a room</h3>
        <p>Here you can create a new room. Please fill in all the fields below. Please follow these steps:</p>

        <p>1. Create a room by clicking the button below.</p>
        <p>2. Share the room codes with your friends, so that they can join you.</p>

        <p style="color: red"><b>You are reminded that your room <b style="color: red">WILL ONLY BE FINAL WHEN IT'S FULL OF OCCUPANTS</b>. If by
                the end of the rooming process the room is not full, you will be randomly assigned to a room.</b></p>

        <p>e.g. If you create a room for 3 participants, the process will only be finished when the third participant joins the room.</p>

        <h6>Please note that this Room ID *is not* the real room number of your room at The Crete Trip.</h6>

        <p>If you have any questions or encounter any problems, don't hesitate to contact us using the <a href="https://thecretetrip.org/contact">contact form</a></p>


        <div class="container">
            <form method="POST" action="{{ route('participants.doCreateRoom') }}">
                <div class="row" style="margin-top: 2%">
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('roomType') ? ' has-error' : '' }}"
                             style="text-align: left">
                            <label for="roomType" class="control-label">No of beds:*</label>
                            <p>Available room types</p>
                            <select style="width: 40%; text-align: left" class="form-control" id="roomType"
                                    name="roomType">
                                @foreach($beds as $bed)
                                    <option value="{{$bed}}"
                                            @if (old('roomType') == $bed) selected="selected" @endif>{{$bed==0?$bed:$bed."-bed"}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}"
                             style="text-align: left">
                            <label for="comments" class="control-label">Comments:</label>
                            <p>Any additional comments</p>
                            <textarea style="width: 70%; text-align: left" id="comments" name="comments"
                                      placeholder="Comments"
                                      class="form-control">{{ old('comments') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                {{ csrf_field() }}
                <div id="submitOrBack" style="margin-top: 2%">
                    <input class="btn btn-success" type="submit" value="Create Room">
                    <a class="btn btn-danger" href="{{route('participants.rooming')}}">Back</a>
                </div>
            </form>
        </div>


    </div>
@endsection