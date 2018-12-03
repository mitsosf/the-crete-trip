@extends('layouts.lcs.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Upload a proof of payment:</h3>
                <form action="{{route('lc.doUploadProof')}}" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="proof">File input</label>
                        <input type="file" class="form-control-file" id="proof" name="proof" aria-describedby="fileHelp">
                        <small id="fileHelp" class="form-text text-muted">Formats accepted: jpg,jpeg,png,pdf</small>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount:</label>
                        <h6>Enter the amount that is written on your proof of payment in NUMBERS</h6>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="eg. 140">
                    </div>
                    <div class="form-group">
                        <label for="comments">Comments</label>
                        <textarea class="form-control" id="comments" rows="2" name="comments"></textarea>
                    </div>
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <button type="submit" class="btn btn-primary">Submit</button>
                        @foreach ($errors->all() as $error)
                            <div style="color: red">{{ $error }}</div>
                        @endforeach
                </form>
            </div>
        </div>
    </div>


@endsection

@section('route'){{route('lc.asParticipant')}}@endsection