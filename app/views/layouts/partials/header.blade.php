<header style="height:40px;">

    <div class="center-div" >
         <div class="header-div hidden-sm hidden-xs">
             <a href="{{ route('home_path') }}"><img class="logo_big" src="images/logo1.png"/></a>
         </div>
        <div class="header-div" style="margin-right: 30px; margin-left:120px;">
            <i class="fa fa-truck hidden-xs" style="color:white;"></i> <span class="header_links hidden-xs"> FREE DELIVERY </span>
        </div>
        <div class="header-div">
            <i class="fa fa-usd hidden-xs" style="color:white;"></i> <span class="header_links hidden-xs">CASH ON DELIVERY</span>
        </div>

        <div class="header-div" style="float:right">
            @if(! Auth::user())
                 <a href="{{ route('sign_up_path') }}" class="header_links" style="margin-right: 20px;">SIGN UP</a>
                 <a href="{{ route('sign_in_path') }}" class="header_links" style="margin-right: 20px;">LOGIN</a>
            @else
                <a href="{{ route('my_account_path') }}" class="header_links" style="margin-right: 20px;"> Hi, {{ Session::get('username') }} </a>
                <a href="{{ route('sign_out_frontend_path') }}" class="header_links" style="margin-right: 20px;"> LOGOUT </a>
            @endif

            <a href="{{ route('cart_path') }}" class="fa fa-shopping-cart cart_link" style="color:white;">
                <?php 
                    $cart_item = Session::get('cart_item');
                    if(isset($cart_item) && $cart_item != 0)
                    {
                 ?>
                <span class="red_notification"> {{ $cart_item }} </span> 

                    <?php 

                    }

                     ?>
            </a>
        </div>
    </div>

</header>