    <!-- Start Header -->
<div class="sticky-wrapper">
    <header id="header" class="header_transparent light" style='background-color: #000000;'>
        <!-- Start Container -->
        <div class="container">
            <div class="row">
            
            
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
                    <div id="logo">
                      <a href="{{ route('home_path') }}" >
                        <img src='images/eideal_logo_white.png' alt='Spread Communications'/>
                      </a><h1 style='display:none'><a href=http://spreadcomms.com>Spread Communications</a></h1></div> 
                 </div>
                
                
                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-8">
                 <div class="default_menu ">
                    <nav class="mainmenu hidden-xs hidden-sm visible-md visible-lg navbar">
                      <ul class="menu" style="display: block;">

                        <li <?php if($pagename == 'about-us') echo 'class="active"'; ?>><a href="{{ route('about_us_path') }}">ABOUT US <span class="sr-only">(current)</span></a></li>
                        <li <?php if($pagename == 'products') echo 'class="active"'; ?> ><a href="{{ route('all_products_path') }}">PRODUCTS</a></li>
                        <li class="dropdown" <?php if($pagename == 'news-0' || $pagename == 'videos') echo 'class="active"'; ?>>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MEDIA <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="{{ route('news_path',0) }}">NEWS</a></li>
                            <li><a href="{{ route('videos_path') }}">VIDEOS</a></li>

                          </ul>
                        </li>

                        <li class="dropdown" <?php if($pagename == 'brands-1' || $pagename == 'brands-2' || $pagename == 'brands-3' || $pagename == 'brands-4') echo 'class="active"'; ?>>
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BRANDS <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="brands-1">AMAZON KERATIN</a></li>
                            <li><a href="brands-2">FacePro</a></li>
                            <li><a href="brands-4">Vern</a></li>
                          </ul>
                        </li>

                        <li <?php if($pagename == 'where-to-buy-0') echo 'class="active"'; ?>><a href="{{ route('where_to_buy_path',0) }}">WHERE TO BUY</a></li>
                        <li <?php if($pagename == 'contact-us') echo 'class="active"'; ?>><a href="{{ route('contact_us_path') }}">CONTACT US</a></li>
                        <li>
                          {{ Form::open(['route' => 'products_path_search', 'role' => 'form']) }}
                            <div class="navMenu expander">
                              <input type="text" name="sequence" placeholder="Search">
                            </div>
                          {{ Form::close() }}
                        </li>
                        

                        <div id="smLinks" class="align_right">
                            <div class="header-div" style="float:right;">
                         {{ Form::open(['route' => 'products_path_search', 'role' => 'form']) }}
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 select_currency_div" >
                              <b style="color:white;">Currency:</b> 
                             
                              <select class="currency_select" name="price" id="curr_change">
                                 <option <?php if(Session::get('quoteCurrency') == "AED") echo "selected"; ?> value="AED" title="UAE Dirham"> AED - د.إ </option>
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

                      </ul>
                    </nav>                    
                  </div>
                </div>
                 
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
            
                <a id="mobile-menu-expand-collapse" href="#" class="show-mobile-menu hidden-md hidden-lg"></a>

                 
              </div>
                
            </div>
        </div><!-- End Row -->
        <!-- End Container -->
    </header>
</div>

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

</script>

