 @extends('layouts.default')

@section('content')

<!-- slideshow a faire -->

 <div id="start" class="container blockContainer">

 	<div class="col-lg-2 col-md-2 col-xs-12 reorder-xs-1 product_delivery_details" style="margin-top:83px;">
    <div class="row">
         <i class="fa fa-5x fa-credit-card bottom-icon symbol"></i>
         <h3>Safe Payment</h3>
         <p>Pay with the world's most popular and secure payment methods</p>
       </br>
    </div> 
      
      <div class="row">
        <i class="fa fa-5x fa-floppy-o bottom-icon symbol"></i>
        <h3>Shop with Confidence</h3>
         <p>Our Buyer Protection covers your purchase from click to delivery</p></br></br>
      </div>
  </div> 



 	<div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 reorder-xs-2 col-xs-12" style="text-align:center;">
    <br/>
    <div class="row" style="margin-top:20px;">
		@foreach ($brand_info as $b)
      <div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0" style="text-align:center;">
  			<img style="margin-bottom:5px;" src="images/brands_logo/{{ $b->brand_logo }}"/>
  		</div>
    @endforeach
    </div>

    <div class="row">
  		<div class="col-lg-12 col-lg-offset-0 col-md-12 col-md-offset-0" style="text-align:center;">

              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="margin-bottom: 20px;">
                <!-- Indicators -->

                <ol class="carousel-indicators">

                      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <?php $i =1; ?>
                   <?php 
                    for($i=1; $i<=sizeof($brand_images)-1; $i++) 
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
                    <img src="images/brands/{{ $brand_images[0]->url_img }}" alt="" style="width: 100%;">
                  </div>

                <?php $c =1; ?>
                @foreach ($brand_images as $b)  
                  <?php 
                    if($c > 1) 
                    { 
                  ?> 
                      <div class="item">
                        <img src="images/brands/{{ $b->url_img }}" alt="" style="width: 100%;">
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

  			<hr style="border-top:2px solid #dfdfdf;"> </hr>
  		</div>
      </div>

      @foreach ($brand_info as $b)
        <div class="row" style="font-family: 'MontserratRegular';">
          @if(!empty($b->title1) && !empty($b->desc1))
        		<div class="col-lg-12 col-md-12" style="text-align:center;">
        			<h4>{{ $b->title1 }}</h4>
        			<p style="font-size:12px;">{{ $b->desc1 }}</p>
        			<hr style="border-top:2px solid #dfdfdf;"> </hr>
        		</div>
           @endif 
        </div>
      @endforeach


      @foreach ($brand_info as $b)
        <div class="row" style="font-family: 'MontserratRegular';">
          @if(!empty($b->title2) && !empty($b->desc2))
            <div class="col-lg-12 col-md-12" style="text-align:center;">
              <h4>{{ $b->title2 }}</h4>
              <p style="font-size:12px;">{{ $b->desc2 }}</p>
              <hr style="border-top:2px solid #dfdfdf;"> </hr>
            </div>
           @endif 
        </div>
      @endforeach


       @foreach ($brand_info as $b)
        <div class="row" style="font-family: 'MontserratRegular';">
          @if(!empty($b->title3) && !empty($b->desc3))
            <div class="col-lg-12 col-md-12" style="text-align:center;">
              <h4>{{ $b->title3 }}</h4>
              <p style="font-size:12px;">{{ $b->desc3 }}</p>
              <hr style="border-top:2px solid #dfdfdf;"> </hr>
            </div>
           @endif 
        </div>
      @endforeach


       @foreach ($brand_info as $b)
        <div class="row" style="font-family: 'MontserratRegular';">
          @if(!empty($b->title4) && !empty($b->desc4))
            <div class="col-lg-12 col-md-12" style="text-align:center;">
              <h4>{{ $b->title4 }}</h4>
              <p style="font-size:12px;">{{ $b->desc4 }}</p>
              <hr style="border-top:2px solid #dfdfdf;"> </hr>
            </div>
           @endif 
        </div>
      @endforeach


       @foreach ($brand_info as $b)
        <div class="row" style="font-family: 'MontserratRegular';">
          @if(!empty($b->title5) && !empty($b->desc5))
            <div class="col-lg-12 col-md-12" style="text-align:center;">
              <h4>{{ $b->title5 }}</h4>
              <p style="font-size:12px;">{{ $b->desc5 }}</p>
              <hr style="border-top:2px solid #dfdfdf;"> </hr>
            </div>
           @endif 
        </div>
      @endforeach

    </div>

    <div class="col-lg-2  col-lg-offset-1 col-md-2 col-md-offset-1 col-xs-12 product_delivery_details" style="margin-top:83px;">
        <div class="row">
             <i class="fa fa-5x fa-truck bottom-icon symbol"></i>
             <h3>48 hours Free Delivery</h3>
             <p> Products available in stock </p>
           </br>
        </div> 
          
        <div class="row">
            <i class="fa fa-5x fa-credit-card bottom-icon symbol"></i>
            <h3>Cash on delivery</h3>
             <p>We offer competitive prices on our 30 plus product range</p></br></br>
        </div>
     </div> 

 </div>

<script type='text/javascript' src='js/header_margin.js'></script>
@stop