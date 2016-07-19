@extends('layouts.default')

@section('content')

 <div id="start"class="container">
  <br/>
      <div class="col-lg-3 col-md-3 col-sm-3 ">
        <br/>
        <hr style="border-top:2px solid #dfdfdf;"> </hr>
        @include('layouts.partials.sidebar')
      </div>

      <div id="products" class="visible-xs" style="height:45px"></div>
      <div class="col-lg-7 col-md-7 col-sm-9">

          <div class="row">
              <h1 class="product_center_title"> 
                Products categories
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
                          <div class="panel-body product_hover_click less_padding" onclick="location.href='{{ route('products_path', $a->sub_category_id) }}'">
                              <h1 class="best-seller-h1" style="margin-top:0px; height:30px;">{{ $a->title }}</h1>
                              <img alt="{{ $a->title }}" title="{{ $a->title }}" src="images/products_category/{{ $a->image }}" class="best-seller-image height_img"/> 
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
      </div>   
      <br/>
      <br/>

 </div>



<script type='text/javascript' src='js/header_margin.js'></script>

@stop