@extends('layouts.default')

@section('content')

 <div id="start" id="container" class="container">
<br/><br/>
    <div class="row">
	 	 <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3">
			<h3 class="login_title"><b>Forgot your password?</b></h3>
			<h5 class="login_title">TO RESET YOUR PASSWORD, ENTER YOUR USERNAME AND WE WILL SEND YOU AN E-MAIL</h5>
       @include('flash::message') 
		 </div>
    </div>

       <div class="row">
           <div class="col-md-4 col-md-offset-4">
               <div class="login-panel panel panel-default">
                 
                   <div class="panel-body">
                       {{ Form::open(['route' => 'password_forgotten_step_2_path', 'role' => 'form']) }}
                           <fieldset>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Username" name="username" autofocus>
                               </div>
                               {{ Form::submit('Retrieve Password', ['class' => 'btn button_login'])  }}
                              
                               	<a class="btn btn-default return_login" href="{{ route('sign_in_path') }}" role="button">Return to login</a>
                            
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