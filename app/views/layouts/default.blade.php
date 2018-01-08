<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>	@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="robots" content="@yield('robots')">
    <link rel="shortcut icon" href="images/logo_eideal.ico"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/style.css?v=<?php echo filemtime('css/style.css');?>" type="text/css" media="all" />
    <link rel="stylesheet" href="css/header_css.css?v=<?php echo filemtime('css/header_css.css');?>" type="text/css" media="all" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://rawgit.com/maciej-gurban/responsive-bootstrap-toolkit/master/dist/bootstrap-toolkit.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

    <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.15.35/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1509924475747974'); // Insert your pixel ID here.
    fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/?id=1509924475747974&ev=PageView&noscript=1"/>
    </noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->
  </head>

  <body>

        @include('layouts.partials.trans_header')

        @yield('content')

        @include('layouts.partials.footer')

        <script src='js/assets.js'></script>

        <script>
        /*  document.onmousedown=disableclick;
          status="Right Click Disabled";
          function disableclick(event)
          {
            if(event.button==2)
             {
               alert(status);
               return false;    
             }
          }*/
        </script>


        <!-- google analytics code -->

        <script>

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');


            ga('create', 'UA-76429814-1', 'auto');

            ga('send', 'pageview');

        </script>

  </body>

</html>


