@extends('layouts.app')

@section('background')style='background: #2e3192'@endsection

@section('content')
    <div class="container">
        <div class="row" style="text-align: center">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4" style="align: center!important;">
                    <div class="small-box bg-green" style="background: white!important">
                        <div class="inner" style="color: #2E3192">
                            <p>You have</p>
                            <h3 id="demo" style="color: #2E3192"></h3>
                            <p>left to register</p>
                        </div>
                        <div class="inner" style="color: #2E3192">
                            <h3>{{$registrations}}</h3>
                            <p>Registrations so far</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center"><h2>Get one step closer to The Crete
                            Trip {{\Carbon\Carbon::now()->year}}!</h2></div>


                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="name" class="control-label">First Name*</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="surname" class="control-label">Surname*</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" name="surname"
                                           value="{{ old('surname') }}" required>

                                    @if ($errors->has('surname'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="email" class="control-label">E-Mail Address*</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="password" class="control-label">Password*</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password"
                                           value="{{ old('password') }}" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-4">
                                    <label for="password-confirm" class="control-label">Confirm
                                        Password*</label>
                                </div>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="section" class="control-label">ESN Section*</label>
                                    <h6>Choose the ESN Section of the University you are studying in. If you are a
                                        friend of an Erasmus student studying in Greece, choose your friend's ESN
                                        Section. <b>Choose No ESN Section if you are studying in a city in Greece which does not have ESN Section</b></h6>
                                </div>
                                <div class="col-md-6">
                                    <select id="section" class="form-control" name="section" required>
                                        @foreach($sections as $section)
                                            <option value="{{$section}}"
                                                    @if (old('section') == $section) selected="selected" @endif>{{$section}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('section'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('section') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('esncard') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="esncard" class="control-label">ESNCard no</label>
                                    <h6>Please write your ESNcard number, if you are an ESNcard holder. If you don't
                                        have one now, you can easily add one later. In order to be valid, you need to
                                        register your ESNcard at <a href="https://esncard.org">www.ESNcard.org</a></h6>
                                </div>
                                <div class="col-md-6">
                                    <input id="esncard" type="text" class="form-control" name="esncard"
                                           value="{{ old('esncard') }}">

                                    @if ($errors->has('esncard'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('esncard') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="document" class="control-label">ID/Passport no*</label>
                                    <h6>It is only going to be used during the check-in at the hotel</h6>
                                </div>
                                <div class="col-md-6">
                                    <input id="document" type="text" class="form-control" name="document"
                                           value="{{ old('document') }}" required>

                                    @if ($errors->has('document'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="birthday" class="control-label">Birthday*</label>
                                    <h6>dd.mm.yyyy</h6>
                                </div>
                                <div class="col-md-6">
                                    <input id="birthday" type="text" class="form-control" name="birthday"
                                           value="{{ old('birthday') }}" required>

                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="gender" class="control-label">Gender*</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="gender" class="form-control" name="gender" required>
                                        <option value="0"></option>
                                        <option value="male" @if (old('gender') == 'male') selected="selected" @endif>
                                            Male
                                        </option>
                                        <option value="female"
                                                @if (old('gender') == 'female') selected="selected" @endif>Female
                                        </option>
                                    </select>

                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="name" class="control-label">Phone no*</label>
                                    <h6>Please enter a Greek phone number, if you have one. Your group leader may need a
                                        way to contact you. Please include Country Code (e.g. +30 6971234567)</h6>
                                </div>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone"
                                           value="{{ old('phone') }}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="country" class="control-label">Where are you from?*</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="country" class="form-control" name="country" required>
                                        @foreach($countries as $country)
                                            <option value="{{$country}}"
                                                    @if (old('country') == $country) selected="selected" @endif>{{$country}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('boat') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="boat" class="control-label">Transportation TO/FROM Crete*</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="boat" class="form-control" name="boat" required>
                                        <option value="0"></option>
                                        <option value="Travel BOTH WAYS with the group"
                                                @if (old('boat') == 'Travel BOTH WAYS with the group') selected="selected" @endif>
                                            Travel BOTH WAYS with the group
                                        </option>
                                        <option value="Travel WITH THE GROUP to Crete and return INDIVIDUALLY"
                                                @if (old('boat') == 'Travel WITH THE GROUP to Crete and return INDIVIDUALLY') selected="selected" @endif>
                                            Travel WITH THE GROUP to Crete and return INDIVIDUALLY
                                        </option>
                                        <option value="Travel INDIVIDUALLY to Crete and return WITH THE GROUP"
                                                @if (old('boat') == 'Travel INDIVIDUALLY to Crete and return WITH THE GROUP') selected="selected" @endif>
                                            Travel INDIVIDUALLY to Crete and return WITH THE GROUP
                                        </option>
                                        <option value="Travel BOTH WAYS INDIVIDUALLY"
                                                @if (old('boat') == 'Travel BOTH WAYS INDIVIDUALLY') selected="selected" @endif>
                                            Travel BOTH WAYS INDIVIDUALLY
                                        </option>
                                        <option value="I study in Crete"
                                                @if (old('boat') == 'I study in Crete') selected="selected" @endif>I
                                            study in Crete
                                        </option>
                                    </select>

                                    @if ($errors->has('boat'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('boat') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('tshirt') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="tshirt" class="control-label">T-shirt size*</label>
                                </div>

                                <div class="col-md-6">
                                    <select id="tshirt" class="form-control" name="tshirt" required>
                                        <option value="0"></option>
                                        <option value="XS" @if (old('tshirt') == 'XS') selected="selected" @endif>XS
                                        </option>
                                        <option value="S" @if (old('tshirt') == 'S') selected="selected" @endif>S
                                        </option>
                                        <option value="M" @if (old('tshirt') == 'M') selected="selected" @endif>M
                                        </option>
                                        <option value="L" @if (old('tshirt') == 'L') selected="selected" @endif>L
                                        </option>
                                        <option value="XL" @if (old('tshirt') == 'XL') selected="selected" @endif>XL
                                        </option>
                                        <option value="XXL" @if (old('tshirt') == 'XXL') selected="selected" @endif>
                                            XXL
                                        </option>
                                    </select>

                                    @if ($errors->has('tshirt'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('tshirt') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="city" class="control-label">City in Greece:*</label>
                                    <h6>Please enter the city you currently study in, Greece or Cyprus. If you are an
                                        International guest, tell us your city of residence.</h6>
                                </div>
                                <div class="col-md-6">
                                    <input id="city" type="text" class="form-control" name="city"
                                           value="{{ old('city') }}" required>

                                    @if ($errors->has('city'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="facebook" class="control-label">Link to Facebook Profile</label>
                                    <h6>Enter your facebook profile URL so that you can be contacted by you group
                                        leaders (e.g. https://www.facebook.com/TheCreteTrip)
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    <input id="facebook" type="text" class="form-control" name="facebook"
                                           value="{{ old('facebook') }}">

                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('facebook') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('allergies') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="allergies" class="control-label">Do you have any allergies?</label>
                                    <h6>If you have any known allergies or any food restrictions, please let us
                                        know</h6>
                                </div>
                                <div class="col-md-6">
                                    <textarea id="allergies" class="form-control" name="allergies"
                                              rows="2">{{old('allergies')}}</textarea>

                                    @if ($errors->has('allergies'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('allergies') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('comments') ? ' has-error' : '' }}">
                                <div class="col-md-4">
                                    <label for="comments" class="control-label">Any comments?</label>
                                    <h6>Any additional comments for the Organising Committee or your Group Leader
                                    </h6>
                                </div>

                                <div class="col-md-6">
                                    <textarea id="comments" class="form-control" name="comments"
                                              rows="2">{{old('comments')}}</textarea>

                                    @if ($errors->has('comments'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('comments') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    @captcha
                                </div>
                            </div>


                            <div class="form-group">
                                <h6 class="col-md-4"><b>By submitting this form, I declare that I have read and agree to
                                        the <a href="{{route('terms')}}" target="_blank">Terms & Conditions
                                        </a></b></h6>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>


                    </div>

                </div>
                <div class="panel panel-default">
                    <div id="partners">
                        <h3 style="text-align: center"><b>Our Partners:</b></h3>
                        <div class="row">
                            <div class="col-md-6" style="text-align: center">
                                <a href="http://www.crete.gov.gr/index.php?lang=en" target="_blank"><img height=150
                                                                                                         src="{{asset('images/partners/partner1.png')}}"></a>
                            </div>
                            <div class="col-md-6" style="text-align: center">
                                <a href="http://www.crete.gov.gr/index.php?lang=en" target="_blank"><img height=150
                                                                                                         src="{{asset('images/partners/partner2.png')}}"></a>
                            </div>
                        </div>
                        <div class="row" style="margin-top: 4%;margin-bottom: 3%">
                            <div class="col-md-6" style="text-align: center">
                                <a href="https://www.vodafonecu.gr/" target="_blank"><img height=150
                                                                                          src="{{asset('images/partners/partner3.jpg')}}"></a>
                            </div>
                            <div class="col-md-6" style="text-align: center">
                                <a href="https://www.eurosender.com/" target="_blank"><img height=150
                                                                                           src="{{asset('images/partners/partner4.png')}}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("Mar 11, 2018 23:59:59").getTime();

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>
@endsection