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

      <ol class="carousel-indicators">

        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <?php 
        $actual_date = Carbon::now('Asia/Beirut');
        $i =1; 
      ?>

     <?php 
      for($i=1; $i<=sizeof($slideShowList)-1; $i++) 
      {
    ?>
        <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}"></li>
    <?php
      }
    ?>
     
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/slideshow/{{ $slideShowList[0]->img_url }}" alt="Eideal | Hair tools in Dubai, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care" title="Eideal hair tools" style="width: 100%;">
        </div>

      <?php $c =1; ?>
      @foreach ($slideShowList as $s)  
        <?php 
          if($c > 1) 
          {
        ?>
            <div class="item">
              <img src="images/slideshow/{{ $s->img_url }}" alt="Eideal | Hair tools in Dubai, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care" title="Eideal hair tools" style="width: 100%;">
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

    <div class="container">
        <div class="row">
            <p class="best-seller-title"><b>PRODUCT OF THE MONTH</b></p>
        </div>

        <?php  
           $disable_price_flag = 0;

           //test if the product has an disabled price or price = 0 => set flag to 1 
           if($productMonth[0]->disable_price == 1 || $productMonth[0]->price == 0)
             $disable_price_flag = 1;
         ?>
        
        <div class="row">
            <div class=" col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-1 col-sm-10 col-xs-12">
               <?php 
                 $product_id = $productMonth[0]->product_id;
                 $sub_category_id = $productMonth[0]->sub_category_id;
                 $product_month_title_link = str_replace('|', ' ', $productMonth[0]->title);
                ?>
              <a class="product_img_link" href="{{ route('products_details_path', array($product_id, $sub_category_id, 'USD', $productMonth[0]->subcategory_title, $product_month_title_link) ) }}">
              
              @if( ($productMonth[0]->promo_start_date != NULL && $productMonth[0]->promo_end_date != NULL) && ($actual_date >= $productMonth[0]->promo_start_date && $actual_date <= $productMonth[0]->promo_end_date) )
                <div class="discount_percentage_prod_of_month"> - {{ $productMonth[0]->percentage }}% </div>
              @endif

              @if( $productMonth[0]->sold_out == 1 )
                <div class="discount_percentage_prod_of_month" style="width:75px;"> Sold Out</div>
              @endif

              <img id="main_img_src" src="images/products/{{ $productMonth[0]->img1 }}" class="best-seller-image" alt="{{ $productMonth[0]->title }}" title="{{ $productMonth[0]->title }}" style="margin-bottom: 10px; border:1px solid #e0e0e0;"/>
              </a>
           
              <div>
                    
                <div style="padding-left:0px;" class="col-lg-9 col-md-9 col-sm-9">
                    <h1 class="main-product-h1">{{ $productMonth[0]->title }}</h1>
                    <p>{{ $productMonth[0]->small_desc }} </p>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3">
                  <?php 
                    $price = $productMonth[0]->price; 
                    $price = number_format((float)$price*$curr, 2, '.', '');
                  ?>


                <!-- check if the product of the month is sold out -->
                @if( $productMonth[0]->sold_out == 0 )  

                   <!-- test if the product has an enabled price or  -->
                   @if($disable_price_flag == 0)
                      @if( ($productMonth[0]->promo_start_date != NULL && $productMonth[0]->promo_end_date != NULL) && ($actual_date >= $productMonth[0]->promo_start_date && $actual_date <= $productMonth[0]->promo_end_date) )
                                <div class="main-product-price" style="position:relative; top:10px;">
                                {{ number_format($price*(100-$productMonth[0]->percentage)/100, 2, '.', ' ') }} {{ $quoteCurr }} 
                                <span class="discount_price_home_page"> <strike>{{ number_format($price, 2, '.', ' ') }} {{ $quoteCurr }}</strike></span>
                                </div>
                              @else
                                <div class="main-product-price" style="position:relative; top:10px;"> {{ number_format($price, 2, '.', ' ') }} {{ $quoteCurr }} </div>
                              @endif


                    <!-- test if the product is not liquid -->
                      @if($productMonth[0]->liquid_product == 0)
                      <a href="{{ route('cart_path_product', array($product_id) ) }}" class="best-seller-button"> ADD TO CART</a>  
                      @endif

                      <!-- test if the product is liquid -->
                      @if($productMonth[0]->liquid_product == 1)
                      {{ Form::open(['route' => 'home_path']) }}

                        <input name="liquid_product_id" type="hidden" value="{{$productMonth[0]->product_id}}" >
                        <input name="submit_liquid_product" type="submit" value="ADD TO CART" class="best-seller-button" style="border:none;"/>
                        
                      {{ Form::close() }}
                      @endif

                    @else <!-- product price is disabled  -->
                        <a class="best-seller-button ask_exp_link" href="{{ route('contact_us_path') }}"> ASK THE EXPERT </a>
                    @endif 

                @endif


                </div>

              </div>

            </div>
            
        </div>
      

        @if(!empty($mediaList))
          <div class="row" style="margin-top: 20px; margin-bottom: 20px;">
              <h1 class="in-the-media-h1" style="margin-left: 15px;"> IN THE MEDIA </h1>
              @foreach( $mediaList as $m)
                 @if($m->url != null)
                    <a target="_blank" href="{{$m->url}}" class="col-lg-2 col-md-3 col-sm-3 col-xs-4 media_link">
                      <img src="images/medias/{{$m->img}}" class="main-product-image media_img" style="margin-bottom: 10px;" alt="Eideal Medias" title="Eideal media"/>
                    </a>
                  @else
                    <div id="{{ $m->media_id }}" class="col-lg-2 col-md-3 col-sm-3 col-xs-4 media_link media_img_link" style="cursor:pointer;" onclick="showModal(this.id)">
                       <img data-toggle="modal" data-target="#myModal" src="images/medias/{{$m->img}}" class="main-product-image media_img" alt="Eideal Medias" title="Eideal media" style="margin-bottom: 10px;"/>
                    </div>
                     
                    <!-- Modal -->
                    <div id="myModal_{{ $m->media_id }}" class="modal fade all_modal" role="dialog" style="z-index:9500;">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php echo strtoupper($productMonth[0]->title) ?></h4>
                          </div>
                          <div class="modal-body">
                           <img style="width:100%;" src="images/medias/{{ $m->img }}" alt="Eideal Medias" title="Eideal media" >
                          </div> 
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>
                   @endif
              @endforeach
          </div>
        @endif

        <br/>

        <div class="row">
            <p class="page-separator"><b>BEST SELLERS</b></p>
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

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                        <p> {{$b->small_desc}} </p>
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

        

        <div class="row">
            <p class="page-separator" style=""><b>BRANDS</b></p>
        </div>

        <div class="row" style="margin-top: 25px; margin-bottom: 25px;">
            @foreach($brandsImages as $b)
              <?php $link = $b->brand_id.'-'.$b->brand_title; ?>
               <div class="col-md-3 col-sm-3 col-xs-12"><a href="{{ route('brands_path', $link ) }}" class="thumbnail"><img src="images/brands/{{$b->url_img}}" style="max-width:100%;" alt="{{$b->brand_title}}" title="{{$b->brand_title}}"></a></div>
            @endforeach
    
        </div>

        <div class="row" style="margin-top: 25px; margin-bottom: 25px;">
            <div class="item">
              <div class="col-md-12">
                <table>

                   <tr>
                       <td class="bottom-table hidden-xs">
                           <i class="fa fa-4x fa-money bottom-icon"></i>
                          <h1> Cash on Delivery </h1>
                          <p> We offer competitive prices on our 30 plus product range </p>
                      </td>
                      <td class="bottom-table delivery_box">
                          <i style="margin-top:-20px;" class="fa fa-4x fa-truck bottom-icon"></i>
                          <h1> 48 Hours Free Delivery </h1>
                          <p class="delivery_product"> Products available in stock </p>
                      </td>
                      <td class="bottom-table">
                          <i class="fa fa-4x fa-credit-card bottom-icon"></i>
                          <h1> Safe Payment </h1>
                          <p> Pay with the world's most popular and secure payment methods </p>
                      </td>
                      <td class="bottom-table hidden-xs">
                          <i class="fa fa-4x fa-cart-arrow-down bottom-icon"></i>
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


    <script>

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