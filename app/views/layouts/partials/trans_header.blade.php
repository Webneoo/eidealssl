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
                        <li <?php if($pagename == 'news-0') echo 'class="active"'; ?>><a href="{{ route('news_path',0) }}">NEWS</a></li>
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

