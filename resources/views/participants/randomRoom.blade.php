@extends('layouts.participants.master')

@section('content')
    <div style="text-align: center;margin-top: 10%">
        <h3>Join a random room</h3>
        <p>Don't know anyone, all your friends are taken or your desired room-type is unavailable?</p>
        <p>Here you can join a random room.</p>
        <p> If you have any preferences regarding being matched with other participants that have also selected the random room option, please say so in the comments field below!</p>
        <p>We will try our best to match you with the most suitable people, but even if you ask for specific roommates, we cannot guarantee that you will be assigned a room with them.</p>
        <p>If you have any questions or encounter any problems, don't hesitate to contact us using the <a href="https://thecretetrip.org/contact">contact form</a></p>


        <div class="container">
            <form method="POST" action="{{ route('participants.doRandomRoom') }}">
                <div class="row" style="margin-top: 2%">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}"
                             style="text-align: center">
                            <label for="comments" class="control-label">Comments:</label>
                            <p>Please give us the full names of your desired roommates and tell them to do the same!</p>
                            <textarea style="width: 40%; text-align: left;margin: auto" id="comments" name="comments"
                                      placeholder="Comments"
                                      class="form-control">{{ old('comments') }}</textarea>
                        </div>
                    </div>
                </div>
                {{ csrf_field() }}
                <div id="submitOrBack" style="margin-top: 2%">
                    <input class="btn btn-warning" type="submit" value="Join Random Room">
                    <a class="btn btn-danger" href="{{route('participants.rooming')}}">Back</a>
                </div>
            </form>
        </div>

    </div>
@endsection