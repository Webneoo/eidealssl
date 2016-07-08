@extends('layouts.default')

@section('content')

 
 <div id="start" class="container">
  <br/><br/>
 	<div class="row">
	 	 <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
			<h3 class="login_title"><b>LOGIN</b></h3>
      @include('flash::message')
		 </div>
    </div>

       <div class="row">
           <div class="col-md-4 col-md-offset-4">
               <div class="login-panel panel panel-default">
                   <div class="panel-body">
                       {{ Form::open(['route' => 'sign_in_path', 'role' => 'form']) }}
                           <fieldset>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Username" name="username" autofocus>
                               </div>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Password" name="password" type="password" value="">
                               </div>
                               {{ Form::submit('Login', ['class' => 'btn button_login'])  }}
                               <div class="signin_details">Not a member?<a href="{{ route('sign_up_path') }}"> Sign up.</a><br/>
                               	    <a href="{{ route('password_forgotten_step_1_path') }}">Forgot your password?</a>
                               </div>
                           </fieldset>
                       {{ Form::close() }}
                   </div>
               </div>
           </div>
       </div>
<br/>
</div> <!-- end container -->
<script type='text/javascript' src='js/header_margin.js'></script>

@stop