@extends('layouts.default')


@section('title', 'Eideal | '.$product_info[0]->title)

<?php 
// remove html tags
$desc = strip_tags($product_info[0]->text);
// remove white space and line-break
$desc = preg_replace('/[\r\n]+/', " ", $desc);
$desc = preg_replace('/[ \t]+/', ' ', $desc);

 ?>

@section('description', $desc)
@section('keywords', 'Hair tools, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care, keratin, hair brushes, round brush, ceramic brush, scissors, '.$product_info[0]->title)
@section('robots', 'INDEX,FOLLOW')


@section('content')

 <div id="start" class="container">
  <br/ class="hidden-xs"><br/ class="hidden-xs">
  <div class="row">
    <div class="col-lg-3 col-md-3 product_detail_sidebar">
      <hr style="border-top:2px solid #dfdfdf; margin-top:0px;"> </hr>
    </div>
    <div class="col-lg-9 col-md-9">
      <div class="row"> 
          @foreach ($product_info as $p)
          <h3 class="col-lg-9 col-md-9 col-sm-9 col-xs-6 product_details_name">{{ strtoupper($p->title) }}</h3>
          @endforeach
         

      </div> <!-- end row -->

      <hr style="border-top:2px solid #dfdfdf; margin-top:-10px; clear:both;"> </hr>
    </div>
  
  </div>
  <br/>
  <div class="row">

      <div class="col-lg-3 col-md-3 col-sm-3" style="margin-top:-50px;">
        <br/>
        @include('layouts.partials.sidebar')
      </div> <!-- end side menu -->

      <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 border_row">
        <div class="row">
       @foreach ($product_info as $p)

       <?php
          $disable_price_flag = 0;

          //test if the product has an disabled price or price = 0 => set flag to 1  -->
          if($p->disable_price == 1 || $p->price == 0)
            $disable_price_flag = 1;
        ?>

          <!-- check if the product has an active promo -->

         <?php $actual_date = Carbon::now('Asia/Beirut'); ?>

          @if( ($p->promo_start_date != NULL && $p->promo_end_date != NULL) && ($actual_date >= $p->promo_start_date && $actual_date <= $p->promo_end_date) )
            <div class="discount_percentage_prod_of_month" style="position:relative; left:-10px;"> - {{ $p->percentage }}% </div>
          @endif

          @if($p->sold_out == 1)
            <div class="discount_percentage_prod_of_month" style="position:relative; left:-10px; width:75px;"> Sold Out </div>
          @endif


          <?php $main_img = 'images/products/'.$p->img1; ?>

          <div class="col-lg-4 col-md-4">
           
            <!-- Lets make a simple image magnifier -->
            <div class="magnify">
               <!-- This is the magnifying glass which will contain the original/large version -->
               <div class="large"></div>

               <!-- This is the small image -->
               <img id="main_img_src" src="images/products/{{ $p->img1 }}" class="best-seller-image product_detail_image small" alt="{{$p->title}}" title="{{$p->title}}"/>
            </div>

          </div>


          <div class="col-lg-8 col-md-8">
            <div class="panel-body">
                  <h1 class="product_details_h1"><?php echo strtoupper($p->title) ?></h1>
                  <div class="product_code"><b>{{ $p->code }}</b></div>
                  <p>
                      {{ $p->text }}
                  </p>
                  <div class="best-seller-price">
                    <?php 
                        $price = $p->price; 
                        $price = number_format((float)$price*$curr, 2, '.', '');
                      ?>
                  </div>
                  <div>
                    <!-- test if the product has an enabled price or  -->
                    @if($disable_price_flag == 0)

                      <b style="font-size:18px;">Price: </b>

                      @if( ($p->promo_start_date != NULL && $p->promo_end_date != NULL) && ($actual_date >= $p->promo_start_date && $actual_date <= $p->promo_end_date) )

                        <span class="product-details-price"> <b> {{ $price*(100-$p->percentage)/100 }} {{ $quoteCurr }} </b></span>
                          <span class="discount_price_home_page"> <strike>{{ $price }} {{ $quoteCurr }}</strike></span>
                    
                      @else
                      <span class="best-seller-price" style="position:relative; top:0px;"> <b> {{ $price }} {{ $quoteCurr }} </b></span>
                      @endif

                    @endif
                  </div>

                    <br/><br/>
                  <div class="row">
                    <?php 
                    for($r=1; $r<=4; $r++) 
                    { $img = 'img'.$r;
                      ?>
                      @if($p->$img != '')
                      <div id="image_num_<?php echo $r; ?>" class="col-lg-3 col-md-3 col-sm-6 col-xs-6 img_product_thumb" onclick="changeImgSrc(this.id);">
                        <img src="images/products/{{ $p->$img }}" class="details_related_image" style="width:100%;" alt="{{$p->title}}" title="{{$p->title}}"/>
                      </div>
                      @endif
                    <?php
                    }    
                    ?>
                  </div>

                  <!-- test if the product is sold out -->
                  @if($p->sold_out == 0)

                     <!-- test if the product has an enabled price or  -->
                      @if($disable_price_flag == 0)

                          <!-- test if the product is not liquid -->
                          @if($p->liquid_product == 0)
                          <a href="{{ route('cart_path_product', array($product_id) ) }}" class="best-seller-button" style="float:left;"> ADD TO CART</a>  
                          @endif

                          <!-- test if the product is liquid -->
                          @if($p->liquid_product == 1)
                          {{ Form::open(['route' => ['products_details_path', $p->product_id, $p->sub_category_id, 'USD', $p->subcategory_title ,$p->title ], 'role' => 'form']) }}

                            <input name="liquid_product_id" type="hidden" value="{{$p->product_id}}" >
                            <input name="submit_liquid_product" type="submit" value="ADD TO CART" class="best-seller-button" style="float:left; border:none;"/>
                            
                          {{ Form::close() }}
                          @endif
                          
                      @endif

                  @endif

                  <button type="button" class="ask_the_expert" style="position:relative; top:26px; left:8px;">
                    <a href="{{ route('contact_us_path') }}"> ASK THE EXPERT </a>
                  </button>   
                  <div class="sm_share_div">
                    <div class="share_details"><b>Share: </b></div> 
                    <div class="media_pictures_details">
                      <a target="blank" style="text-decoration:none;" 
                         onclick="window.open(this.href, 'mywin', 'left=350, top=50, width=700,height=400,toolbar=1,resizable=0'); return false;" 
                         href="http://www.facebook.com/sharer.php?u=https://eideal.com/details-products-{{ $p->product_id }}-{{ $p->sub_category_id }}">
                         <i class="fa fa-3x fa-facebook-square" style="color:#676767;"></i>
                      </a>  
                      <a href="mailto:?subject=Eideal Products&body=Hi,%0D%0A%0D%0A Check out the new item that I found on the website https://eideal.com %0D%0A" ><i class="fa fa-3x fa-envelope-square" style="color:#676767;"></i></a>

                    </div>
                  </div>

                  @if($p->youtube_url != NULL)
                  <br/><br/><br/><br/>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                       <div class="news_title">{{ $p->youtube_title }}</div><br/>
                       <iframe class="youtube_iframe_products" width="100%" src="https://www.youtube.com/embed/{{ $p->youtube_url }}?modestbranding=1&autohide=1&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                  </div>
                  @endif

            
            </div> <!-- panel-body -->
          </div> <!-- end col-8 -->
        @endforeach 

        <br/>
        </div> <!-- end row -->

        @if(!empty($mediaList))
          <div class="row">
            <div class="col-lg-7 col-md-7 col-xs-7">
              <h1 class="media_details" style="margin-bottom:-15px">IN THE MEDIA</h1>
              <hr style="border-top:1px solid black;"> </hr>
            </div>
          </div>

          <div class="row">
             @foreach( $mediaList as $m)
                 @if($m->url != null)
                    <a target="_blank" href="{{$m->url}}" class="col-lg-2 col-md-3 col-sm-3 col-xs-4 media_link">
                      <img src="images/medias/{{$m->img}}" class="main-product-image media_img_2" style="margin-bottom: 10px;"/>
                    </a>
                  @else
                    <div id="{{ $m->media_id }}" class="col-lg-2 col-md-3 col-sm-3 col-xs-4 media_link media_img_link" style="cursor:pointer;" onclick="showModal(this.id)">
                       <img data-toggle="modal" data-target="#myModal" src="images/medias/{{$m->img}}" class="main-product-image media_img_2" style="margin-bottom: 10px;"/>
                    </div>
                     
                    <!-- Modal -->
                    <div id="myModal_{{ $m->media_id }}" class="modal fade all_modal" role="dialog" style="z-index:9500;">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php echo strtoupper($p->title) ?></h4>
                          </div>
                          <div class="modal-body">
                           <img style="width:100%;" src="images/medias/{{ $m->img }}">
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
      </div> <!-- end border_row -->
 </div>

 <div class="row" style="margin-top:10px; margin-bottom:25px;">

  <div class="col-lg-9 col-lg-offset-3">
    <div class="row">
    <div class="related_products_details col-lg-12">RELATED PRODUCTS
     <hr style="border-top:2px solid #dfdfdf; margin-top:0px;"> </hr>
    </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        
          @foreach($related_products as $r)

            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 bottom_margin_related_products">
              <a class="related_products_link" href="{{ route('products_details_path', array($product_id, $id, 'USD', $r->subcategory_title, $r->title) ) }}">
                <img src="images/products/{{ $r->img1 }}" class="details_related_image" style="width:100%;" title="{{ $r->title }} - {{$r->code}}" alt="{{ $r->title }}"/>
              </a>
            </div>

          @endforeach
        </div>

   </div>
  </div>
</div>

<div class="row" style="margin-bottom:40px;">

  <div class="col-lg-9 col-lg-offset-3">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 icon_awesome_detail product_bottom_icons" style="padding-top:15px;" >
      <i class="fa fa-4x fa-money" style="color:#676767;"></i>
      <h4 class="h4_details_delivery"><b>Cash on Delivery</b></h4>
      <p> We offer competitve prices on our 30 plus product range</p>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 icon_awesome_detail product_bottom_icons">
      <i class="fa fa-4x fa-truck" style="color:#676767;"></i>
      <h4 class="h4_details_delivery"><b>48 hours Free Delivery</b></h4>
      <p>Products available in stock</p>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 icon_awesome_detail product_bottom_icons">
      <i class="fa fa-4x fa-credit-card" style="color:#676767;"></i>
      <h4 class="h4_details_delivery"><b>Safe Payment</b></h4>
      <p>Pay with the world's most popular and secure payment methods</p>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 icon_awesome_detail product_bottom_icons">
      <i class="fa  fa-4x fa-cart-arrow-down" style="color:#676767;"></i>
      <h4 class="h4_details_delivery"><b>Shop with Confidence</b></h4>
      <p>Our buyer Protection covers your purchase from click to delivery</p>
    </div>
  </div>
</div>

</div>


<script type="text/javascript">

// get the main image of the selected product
 var main_img=<?=json_encode($main_img)?>;

 
 $( document ).ready(function() {
   $('.large').css('background-image', 'url(\'../'+main_img+'\')');
});
 

  //function that change the source of the main image when clicking on a thumbnail image
  function changeImgSrc(id)
  {   
     var img_src = '';
     var img_src = $('#'+id).children().attr('src');
    $('#main_img_src').attr("src", img_src);
   
   //change the background image of the magnifier
    $('.large').css('background-image', 'url(\'../'+img_src+'\')');
  }

   // get your select element and listen for a change event on it
    $('#currency').change(function() {
      // set the window's location property to the value of the option the user has selected
      window.location = $(this).val();
    });

    // change the background of the selected image
   $('.large').css('background-image', 'url(\'../images/products/1442474035-1-CB4.jpg\')');



    // hide and show the pop up of the "in media section"

      $('#flash-overlay-modal').modal();


      function showModal(media_id)
      {
       $(".all_modal").modal('hide');
       $("#myModal_"+media_id+"").modal('show');
      }
</script>

<script type='text/javascript' src='js/zoom_magnifier.js'></script>


<!-- Call the JS of the magnifier  -->
<script type='text/javascript' src='js/header_margin.js'></script>
<!-- Lets load up prefixfree to handle CSS3 vendor prefixes -->
<script src="http://thecodeplayer.com/uploads/js/prefixfree.js" type="text/javascript"></script>
<!-- You can download it from http://leaverou.github.com/prefixfree/ -->




@stop