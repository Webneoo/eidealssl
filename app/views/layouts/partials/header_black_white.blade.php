<div class="black_container">
  <div class="black_content">
    <div class="b_header_1"> 
        Your go-to online hair products store  &nbsp&nbsp | &nbsp&nbsp <i class="fa fa-phone" aria-hidden="true"></i>
        +971 42594665  &nbsp&nbsp | &nbsp&nbsp
    </div>

    <div class="b_header_2" atle="color:white;"> 

       {{ Form::open(['route' => 'products_path_search']) }}
          <div>
            <select style="color:white; background:#212121; border:1px solid #212121; cursor:pointer" class="currency_select" name="price" id="curr_change">
               <option <?php if(Session::get('quoteCurrency') == "AED") echo "selected"; ?> value="AED" title="UAE Dirham" selected> AED - د.إ </option>
               <option <?php if(Session::get('quoteCurrency') == "BHD") echo "selected"; ?> value="BHD" title="Bahraini Dinar"> BHD - د.ب </option>
               <option <?php if(Session::get('quoteCurrency') == "EGP") echo "selected"; ?> value="EGP" title="Egyptian Pound"> EGP - £ </option>
               <option <?php if(Session::get('quoteCurrency') == "EUR") echo "selected"; ?> value="EUR" title="Euro"> EUR - € </option>
               <option <?php if(Session::get('quoteCurrency') == "GBP") echo "selected"; ?> value="GBP" title="British Pound"> GBP - £ </option>
               <option <?php if(Session::get('quoteCurrency') == "IQD") echo "selected"; ?> value="IQD" title="Iraqi Dinar"> IQD - د.ع </option>
               <option <?php if(Session::get('quoteCurrency') == "INR") echo "selected"; ?> value="INR" title="Indian Rupee"> INR </option>
               <option <?php if(Session::get('quoteCurrency') == "IRR") echo "selected"; ?> value="IRR" title="Iran Rial"> IRR - ﷼</option>
               <option <?php if(Session::get('quoteCurrency') == "JOD") echo "selected"; ?> value="JOD" title="Jordanian Dinar"> JOD - ينار </option>
               <option <?php if(Session::get('quoteCurrency') == "KWD") echo "selected"; ?> value="KWD" title="Kuwaiti Dinar"> KWD - ‎د.ك </option>
               <option <?php if(Session::get('quoteCurrency') == "LBP") echo "selected"; ?> value="LBP" title="Lebanese Pound"> LBP - L.L </option>
               <option <?php if(Session::get('quoteCurrency') == "OMR") echo "selected"; ?> value="OMR" title="Omani Rial"> OMR - ﷼ </option>
               <option <?php if(Session::get('quoteCurrency') == "QAR") echo "selected"; ?> value="QAR" title="Qatar Rial"> QAR - ﷼ </option>     
               <option <?php if(Session::get('quoteCurrency') == "SAR") echo "selected"; ?> value="SAR" title="Saudi Arabian Riyal"> SAR - ﷼ </option>
               <option <?php if(Session::get('quoteCurrency') == "SYP") echo "selected"; ?> value="SYP" title="Syrian Pound"> SYP - £ </option>
               <option <?php if(Session::get('quoteCurrency') == "TRY") echo "selected"; ?> value="TRY" title="Turkish Lira"> TRY  </option>
               <option <?php if(Session::get('quoteCurrency') == "USD") echo "selected"; ?> value="USD" title="US Dollars"> USD - $ </option>
               <option <?php if(Session::get('quoteCurrency') == "YER") echo "selected"; ?> value="YER" title="Yemen Riyal"> YER - ﷼ </option>
            </select>
          </div>

       {{ Form::close() }}

    </div>


    <div class="b_header_3"> 
       <div class="login">
        @if(! Auth::user())
          <a title="Sign Up" href="{{ route('sign_up_path') }}" class="signup-btn"><i style="color:white;" class="fa fa-user"></i>&nbsp<span class="d-none d-md-inline-block">Sign Up</span></a>
          &nbsp&nbsp&nbsp
          <a title="Login" href="{{ route('sign_in_path') }}"><i style="color:white;" class="fa fa-sign-in"></i>&nbsp<span class="d-none d-md-inline-block">Login</span></a>
        @else
          <a href="{{ route('my_account_path') }}" class="header_links" style="margin-right: 20px;"> Hi, {{ Session::get('username') }} </a>

          <a title="Log out" href="{{ route('sign_out_frontend_path') }}" class="signup-btn"><i style="color:white;" class="fa fa-sign-out"></i>&nbsp<span class="d-none d-md-inline-block">Logout</span></a>
        @endif  
        </div> 
    </div>

  </div>
</div>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">

      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

       
      <a href="{{ route('cart_path') }}" class="fa fa-shopping-cart cart_link navbar-toggle hidden-lg hidden-md hidden-sm" style="border:none; color:black;">
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

      <a class="navbar-brand" href="{{ route('home_path') }}"> <img src='images/eideal_logo_black.png' alt='Eideal Logo' title="Eideal"/> </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
      <ul class="nav navbar-nav navbar-right">
        <li <?php if($pagename == 'Hair-products') echo 'class="menu_selected"'; ?> ><a href="{{ route('all_products_path') }}">SHOP</a></li>
        <li <?php if($pagename == 'about-us') echo 'class="menu_selected"'; ?>><a href="{{ route('about_us_path') }}">ABOUT US</a></li>
        <li class="dropdown" <?php if($pagename == 'news-0' || $pagename == 'videos') echo 'class="menu_selected"'; ?>>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MEDIA <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('news_path',0) }}">NEWS</a></li>
            <li><a href="{{ route('videos_path') }}">VIDEOS</a></li>
          </ul>
        </li>

        <li class="dropdown {{ ( (strpos($pagename, 'brands-') !== false) ) ? 'menu_selected' : '' }}" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BRANDS <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @foreach($menu_brands as $b)
            <?php $url_name = str_replace(" ", "-", $b->brand_title); ?>
             <li><a href="brands-{{$b->brand_id}}-{{ $url_name}}">{{ $b->brand_title }}</a></li>
            @endforeach
          </ul>
        </li>

        <li class="dropdown {{ ( (strpos($pagename, 'services-') !== false) ) ? 'menu_selected' : '' }}" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SERVICES <span class="caret"></span></a>
          <ul class="dropdown-menu">
          @foreach($menu_services as $s)
            <li><a href="service-{{$s->service_id}}">{{ $s->title}}</a></li>
          @endforeach
          </ul>
        </li>

        <li <?php if($pagename == 'contact-us') echo 'class="menu_selected"'; ?>><a href="{{ route('contact_us_path') }}">CONTACT US</a></li>
        <li>
          {{ Form::open(['route' => 'products_path_search']) }}
            <div class="navMenu expander">
              <input class="search_input" type="text" name="sequence" placeholder="Search">
            </div>
          {{ Form::close() }}
        </li>

        <li>
            <a href="{{ route('cart_path') }}" class="fa fa-shopping-cart cart_link hidden-xs">
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
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




<script type="text/javascript">
  
  $(document).on('blur change','#curr_change',function(){
 
      // set the window's location property to the value of the option the user has selected
     
      var quoteCurrency = $(this).val();
      
      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('[name="_token"]').val()
      }
    });

   $.ajax({
          type: "POST",
          url : "currency-convert",
          data: { 'currency': quoteCurrency, '_token': $('input[name=_token]').val() },
          success:function(data){
             location.reload();
          }
      });

});


  $(window).scroll(function (event) {
    var scroll = $(window).scrollTop();
    if( scroll > 30)
      $('.navbar').css('margin-top', '0px');
    else
      $('.navbar').css('margin-top', '30px');
});


  // open dropdown list on mouse over
  $('.dropdown').mouseover(function () {

      $(this).addClass('open');
  });

  // close dropdown list on mouse out
   $('.dropdown').mouseout(function () {

      $(this).removeClass('open');
  });


</script>
