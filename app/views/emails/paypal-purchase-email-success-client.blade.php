@extends('layouts.email_template')

@section('content')

<?php $actual_date = Carbon::now('Asia/Beirut'); ?>

  <div style="font-style:italic">

     Dear {{ $firstname }},  <br/><br/>
 
     Thank you for your interest and recent purchase from eideal.com:<br/><br/>
     This e-mail confirms that we have received your inquiry<br/><br/>
     <b> Your order ID is {{$order_id}} </b>
      
       <br/>

       <hr/>
       <h3>Purchased products</h3>
        <table>

        	<tr>  
            <td style="text-align:left; padding-left:15px;"><p><b>Product Code:</b> </p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Product_title</b> </p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Price </b></p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Quantity </b></p></td>
            <td style="text-align:left; padding-left:15px;"><p><b>Total </b> </p></td>
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
	              <td style="text-align:left; padding-left:15px;"><p> {{ $c->price }} </p></td>
	              <td style="text-align:left; padding-left:15px;"><p> {{ $c->qty }} </p></td>
                <td style="text-align:left; padding-left:15px;"><p> {{ ($c->qty)*($c->price) }} </p></td>
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
                <td style="text-align:left; padding-left:15px;"><p>{{ $original_price }} $</p></td>
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
                <td style="text-align:left; padding-left:15px;"><p><b>{{ $amount }} $</b></p></td>
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
                   <td style="text-align:left; padding-left:15px;"><p>$ {{ $amount }} </p></td>
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
        </hr>
        <br/>

 One of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status.<br/><br/>

       Should you have any questions, please feel free to contact our Customer Care team on info@eideal.com or +97142594665 who will be happy to help.
      <br/><br/>                  
      
      Best wishes,<br/><br/>
        
      The EIDEAL Team

</div>


@stop