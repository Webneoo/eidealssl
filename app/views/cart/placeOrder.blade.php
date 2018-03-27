@extends('layouts.default')

@section('content')

 <div id="start" class="container">
 <br/>

 <div class="container">
    
       <div class="row">
          
          <div class="col-lg-12 col-md-12" style="padding-right:30px; margin: auto;">
             <div class="application_form">

               <h1 class="contact_info_title" style="padding-left:15px;"> PERSONAL INFORMATION </h1>
               
                 {{ Form::open(['route' => 'cash_on_delivery_path', 'role' => 'form', 'id'=> 'checkout_form']) }}
                
                    <table class="careers_table">
                      <tr>
                        <td> Name: </td>
                        <td> <b> {{ Session::get('checkout_firstname'); }}  {{ Session::get('checkout_lastname'); }} </b></td>
                      </tr>

                       <tr>
                        <td> Email: </td>
                        <td> <b> {{ Session::get('checkout_email'); }} </b> </td>
                      </tr>

                       <tr>
                        <td> Phone: </td>
                        <td> <b> {{ Session::get('checkout_phone'); }} </b></td>
                      </tr>

                    </table>
                   

                 <h1 class="contact_info_title" style="padding-left:15px;"> DELIVERY INFORMATION </h1>

                    <table class="careers_table">
                        
                      <tr>
                        <td> Country: </td>
                        <td> <b> {{ Session::get('checkout_country'); }} </b></td>
                      </tr>

                      <tr>
                        <td> City: </td>
                        <td> <b> {{ Session::get('checkout_city'); }}  </b></td>
                      </tr>

                      <tr>
                        <td> Address: </td>
                        <td> <b> {{ Session::get('checkout_address'); }} </b></td>
                      </tr>

                    </table>

                    

                 <h1 class="contact_info_title" style="padding-left:15px;"> PAYMENT INFORMATION </h1>

                 <table class="careers_table">
                      <tr>
                        <td> Payment Method: </td>
                        <td>  
                            @if(Session::get('checkout_payment') == 1)
                                <b> Cash on delivery </b>  
                                @elseif(Session::get('checkout_payment') == 0)
                                <b> Online payment </b> 
                                @elseif(Session::get('checkout_payment') == 2)
                                <b> PayPal </b> 
                            @endif
                        </td>
                      </tr>

                  </table>


                   <h1 class="contact_info_title" style="padding-left:15px;"> CART INFORMATION </h1>

                    <table class="table table-striped">
                  <thead>
                      <tr>
                          <th style="padding-left:40px;">Product</th>
                          <th style="text-align:center">Quantity</th>
                          <th style="text-align:center">Unit Price ({{ $quoteCurr }})</th>
                          <th style="text-align:center">Total</th>
                      </tr>
                  </thead>

                  <tbody>
                        <?php $price = 0; ?>
                        @foreach($cartList as $c)

                        <?php
                          $actual_date = Carbon::now('Asia/Beirut');
                          // check if the product has a product promo
                          if( ($c->promo_start_date != NULL && $c->promo_end_date != NULL) && ($actual_date >= $c->promo_start_date && $actual_date <= $c->promo_end_date) )
                          {
                              // affect the promo price to the product
                              $c->price = $c->price*(100-$c->percentage)/100;
                          }
                        ?>
                            <tr>
                                <td style="padding-left:40px;"><p class="item_name_cart">{{ $c->name }} - {{ $c->id }} </p></td>
                                <td style="text-align:center;"><div class="cart_item_value">{{ $c->qty }}</div></td>
                                <td style="text-align:center"><div class="cart_item_value">{{ number_format((float)$c->price*$curr, 2, '.', '')  }}</div></td>
                                <td style="text-align:center"><div class="cart_item_value">{{ number_format((float)($c->price*$c->qty*$curr), 2, '.', '')  }}</div></td>
                            </tr>
                        @endforeach
                              <tr>
                                  <td style="padding-left:40px; font-family:MontserratLight; font-size:23px;"><b>Subtotal</b></td>
                                  <td></td>
                                  <td></td>
                                  <td style="text-align:center; font-family:MontserratLight; font-size:23px;"><b>{{ number_format((float)$subtotal*$curr, 2, '.', ' ') }} ({{ $quoteCurr }})</b></td>
                                  <td></td>
                              </tr>
                        @if(isset($promo_valid) && !empty($promo_valid))
                              <tr>
                                  <td style="color: #337ab7; padding-left:40px; font-family:MontserratLight; font-size:20px;"><b>Promotion Discount</b></td>
                                  <td></td>
                                  <td></td>
                                  <td style="color: #337ab7; text-align:center; font-family:MontserratLight; font-size:20px;"><b> {{ $promo_valid[0]->percentage }} %</b></td>
                                  <td></td>
                              </tr>

                              <tr>
                                  <td style="padding-left:40px; font-family:MontserratLight; font-size:23px;"><b>Subtotal after discount</b></td>
                                  <td></td>
                                  <td></td>
                                  <td style="text-align:center; font-family:MontserratLight; font-size:23px;">
                                  <?php $subtotal = (float)$subtotal_after_discount; ?>
                                   <b> {{ number_format($subtotal*$curr, 2, '.', ' ') }} ( {{ $quoteCurr }})</b>
                                  </td>
                                  <td></td>
                              </tr>
                        @endif 
                               <tr>
                                  <td style="padding-left:40px; font-family:MontserratLight; font-size:20px;"><b>VAT</b></td>
                                  <td></td>
                                  <td></td>
                                  <td style="text-align:center; font-family:MontserratLight; font-size:20px;"><b>{{ Config::get('global.VAT') }}%</b></td>
                                  <td></td>
                              </tr> 
                              <!-- total amount after applying VAT -->
                              <?php $total_amount =  number_format(($subtotal + ($subtotal*Config::get('global.VAT')/100)), 2); ?>
                              <tr>
                                  <td style="padding-left:40px; font-family:MontserratLight; font-size:25px;"><b>Total</b></td>
                                  <td></td>
                                  <td></td>
                                  <td style="text-align:center; font-family:MontserratLight; font-size:25px;"><b>{{ number_format($total_amount*$curr, 2, '.', ' ') }} ({{ $quoteCurr }})</b></td>
                                  <td></td>
                              </tr>

                  </tbody>

                 </table>

                 <table class="careers_table">
                      <tr>

                        @if(Session::get('checkout_country') != 'United Arab Emirates' && Session::get('checkout_payment') == 0)
                            <td> <div class="alert alert-danger" style="text-align:center;">For temporary shipment reasons, you can only pay online for a shipping address inside the UAE </div> </td>
                        @elseif(Session::get('checkout_country') != 'United Arab Emirates' && Session::get('checkout_payment') == 1)
                            <td> <div class="alert alert-danger" style="text-align:center;"> You can only use the payment method "Cash on delivery" inside the UAE </div></td>
                        @elseif(Session::get('checkout_country') != 'United Arab Emirates' && Session::get('checkout_payment') == 2)
                            <td> <div class="alert alert-danger" style="text-align:center;"> You can only use the payment method "Cash on delivery" inside the UAE </div></td>
                        @else
                              <td></td>
                              <td class="pull-right">
                                 @if(Session::get('checkout_payment') == 1)
                                    <input type="submit" class="btn" style="width:140px; font-family:MontserratLight; color:white;
                                     background-color:#5d8c7a;" value="Place your order" name="checkout"/> 
                                    @elseif(Session::get('checkout_payment') == 0)
                                    <a class="btn" style="width:140px; font-family:MontserratLight; color:white;
                                     background-color:#5d8c7a;" href="{{ route('buy_result_path') }}">Place your order</a>  
                                @endif  
                              </td>
                        @endif
                      </tr>

                 </table>

              {{ Form::close() }}
             <br/>

             @if(!empty($active_promo))
                <div style="text-align:left; padding-left:20px; width:60%; margin-top:-55px; margin-bottom:30px;">
                   <form method="POST" action="apply-promo-code" accept-charset="UTF-8" role="form">
                      <b>Promo Code</b><input style="margin-left:5px;" type="text" name="promo_code" 
                      value="<?php if(isset($_POST['promo_code'])) echo $_POST['promo_code']; ?>"/>
                      <button type="submit" class="btn btn-primary" id="apply_promo"> Apply </button>
                    </form>
                    <div <?php if($flag == 1) echo "style='display:none' "; ?>class="error_message" style="width:200px;"> @include('flash::message')</div>
                </div>
              @endif


              @if(Session::get('checkout_payment') == 2)

                 <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <!-- Identify your business so that you can collect the payments. -->
                      <input type="hidden" name="business" value="ecommerce@eideal.com">

                      <!-- Specify a cart button. -->
                      <input type="hidden" name="cmd" value="_cart">
                      <input type="hidden" name="upload" value="1">
                      <!-- identiy token from eideal paypal -> profile -> My selling tools -> website payment preferences -->
                      <input type="hidden" name="at" value="0HLXE_fFm450ZXyP3kcPxJOsWyRKR58XGpleIBOJJBKWSCYtX1ygWqN11Oq">
                      <input type="hidden" name="return" value="https://eideal.com/paypal-response">
                   
                      <input type="hidden" name="currency_code" value="USD"> 

                        
                      <!-- Specify details about the item that buyers will purchase. -->
                      <input type="hidden" name="item_name_1" value="Eideal Shopping">
                      @if(Session::has('total_after_discount'))
                      <?php $t = Session::get('total_after_discount'); ?>
                      
                      <input type="hidden" name="amount_1" value="{{ number_format((float)$t, 2, '.', '') }}">
                      @else
                      <input type="hidden" name="amount_1" value="{{ number_format((float)$total_amount, 2, '.', '') }}">
                      @endif
                      
                      
                      <input type="hidden" name="quantity_1" value="1">
                 
                      
                      <!-- Display the payment button. -->
                      <input type="submit" class="btn paypal_placeorder" style="width:140px; font-family:MontserratLight; color:white;
                             background-color:#5d8c7a;" value="Place your order" name="checkout"/> 
                  </form>
              @endif






             </div> <!-- end application_form -->
            <br/>

          </div> <!-- end col-6 -->
       </div> 


    </div> <!-- end container -->

</div>

<script type='text/javascript' src='js/header_margin.js'></script>
<script type="text/javascript">
  
$('#apply_promo').click(function(){
     $(this).closest('form');
});

</script>


@stop
