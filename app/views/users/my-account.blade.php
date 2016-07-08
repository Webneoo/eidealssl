@extends('layouts.default')

@section('content')


<div id="start" class="container">
  <br/>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';">
			<h3>My Account</h3>
			<hr style="border-top:2px solid #dfdfdf;"> </hr>
      @include('flash::message')
		</div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 my_Account_details">
            @foreach($user_info as $u)
        	<table style="margin:auto;">

                <tr>
                  <td style="text-align:right;"><p><b>Firstname:</b> </p></td>
                  <td style="text-align:left; padding-left:15px;"><p> {{ $u->firstname }} </p></td>
                </tr>  
                <tr>
                   <td style="text-align:right;"><p><b>Last Name:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->lastname }}</p></td>
                </tr>
               	<tr>
                   <td style="text-align:right;"><p><b>Username:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->username }}</p></td>
                </tr>
               	<tr>
                   <td style="text-align:right;"><p><b>Phone:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->phone }}</p></td>
                </tr>
               	<tr>
                   <td style="text-align:right;"><p><b>Birthday:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->birth_date }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>E-mail:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->email }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Country:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->country }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>City</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->city }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Address</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $u->address }}</p></td>
                </tr>

                <br/>
            </table>
           @endforeach
        </div>
    </div>

    <div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';">
			<a href="{{ route('edit_my_account_path') }}"><button class="button_account">Edit Account</button></a>
		</div>
    </div>

</div>

<script type='text/javascript' src='js/header_margin.js'></script>


@stop