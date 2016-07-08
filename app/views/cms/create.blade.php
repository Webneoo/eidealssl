<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <title data-ng-bind="pageTitle()">Eideal </title>

     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
     <!-- Optional theme -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
     <!-- Latest compiled and minified JavaScript -->
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
     <!-- Main CSS -->
     <link href="/css/main.css" rel="stylesheet" type="text/css">
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
     <script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>


</head>

<body>
   <div class="container">
       <div class="row" style="margin-top:200px;">
           <div class="col-md-4 col-md-offset-4">
               <div class="login-panel panel panel-default">
                   <div class="panel-heading">
                       <h3 class="panel-title">Please Sign In</h3>
                   </div>
                   <div class="panel-body">
                       {{ Form::open(['route' => 'admin_cms_path', 'role' => 'form']) }}
                           <fieldset>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Username" name="username" autofocus>
                               </div>
                               <div class="form-group">
                                   <input class="form-control" placeholder="Password" name="password" type="password" value="">
                               </div>
                               <div class="checkbox">
                                   <label>
                                       <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                   </label>
                               </div>
                               <!-- Change this to a button or input when using this as a form -->
                               {{ Form::submit('Login', ['class' => 'btn btn-primary'])  }}
                           </fieldset>
                       {{ Form::close() }}
                   </div>
               </div>
           </div>
       </div>
   </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
