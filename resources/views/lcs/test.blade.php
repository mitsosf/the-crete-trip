<head>
    <?php $user = DB::table('users')->where('surname','Pezron')->get()->first();?>
    <title>{{$user->name." ".$user->surname}}</title>
</head>
<body>
<style>
    * {
        box-sizing: border-box;
    }

    /* Create two unequal columns that floats next to each other */
    .column {
        float: left;
        padding: 10px;
    }

    .left {
        width: 60%;
    }

    .right {
        width: 40%;
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    table, th, td {
        border: 1px solid #2E3192;
        border-collapse: collapse;
    }
</style>

<div class="row" style="margin-top: 2%;background: #2E3192">
    <img src="{{asset('images/ESN-white.png')}}" height="50px" alt="" style="float: right;margin-right: 20px;">
</div>

<div class="row">
    <div class="column left">
        <img src="{{asset('images/logo.jpg')}}" height="250px" alt="">
    </div>
    <?php $lc = DB::table('users')->where('surname','Katsiantonis')->get()->first()?>
    <div class="column right" style="margin-right: 3%">
        <h3 style="color: #2E3192"><u>Payment by:</u></h3>
        <p>Name: <b>{{$user->name}}</b></p>
        <p>Surname: <b>{{$user->surname}}</b></p>
        <p>Email: <b>{{$user->email}}</b></p>
        <p>Phone no: <b>{{$user->phone}}</b></p>
        <p>ESN Section: <b>{{$user->section}}</b></p>
        <p>Time/Date: <b>{{\Carbon\Carbon::parse('2018-03-06 15:26:40')}}</b></p>
    </div>
</div>
<div class="row" style="margin-top: 5%">
    <h2 style="color: #2E3192;text-align: center"><u>PAYMENT CONFIRMATION</u></h2>
</div>
<div class="row">
    <table class="table" border="1" width="100%">
        <thead>
        <tr style="background-color: #2E3192;border:0px;color: white">
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        <tr style="border-color: #2E3192">
            <td style="border-color: #2E3192;text-align: center"><h4>Participant’s Fee The Crete Trip
                    2018</h4>
            </td>
            <td style="text-align: center">1</td>
            @if($user->section === 'ESN UOC - HERAKLION')
                @if($user->esncardstatus ==='active')
                    <td style="text-align: center">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value}}</td>
                @else
                    <td style="text-align: center">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value+10}}</td>
                @endif
            @else
                @if($user->esncardstatus ==='active')
                    <td style="text-align: center">{{DB::table('event')->where('attribute','fee')->get()->first()->value}}</td>
                @else
                    <td style="text-align: center">{{DB::table('event')->where('attribute','fee')->get()->first()->value+10}}</td>
                @endif
            @endif
        </tr>
        <tr>
            <td></td>
            <td><h3>Total:</h3></td>
            @if($user->section === 'ESN UOC - HERAKLION')
                @if($user->esncardstatus ==='active')
                    <td><h3 style="text-align: center">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value}}</h3></td>
                @else
                    <td><h3 style="text-align: center">{{DB::table('event')->where('attribute','reducedfee')->get()->first()->value+10}}</h3></td>
                @endif
            @else
                @if($user->esncardstatus ==='active')
                    <td><h3 style="text-align: center">{{DB::table('event')->where('attribute','fee')->get()->first()->value}}</h3></td>
                @else
                    <td><h3 style="text-align: center">{{DB::table('event')->where('attribute','fee')->get()->first()->value+10}}</h3></td>
                @endif
            @endif
        </tr>
        </tbody>
    </table>
</div>
<div class="row" style="margin-top: 7%;">
    <h2 style="color: #2E3192">Payment confirmed by:</h2>
    <p>Full name: <b>{{$lc->name.' '.$lc->surname}}</b></p>
    <p>LC Section: <b>{{$lc->section}}</b></p>
    <p>Email: <b>{{$lc->email}}</b></p>
    <p>#:
        <b>{{DB::table('sections')->where('name', $user->section)->get()->first()->reference.'4'}}</b>
    </p>

</div>
</body>