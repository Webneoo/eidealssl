@extends('layouts.default')

@section('title', 'Eideal | Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Hair tools and accessories in Dubai. Whether you’re a hair professional or simply a hair enthusiast and lover, eideal.com is here to take your experience and journey to the next level.')
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors')
@section('robots', 'INDEX,FOLLOW')

@section('content')

<blockquote style="position:absolute; left:-100%;">
  <p></p>
</blockquote>


  <div class="home_carousel_margin">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px;">
      <!-- Indicators -->

      <ol class="carousel-indicators carrousel_dots">

        <li data-target="#carousel-example-generic" data-slide-to="0" class="active hidden-xs"></li>
      <?php 
        $actual_date = Carbon::now('Asia/Beirut');
        $i =1; 
      ?>

     <?php 
      for($i=1; $i<=sizeof($slideShowList)-1; $i++) 
      {
      ?>
          <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" class='hidden-xs'></li>
      <?php
        }
      ?>
     
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/slideshow/{{ $slideShowList[0]->img_url }}" alt="Eideal | Hair tools in Dubai, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care | {{ $slideShowList[0]->title }}" title="Eideal hair tools" class="img_slideshow" style="width: 100%;">
          <div class="carousel-caption fade_bg hidden-sm hidden-xs">
              <h1 class="carousel-caption-header">{{ $slideShowList[0]->title }}</h1>
              <p class="carousel-caption-text hidden-sm hidden-xs">
                   {{ $slideShowList[0]->subtitle }}
              </p>
                @if($slideShowList[0]->link != NULL && $slideShowList[0]->link != '')
                   <a href="{{$slideShowList[0]->title}}" class="btn btn-primary call_to_action">Learn more</a>
                @endif
          </div>
        </div>
      <?php $c =1; ?>
      @foreach ($slideShowList as $s)  
        <?php 
          if($c > 1) 
          {
        ?>
            <div class="item">
              <img src="images/slideshow/{{ $s->img_url }}" alt="Eideal | Hair tools in Dubai, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care | {{ $slideShowList[0]->title }}" title="Eideal hair tools"  class="img_slideshow" style="width: 100%;">
              <div class="carousel-caption fade_bg hidden-sm hidden-xs">
                  <h1 class="carousel-caption-header">{{$s->title}}</h1>
                  <p class="carousel-caption-text hidden-sm hidden-xs">
                     {{$s->subtitle}}
                  </p>
                  @if($s->link != NULL && $s->link != '')
                    <a href="{{$s->title}}" class="btn btn-primary call_to_action">Learn more</a>
                  @endif
              </div>
            </div>
        <?php
          }
           $c++;
        ?>

      @endforeach  
      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>


    
    <div class="container" style="margin-bottom:80px;">
        <div class="row title_div">
            <h2 class="title_eideal raleway">PRODUCT CATEGORIES</h2>
            <span class="span_h2 lato">Choose a category and discover our best selling products</span>
        </div>
        <br/>

        <div class='row hidden-sm hidden-xs'>
          <div class='col-md-12'>
            <div class="carousel slide media-carousel" id="media">
              
              <div class="carousel-inner">
             
                <?php $active=1;  $p=1;?>

                <div class="item @if($active == 1) active @endif">
                  <div class="row">
                  @foreach($subcategories as $s)
                    <div class="col-md-3 categ_home_col">
                      <?php $link = $s->sub_category_id.'-'.$s->title; ?>        
                      <div class="thumbnail categ_box product_hover_click" onclick="location.href='{{ route('products_path', $link) }}'"><img alt="" src="images/products_category/{{$s->image}}" style="height:180px;"></div>
                      <div class="categ_title">{{$s->title}}</div>
                    </div>          
                    
                  <?php 
                    if($p%4 == 0 && $p!=sizeof($subcategories)) 
                    {
                      $active = 0;
                  ?>

                  </div>
                </div>
                <div class="item @if($active == 1) active @endif">
                  <div class="row">

                  <?php
                    }
                    $p++; // increment counter 
                  ?>

                  @endforeach       
                  </div>
                </div>

              </div>

              <a data-slide="prev" href="#media" class="left carousel-control left_arrow_container"><img class="left_arrow" src="images/prev.png"></a>
              <a data-slide="next" href="#media" class="right carousel-control right_arrow_container"><img class="right_arrow" src="images/prev.png"></a>
            </div>                          
          </div>
        </div>


        <div class='row hidden-lg hidden-md'>
          <div class='col-md-12'>
            <div class="carousel slide media-carousel" id="media2">
              
              <div class="carousel-inner">
             
                <?php  $p=1;?>

                @foreach($subcategories as $s)
                <div class="item @if($p == 1) active @endif">
                  <div class="row">
                 
                    <div class="col-md-12 categ_home_col">
                      <?php $link = $s->sub_category_id.'-'.$s->title; ?>        
                      <div class="thumbnail categ_box product_hover_click" onclick="location.href='{{ route('products_path', $link) }}'">
                        <img alt="" src="images/products_category/{{$s->image}}" style="height:180px;">
                      </div>
                      <div class="categ_title">{{$s->title}}</div>
                    </div>          

                  </div>
                </div>
                <?php $p++; ?>
                @endforeach       
              </div>

              <a data-slide="prev" href="#media2" class="left carousel-control left_arrow_container"><img class="left_arrow" src="images/prev.png"></a>
              <a data-slide="next" href="#media2" class="right carousel-control right_arrow_container"><img class="right_arrow" src="images/prev.png"></a>
            </div>                          
          </div>
        </div>



        <br/>
        <div class="row" style="text-align:center">
          <a class="btn btn-blue" style="padding-right:20px; padding-left:20px; margin-top:20px;" href="{{ route('all_products_path') }}">View All</a>
        </div>
    </div>
    

      <div class="parallax-window para_1" data-parallax="scroll" data-image-src="/images/slideshow/1454399666-_DSC834611.jpg">
        
          <div class="container parallax_container emphasis-title">  
                <h2 class="raleway h2_accessories">Hair Tools<span class="hidden-xs hidden-sm hidden-md"> & Accessories</span> !</h2>
                <p class="lead topmargin-sm lato" style="font-size: 19px; line-height:1;">Whether you’re a hair professional or simply a hair enthusiast and lover, eideal.com is here to take your experience and journey to the next level.</p>
                <br/>
                <a class="parallax_btn" href="{{route('all_products_path')}}">DISCOVER OUR PRODUCTS</a>                  
          </div>

      </div>



      <!--======================== BEST SELLERS =============-->
      <div class="container">

        <div class="row title_div">
            <h2 class="title_eideal raleway">BEST SELLERS</h2>
            <span class="span_h2 lato">Choose one of our best selling products.</span>
        </div>
        <br/>
        <div class="row">
          @foreach($bestSeller as $b)
           <?php  
             $disable_price_flag = 0;

             //test if the product has an disabled price or price = 0 => set flag to 1 
             if($b->disable_price == 1 || $b->price == 0)
               $disable_price_flag = 1;
           ?>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 best_seller_col">
                <div class="panel panel-default panel_product_box_2">
                    <div class="panel-body">
                      <?php 
                      $product_id = $b->product_id;
                      $sub_category_id = $b->sub_category_id;
                      $best_seller_title_link = str_replace('|', ' ', $b->title);

                      ?>
                      <a class="product_img_link" href="{{ route('products_details_path', array($product_id, $sub_category_id, 'USD', $b->subcategory_title, $best_seller_title_link) ) }}"> 
                        @if( ($b->promo_start_date != NULL && $b->promo_end_date != NULL) && ($actual_date >= $b->promo_start_date && $actual_date <= $b->promo_end_date) )
                          <div class="discount_percentage"> - {{ $b->percentage }}% </div>
                        @endif

                        @if( $b->sold_out == 1 )
                          <div class="discount_percentage" style="width:75px;"> Sold Out</div>
                        @endif

                        <img src="images/products/{{ $b->img1 }}" class="best-seller-image img_height_index" alt="{{ $b->title }}" title="{{ $b->title }}"/>
                      </a>
                        <h1 class="best-seller-h1">{{ $b->title }}</h1>
                        <p style='padding-left:15px; padding-right:15px;'> {{$b->small_desc}} </p>
                        <?php 
                          $price = $b->price; 
                          $price = number_format((float)$price*$curr, 2, '.', '');
                        ?>

                        <!-- Check if the best seller product is sold out -->
                        @if($b->sold_out == 0)
                        
                            <!-- if product price is enabled  -->
                            @if($disable_price_flag == 0)   
                              
                              @if( ($b->promo_start_date != NULL && $b->promo_end_date != NULL) && ($actual_date >= $b->promo_start_date && $actual_date <= $b->promo_end_date) )
                                <div class="best-seller-price absolute_best_seller"> 
                                {{ number_format($price*(100-$b->percentage)/100, 2, '.', ' ') }} {{ $quoteCurr }} 
                                <span class="discount_price_home_page"> <strike>{{ number_format($price, 2, '.', ' ') }} {{ $quoteCurr }}</strike></span>
                                </div>
                              @else
                                <div class="best-seller-price absolute_best_seller"> {{ number_format($price, 2, '.', ' ') }} {{ $quoteCurr }} </div>
                              @endif

                            
                              <!-- test if the product is not liquid -->
                              @if($b->liquid_product == 0)
                              <a href="{{ route('cart_path_product', array($product_id) ) }}" class="best-seller-button add_to_cart_button"> ADD TO CART</a>  
                              @endif

                              <!-- test if the product is liquid -->
                              @if($b->liquid_product == 1)
                              {{ Form::open(['route' => ['products_path', $b->sub_category_id]]) }}

                                <input name="liquid_product_id" type="hidden" value="{{$b->product_id}}" >
                                <input name="submit_liquid_product" type="submit" value="ADD TO CART" class="best-seller-button add_to_cart_button" style="border:none;"/>
                                
                              {{ Form::close() }}
                              @endif

                            @else <!-- product price is disabled  -->
                                <a class="best-seller-button add_to_cart_button ask_exp_link" href="{{ route('contact_us_path') }}"> ASK THE EXPERT </a>
                            @endif 

                        @endif  

                    </div>
                </div>
            </div>

          @endforeach

        </div>

      </div> <!-- end container -->
      <br/><br/>
      <div class="parallax-window para_2" data-parallax="scroll" data-image-src="/images/slideshow/1515424490_1454399777_hicham_eid_photo_vogue.jpg">
          <div class="container parallax_container emphasis-title">  
                <h2 class="raleway">Unique Brands</h2>
                <p class="lead topmargin-sm lato" style="font-size: 19px; line-height:1;">We specialize in hair products and accessories and distribute unique and international brands.</p>
                <br/>
                <a class="parallax_btn" href="{{route('brands_path', array(1, 'AMAZON-KERATIN'))}}">DISCOVER OUR BRANDS</a>                  
          </div>
      </div>

    <div class="container">
        <div class="row title_div">
            <h2 class="title_eideal raleway">OUR BRANDS</h2>
            <span class="span_h2 lato">We distribute unique and international brands in the region.</span>
        </div>
        <br/>

        <div class="row brands_row" style="margin-top: 25px; margin-bottom: 25px;">
            @foreach($brandsLogo as $b)
              <?php $link = $b->brand_id.'-'.$b->brand_title; ?>
               <div class="col-md-3 col-sm-3 col-xs-12 brands_col">
                  <a href="{{ route('brands_path', $link ) }}" class="thumbnail brands_a">
                    <img src="images/brands_logo/{{$b->brand_logo}}" style="max-width:100%;" alt="{{$b->brand_title}}" title="{{$b->brand_title}}">
                  </a>
                </div>
            @endforeach
    
        </div>

        <div class="row" style="margin-top: 25px; margin-bottom: 25px;">
            <div class="item">
              <div class="col-md-12">
                <table>

                   <tr>
                       <td class="bottom-table hidden-xs">
                           <i class="fa fa-4x fa-money bottom-icon" style="color:#417797"></i>
                          <h1> Cash on Delivery </h1>
                          <p> We offer competitive prices on our 30 plus product range </p>
                      </td>
                      <td class="bottom-table delivery_box">
                          <i style="margin-top:-20px; color:#417797;" class="fa fa-4x fa-truck bottom-icon"></i>
                          <h1> 48 Hours Free Delivery </h1>
                          <p class="delivery_product"> Products available in stock </p>
                      </td>
                      <td class="bottom-table">
                          <i class="fa fa-4x fa-credit-card bottom-icon" style="color:#417797;"></i>
                          <h1> Safe Payment </h1>
                          <p> Pay with the world's most popular and secure payment methods </p>
                      </td>
                      <td class="bottom-table hidden-xs">
                          <i class="fa fa-4x fa-cart-arrow-down bottom-icon" style="color:#417797;"></i>
                          <h1> Shop with Confidence </h1>
                          <p> Our Buyer Protection covers your purchase from click to delivery </p>
                      </td>
                   </tr>

                </table>

              </div>
            </div>
        </div>
    </div>
  </div> <!-- end home_carousel_margin -->



@if (!Session::has('newsletters_flag'))

  <div id="myModal_newsletters" class="modal fade all_modal" role="dialog" style="z-index:9500;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content new_letter_box">
        <div class="modal-header" style="background:#666666; color:white;">
          <button type="button" style="color:white; opacity:1;" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;">
          <?php echo strtoupper($newsletters_info[0]->newsletters_title) ?>
            
          </h4>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
             {{ $newsletters_info[0]->newsletters_text }}

             {{ Form::open(['route' => 'home_newsletters_signup', 'id' => 'newsletters_form']) }}

                   <div class="form-group">
                        {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email'])  }}
                    </div>
                    <span class="newletters_error"></span>
                    
                    <input id="sign_up_newsletters" type="submit" value="SIGN UP!" class="newsletters_signup">
                    <br/>
                {{ Form::close() }}
              </div>
              
          </div>
        </div> 

      </div>

    </div>
  </div>

  @endif


@if(isset($_POST['email']) && Session::has('newsletters_flag'))

<div id="myModal_flash_message" class="modal fade all_modal" role="dialog" style="z-index:9500;">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background:#666666; color:white;">
          <button type="button" style="color:white; opacity:1;" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="text-align:center;"></h4><br/>
        </div>
        <div class="modal-body newsletters_response">

           @include('flash::message')
          
        </div> 

      </div>

    </div>
</div>

@endif


  <!--  initiate a flag for the pop up letter (=1) to avoid showing it everytime during the same session -->
  <?php  
  Session::put('newsletters_flag', '1');
  ?>

  <script src="js/parallax.min.js"></script>
  <script>

    $('.para_1').parallax({imageSrc: '/images/slideshow/1454399666-_DSC834611.jpg'});
    $('.para_2').parallax({imageSrc: '/images/slideshow/1515424490_1454399777_hicham_eid_photo_vogue.jpg'});

  $( document ).ready(function() {

      function isEmail(email) {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
        }


        $("#myModal_newsletters").modal('show');
        $("#myModal_flash_message").modal('show');


        $( "#sign_up_newsletters" ).click(function( event ) {
          
          var email = $("input[name*='email']").val();
          
          var valid_email = isEmail(email);

          if(valid_email == false)
          {
            $('.newletters_error').html('Invalid email address');
            event.preventDefault();
          }
          

          });

         
        $('.carousel[data-type="multi"] .item').each(function(){
          var next = $(this).next();
          if (!next.length) {
            next = $(this).siblings(':first');
          }
          next.children(':first-child').clone().appendTo($(this));

          for (var i=0;i<2;i++) {
            next=next.next();
            if (!next.length) {
            	next = $(this).siblings(':first');
          	}

            next.children(':first-child').clone().appendTo($(this));
          }
        });



        //function that change the source of the main image when clicking on a thumbnail image
        function changeImgSrc(id)
        {   
           var img_src = '';
           var img_src = $('#'+id).children().attr('src');
          $('#main_img_src').attr("src", img_src);
        }


      $('#flash-overlay-modal').modal();


      function showModal(media_id)
      {
       $(".all_modal").modal('hide');
       $("#myModal_"+media_id+"").modal('show');

      }

   }); 

    </script>
     

@stop