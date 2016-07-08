<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="description" content="">

     <title data-ng-bind="pageTitle()">Eideal CMS</title>

     <!-- Bootstrap Core CSS -->
          <link href="/css/bootstrap.min.css" rel="stylesheet">
          <!-- MetisMenu CSS -->
          <link href="/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
          <!-- Custom CSS -->
          <link href="/css/sb-admin-2.css" rel="stylesheet">
          <!-- Morris Charts CSS -->
          <link href="/css/plugins/morris.css" rel="stylesheet">
          <!-- Custom Fonts -->
          <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

          <!-- DataTables CSS -->
          <link href="/css/plugins/dataTables.bootstrap.css" rel="stylesheet">

          <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

          <!-- The styles -->
          <link rel="stylesheet" type="text/css" media="screen" href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/master/build/css/bootstrap-datetimepicker.min.css">

          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   
          <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
          <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
          <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
          <![endif]-->
          <!-- jQuery -->
          <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
          <script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>

          <script src="//cdn.ckeditor.com/4.5.3/full/ckeditor.js"></script>


</head>


<body>

        @include('cms.layouts.partials.nav')

        <div id="wrapper">
            <div id="page-wrapper">

                 @yield('content')

            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
        <!-- Metis Menu Plugin JavaScript -->
        <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
        <!-- Custom Theme JavaScript -->
        <script src="js/sb-admin-2.js"></script>

</body>
</html>
