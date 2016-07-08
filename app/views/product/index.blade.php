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
                @if(!isset($fromSearch))
                 {{ $subcategory_info->title }} 
                @else
                 {{ $sequence }}
                @endif
              </h1> 
            @if(!isset($fromSearch))
              <label class="product_subtitle">SORT BY</label>

              <select id="price" class="sortby_input" name="price">
                  <option <?php if(!isset($order)) echo "selected"; ?> value="products-{{ $id }}">sort by</option>
                  <option <?php if(isset($order) && $order == 0) echo "selected"; ?> value="products-{{ $id }}-0">Price low to high</option>
                  <option <?php if(isset($order) && $order == 1) echo "selected"; ?> value="products-{{ $id }}-1">Price High to low</option>
              </select>
              <div class="grey_line"> </div>
            @endif
          </div>

            <!-- if the search didn't return any result --> 
            @if(empty($productsList))
            <br/>
            <div class="no_results"> <i style="color:#eecc38" class="fa fa-exclamation-triangle"></i> No results found for <b>"{{ $sequence }}"</b> </div> 

            @endif



          <div class="row product_squares">

              <?php 
              $c=0;
              foreach ($productsList as $p)
              {
                if($c%3 == 0 && $c!=0)
                {
                  ?>
                  </div>
                   <div class="row product_squares">
              <?php
              }  
              ?>  

                   <div class="col-lg-4 col-md-4 product_box">
                      <div class="panel panel-default panel_product_box">
                              <?php $product_id = $p->product_id; ?>
                                <div class="panel-body product_hover_click less_padding" onclick="location.href='{{ route('products_details_path', array($product_id, $id, "AED") ) }}'">
                                  
                                    <img src="images/products/{{ $p->img1 }}" class="best-seller-image height_img"/>
                                    
                                    <h1 class="best-seller-h1">{{ $p->title }}</h1>
                                    <p class="product_small_desc"> {{ $p->small_desc }} </p>
                                    <?php 
                                      $price = $p->price; 
                                      $price = number_format((float)$price, 2, '.', '');
                                    ?>

                                    <div class="best-seller-price absolute_position"> ${{ $price }} </div>
                                 </div> 


                                <!-- test if the product is not liquid -->
                                @if($p->liquid_product == 0)
                                <a href="{{ route('cart_path_product', array($product_id) ) }}" class="best-seller-button add_to_cart_link"> ADD TO CART</a>  
                                @endif

                                <!-- test if the product is liquid -->
                                @if($p->liquid_product == 1)
                                {{ Form::open(['route' => ['products_path', $p->sub_category_id], 'role' => 'form']) }}

                                  <input name="liquid_product_id" type="hidden" value="{{$p->product_id}}" >
                                  <input name="submit_liquid_product" type="submit" value="ADD TO CART" class="best-seller-button add_to_cart_link" style="border:none;"/>
                                  
                                {{ Form::close() }}
                                @endif

                                <br/>
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
             <p><b> Products found in stock </b></p>
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



 <script>
    // get your select element and listen for a change event on it
    $('#price').change(function() {
      // set the window's location property to the value of the option the user has selected
      window.location = $(this).val();
    }); 
</script>
<script type='text/javascript' src='js/header_margin.js'></script>

@stop