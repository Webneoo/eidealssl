@extends('layouts.email_template')

@section('content')

<?php $actual_date = Carbon::now('Asia/Beirut'); ?>

	<h1> Dear Admin,  </h1>
 
       The following user has purchased the following products:<br/>
      
       <br/>
        <hr/> 

        <h3>Shipping info</h3>
        <table>

            <tr>  
              <td style="text-align:left; padding-left:15px;"><p><b>Name:</b> </p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $firstname }} {{ $lastname }} </p></td>
            </tr>

            <tr>
              <td style="text-align:left; padding-left:15px;"><p><b> Email </b></p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $email_address }} </p></td>
            </tr>

            <tr>
              <td style="text-align:left; padding-left:15px;"><p><b> Phone </b></p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $phone }} </p></td>
            </tr>

            <tr>
              <td style="text-align:left; padding-left:15px;"><p><b> Country </b></p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $country }} </p></td>
            </tr>

            <tr>
              <td style="text-align:left; padding-left:15px;"><p><b> City </b></p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $city }} </p></td>
            </tr>

            <tr>
              <td style="text-align:left; padding-left:15px;"><p><b> Shipping address </b></p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $shipping_address }} </p></td>
            </tr>

        </table>
        <br/>


       <hr/>
       <h3>Purchased products</h3>
        <table>

        	<tr>  
            <td style="text-align:left; padding-left:15px;"><p><b>Product Code:</b> </p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Product_title</b> </p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Price ({{ $quoteCurr }})</b></p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Quantity </b></p></td>
            <td style="text-align:left; padding-left:15px;"><p><b>Total ({{ $quoteCurr }})</b> </p></td>
          </tr>

            <?php 

            	foreach($cartList as $c)
                {   

                 // check if the product has a product promo
                  if( ($c->promo_start_date != NULL && $c->promo_end_date != NULL) && ($actual_date >= $c->promo_start_date && $actual_date <= $c->promo_end_date) )
                  {
                      // affect the promo price to the product
                      $c->price = $c->price*(100-$c->percentage)/100;
                  }

            ?>
        		<tr>  
              <td style="text-align:left; padding-left:15px;"><p> {{ $c->id }} </p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $c->name }} </p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ number_format((float)$c->price*$curr, 2, '.', '') }}</p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ $c->qty }} </p></td>
              <td style="text-align:left; padding-left:15px;"><p> {{ number_format((float)($c->qty)*($c->price)*($curr), 2, '.', '') }} {{ ($c->qty)*($c->price) }} </p></td>
            </tr>	

  			     <?php
                }
            
                if($promo_percentage != NULL)
                {
             ?>

             <tr>  
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
             </tr> 

             <tr>  
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p> <b>Original price </b></p></td>
                <td style="text-align:left; padding-left:15px;"><p>{{ number_format((float)$original_price*$curr, 2, '.', '') }}</p></td>
             </tr> 

             <tr>  
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p> <b>Promo discount</b></p></td>
                <td style="text-align:left; padding-left:15px;"><p>{{ $promo_percentage }}% </p></td>
             </tr> 

             <?php 
                }
              ?>

              <tr>  
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p> <b>VAT</b></p></td>
                <td style="text-align:left; padding-left:15px;"><p><b>{{ Config::get('global.VAT') }}%</b></p></td>
             </tr> 
              
              <tr>  
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p></p></td>
                <td style="text-align:left; padding-left:15px;"><p> <b>Overall Total Amount</b></p></td>
                <td style="text-align:left; padding-left:15px;"><p><b>{{ number_format((float)$amount*$curr, 2, '.', '') }} </b></p></td>
             </tr> 

        </table>

        <br/>              
       <hr/>

       <h3>Payment Details</h3>


       <table>
      
        		<tr>  
                  <td style="text-align:right;"><p><b>Transaction Date:</b> </p></td>
                  <td style="text-align:left; padding-left:15px;"><p> {{ $trans_date }} </p></td>
                </tr>  
                
                <tr>  
                  <td style="text-align:right;"><p><b>Payment Method:</b> </p></td>
                  <td style="text-align:left; padding-left:15px;"><p> PayPal </p></td>
                </tr> 
              
                <tr>
                   <td style="text-align:right;"><p><b>Paypal transaction ID:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"> <p> {{ $paypal_transaction_id }} </p> </td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Order ID:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $order_id }}</p></td>
                </tr>
                
                <tr>
                   <td style="text-align:right;"><p><b>Purchase Amount:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ number_format((float)$amount*$curr, 2, '.', '') }} </p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Status:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p> Pending </p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Transaction response message:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $paypal_message }}</p></td>
                </tr>
        </table>
        <hr/>
        <br/>
  For more information, check the shopping section in the CMS.<br/>      
  Thank you,


@stop