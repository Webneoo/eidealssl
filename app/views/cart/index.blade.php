@extends('layouts.default')

@section('content')

 <div id="start" class="container">
 <br/>
 <div class="row" style="text-align:center">
    <h1 class="page_h1"> SHOPPING CART </h1>
    <h2 class="page_h2"> YOU CURRENTLY HAVE {{ $itemNb }} ITEM(S) IN YOUR CART </h2>
 </div>
 
 <div class="table-responsive" style="margin-top:40px">
 <table class="table table-striped" style="min-height:260px;">
  <thead>
      <tr>
          <th>Product</th>
          <th style="text-align:center">Quantity</th>
          <th style="text-align:center">Unit Price ({{ $quoteCurr }})</th>
          <th style="text-align:center">Total</th>
          <th></th>
      </tr>
  </thead>

  <tbody>
        <?php $price = 0;?> 
        @if(!empty($cartList)) 
            @foreach($cartList as $c)
              @if(!is_null($c->qty))
                  <tr>
                    <td><p class="item_name_cart">{{ $c->name }} - {{ $c->id }} </p></td>
                    <td style="text-align:center;">
                      <div class="cart_item_value">
                        <span class="add_remove_cart" 
                              @if(Auth::check())
                                id="{{ $c->product_id }}"
                              @else
                               id="{{ $c->options->size }}" 
                              @endif
                              name="{{ $c->id }}" onclick="remove_one_item(this.id);"> <i class="fa fa-minus-circle"></i> </span>
                        {{ $c->qty }}
                        <span class="add_remove_cart" 
                             @if(Auth::check())
                                id="{{ $c->product_id }}"
                              @else
                               id="{{ $c->options->size }}" 
                              @endif 
                              name="{{ $c->id }}" onclick="add_one_item(this.id);"> <i class="fa fa-plus-circle"></i> </span>
                      </div>
                    </td>

                    <?php
                      $actual_date = Carbon::now('Asia/Beirut');
                      // check if the product has a product promo
                      if( ($c->promo_start_date != NULL && $c->promo_end_date != NULL) && ($actual_date >= $c->promo_start_date && $actual_date <= $c->promo_end_date) )
                      {
                          // affect the promo price to the product
                          $c->price = $c->price*(100-$c->percentage)/100;
                      }
                    ?>


                    <td style="text-align:center"><p class="cart_item_value">{{ number_format((float)$c->price*$curr, 2, '.', ' ') }}</p></td>
                    <td style="text-align:center"><p class="cart_item_value">
                      {{ number_format((float)($c->price*$c->qty*$curr), 2, '.', ' ')  }}
                    </p></td>
                    <td style="text-align:center">
                      <a onclick="return confirm('Are you sure that you want to remove this product <?php echo $c->name.' - '.$c->id; ?> from the cart?');" class="" 
                         @if(Auth::check())
                          href="{{ route('delete_cart_item_path', array($c->product_id, $c->id) ) }}"
                         @else
                          href="{{ route('delete_cart_item_path', array($c->options->size, $c->id) ) }}"
                         @endif
                         
                      >
                          <i class="fa fa-1x fa-trash-o fa-fw fa_trash_cart" style="margin-top:17px"></i>
                      </a>
                   </td>
                  </tr>

                  <?php // calculating the total of the cart

                     // Remove the white space for the thousand separator 
                     $price = str_replace(' ', '', $price); 

                     $price =  $price + ($c->price*$c->qty*$curr); 
                     $price = number_format((float)$price, 2, '.', ' ');
                  ?>
              @endif <!-- end if(!is_null($c->product_id)) -->
            @endforeach
          @endif <!-- !empty($cartList) -->
          


          <tr>
              <td style="font-family:MontserratLight; font-size:23px;"><b>Subtotal</b></td>
              <td></td>
              <td></td>
              <td style="text-align:center; font-family:MontserratLight; font-size:23px;"><b>{{ $price }} ({{ $quoteCurr }})</b></td>
              <td></td>
          </tr>
   
          <tr>
              <td style="font-family:MontserratLight; font-size:20px;"><b>VAT</b></td>
              <td></td>
              <td></td>
              <td style="text-align:center; font-family:MontserratLight; font-size:20px;"><b>{{ Config::get('global.VAT') }}%</b></td>
              <td></td>
          </tr>

          <tr>
              <td style="font-family:MontserratLight; font-size:25px;"><b>Total</b></td>
              <td></td>
              <td></td>
              <?php 
              // Remove the white space for the thousand separator 
                $price = str_replace(' ', '', $price); 
              ?>

              <td style="text-align:center; font-family:MontserratLight; font-size:25px;"><b>{{ number_format(($price + ($price*Config::get('global.VAT')/100)), 2, '.', ' ') }} ({{ $quoteCurr }})</b></td>
              <td></td>
          </tr>

          <tr>
              <td></td>
              <td></td>
              <td style="text-align:center">
                <a type="button" class="btn" style="width:160px; font-family:MontserratLight; color:white;background-color:#676767;"
                  <?php 
                  if(Session::get('product_id') != NULL) 
                  {
                  ?> 
                   href="{{ route('products_path', Session::get('product_id').'-hair products') }}"
                  <?php 
                  }
                  else
                  {
                  ?>
                  href="{{ route('all_products_path') }}"
                  <?php } ?>
                  >
                  Continue shopping
                </a>
              </td>
              <td style="text-align:center">
                <a <?php if($itemNb  == 0) echo 'onclick = "return false"';?> onclick="return checkSoldOutProducts();" type="button" class="btn" style="width:170px; font-family:MontserratLight; color:white;
                background-color:#5d8c7a;" href="{{ route('checkout_path') }}">Proceed to checkout</a>
              </td>
              <td></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align:center">
              <a type="button" class="btn" style="width:100px; font-family:MontserratLight; color:white;
              background-color:#333333;" href="{{ route('destroy_cart_path') }}">Clear All</a>
            </td>
            <td></td>
          </tr>


  </tbody>
 </table>
 <input type="hidden" id="refreshed" value="no">
</div>
</div>


<script type="text/javascript">
  
var cartList=<?=json_encode($cartList)?>;

  onload=function(){
    var e=document.getElementById("refreshed");
      if(e.value=="no")e.value="yes";
      else
        {
          e.value="no";location.reload();
        }
    }


  function add_one_item(product_id)
  {
    //var product_id = $("#add").attr( "productId" );
    window.location = 'shopping-cart-'+product_id;
  }


  function remove_one_item(product_id)
  { 
    //var product_id = $("#add").attr( "productId" );
    window.location = 'remove-shopping-cart-'+product_id;
  }

  //console.log(cartList);

  
  function checkSoldOutProducts()
  {
    var response = true;

    jQuery(cartList).each(function(i, item){

      if(item.sold_out == 1)
      {  
        alert('The following product: "'+item.name+' - '+item.id+'" is sold out. Please remove it from your cart in order to proceed');
        response = false;
      }
    });

    return response;

    //  console.log(item.id, item.name, item.sold_out)
  }


</script>
<script type='text/javascript' src='js/header_margin.js'></script>



@stop


