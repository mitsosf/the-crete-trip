Dear {{Auth::user()->name}},<br><br>

Welcome to #TheCreteTrip2018! 🎊

We are really excited to have you with us in this UNFORGETTABLE journey.<br>
Now that your registration is successfully completed, it’s time to take it to the next level!😎 Contact your local ESN Section for info about payments and transportation. Keep in mind that spots are limited! The faster you pay your participation fee, the more secure your place is. 🍹<br>

Let’s get #LostInCrete together!🍍<br>

Here are your registration details. If you notice anything wrong, please contact us at https://thecretetrip.org/contact using the <a href="https://thecretetrip.org/contact">contact form</a>.<br><br>
<div class="panel-heading">My details:</div><br>
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
<br>

Cheers,<br>
The Crete Trip 2018 Organisers

