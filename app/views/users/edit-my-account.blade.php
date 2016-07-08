@extends('layouts.default')

@section('content')

<div id="start" class="container">
  <br/>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';">
			<h3>Edit Account</h3>
			<hr style="border-top:2px solid #dfdfdf;"> </hr>
      @include('cms.layouts.partials.errors')
      @include('flash::message')
		</div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 my_Account_details">
          {{ Form::open(['route' => 'edit_my_account_path', 'role' => 'form']) }}
            @foreach($user_info as $u)
               <table style="margin:auto;">
                <br/>
        		    <tr>
                  <td style="text-align:right; margin-top:10px;"><p><b>First name:</b></p></td>
                  <td style="text-align:left; padding-left:15px;"><p><input class="form-control" type="text" name="firstname" value="{{ $u->firstname }}"></p></td>
                </tr>  
                <tr>
                   <td style="text-align:right;"><p><b>Last Name:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p><input class="form-control" type="text" name="lastname" value="{{ $u->lastname }}"></p></td>
                </tr>
               	<tr>
                   <td style="text-align:right;"><p><b>Phone:</b></td>
                   <td style="text-align:left; padding-left:15px;"><p><input class="form-control" type="tel" name="phone" value="{{ $u->phone }}"></p></td>
                </tr>
               	<tr>
                   <td style="text-align:right;"><p><b>Birthday:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>
                      <div class='input-group date' id='datetimepicker1'>
                         {{ Form::text('birth_date', $u->birth_date, ['class' => 'form-control', 'placeholder' => 'Birth Date', 'required' => 'required'])  }}
                         <span class="input-group-addon">
                           <span class="glyphicon glyphicon-calendar"></span>
                         </span>
                     </div>

              <!--       <input type="date" name="birth_date" value="{{ $u->birth_date }}"> -->
                  </p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>E-mail:</b> </p></td>
                   <td style="text-align:left; padding-left:15px;"><p><input class="form-control" type="email" name="email" value="{{ $u->email }}"></p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>City</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p><input class="form-control" type="text" name="city" value="{{ $u->city }}"></p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Address</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p><input class="form-control" type="text" name="address" value="{{ $u->address }}"></p></td>
                </tr>

            </table>   
        @endforeach
             
		    <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';">
			   <input type="submit" class="button_account" value="SAVE" style="margin-top:10px;"/>
		     </div>
         {{ Form::close() }}
        </div>
    </div>
</div>

   <script src="js/moment.js"></script>
   <script src="js/datepicker.js"></script>
   <script type="text/javascript">
       $(function () {
           $('#datetimepicker1').datetimepicker({
               pickTime: false,
               format: 'YYYY-MM-DD',
               minDate:  moment().add(-100, 'y'),
               maxDate: moment().add(2, 'y')
           });
       });
   </script>
<script type='text/javascript' src='js/header_margin.js'></script>

@stop