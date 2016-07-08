
 <ul class="nav navbar-top-links navbar-right">

   <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="">
        Hi, {{ Session::get('username') }}
        {{--
           <img class="nav-gravatar" src="{{ gravatar_link($currentUser->email) }}" alt="{{ $currentUser->username }}">
           Hi, {{ $currentUser->username }}
        --}}
           <i class="fa fa-caret-down"></i>
       </a>
       <ul class="dropdown-menu dropdown-user">
           {{--<li><a href="{{ route('profile_path') }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
           </li>--}}
           <li><a href="{{ route('sign_out_path') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
           </li>
       </ul>
       <!-- /.dropdown-user -->
   </li>
   <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->