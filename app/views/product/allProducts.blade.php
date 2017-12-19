@extends('layouts.default')

@section('title', 'Eideal | Hair tools in Dubai and Lebanon, curling iron, flat iron, hairdryer, beauty supplier, salon supplier, hair care')
@section('description', 'Hair tools and accessories in Dubai. Whether you’re a hair professional or simply a hair enthusiast and lover, eideal.com is here to take your experience and journey to the next level.')

<?php 

  $keywords = '';

  foreach ($all_subcategoryList as $a)
  {
    $keywords = $keywords.$a->title.', ';
  }

  $keywords = rtrim($keywords, ', ');
 ?>

@section('keywords', $keywords)
@section('robots', 'INDEX,FOLLOW')

@section('content')

 <div id="start"class="container">
  <br/>
      <div class="col-lg-3 col-md-3 col-sm-3 ">
        <br/ class="hidden-xs">
        <hr class="hidden-xs" style="border-top:2px solid #dfdfdf;"> </hr>
        @include('layouts.partials.sidebar')
      </div>

      <div id="products" class="visible-xs" style="height:45px"></div>
      <div class="col-lg-7 col-md-7 col-sm-9">

          <div class="row">
              <h1 class="product_center_title"> 
                Product Categories
              </h1> 
          </div>

          <div class="row product_squares">

              <?php 
              $c=0;
              foreach ($all_subcategoryList as $a)
              {
                if($c%3 == 0 && $c!=0)
                {
                  ?>
                  </div>
                   <div class="row product_squares">
              <?php
              }  
              ?>  

                   <div class="col-lg-4 col-md-4">
                      <div class="panel panel-default">  
                      <?php $link = $a->sub_category_id.'-'.$a->title; ?>        
                          <div class="panel-body product_hover_click less_padding" onclick="location.href='{{ route('products_path', $link) }}'">
                              <h1 class="best-seller-h1" style="margin-top:0px; height:30px;">{{ $a->title }}</h1>
                              <img alt="Eideal {{ $a->title }}" title="Eideal {{ $a->title }}" src="images/products_category/{{ $a->image }}" class="best-seller-image height_img"/> 
                          </div> 
                       </div>
                   </div>

                  <?php
              $c++;
              }

              ?>

          </div>

          <br/>
      </div>   

      <div class="col-lg-2  col-md-2 hidden-sm product_delivery_details">
        <div class="row">
             </br>
             <i class="fa fa-5x fa-truck bottom-icon symbol"></i>
             <h3>48 hours Free Delivery</h3>
             <p>Products available in stock</p>
           </br>
        </div> 
          
        <div class="row">
          </br>
            <i class="fa fa-5x fa-credit-card bottom-icon symbol"></i>
            <h3>Safe Payment</h3>
             <p>Pay with the world's most popular and secure payment methods</p></br></br>
        </div>

        <div class="row">
             </br>
             <i class="fa fa-5x fa-money bottom-icon symbol"></i>
             <h3>Cash on Delivery</h3>
             <p>We offer competitive prices on our 30 plus product range</p>
           </br>
        </div> 
          
        <div class="row">
          </br>
            <i class="fa fa-5x fa-cart-arrow-down bottom-icon symbol"></i>
            <h3>Shop with Confidence</h3>
            <p>Our Buyer Protection covers your purchase from click to delivery</p></br></br>
          </div>
        </div> 

      </div>   
      <br/>
      <br/>

 </div>



<script type='text/javascript' src='js/header_margin.js'></script>

@stop