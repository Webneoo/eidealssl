@extends('layouts.email_template')

@section('content')

	<h1> Dear {{ $firstname }},  </h1>
 
       Thank you for purchasing the following products:<br/>
       <b> Your order id is {{$order_id}} </b>
      
       <br/>

       <hr/>
       <h3>Purchased products</h3>
        <table>

        	<tr>  
              <td style="text-align:left; padding-left:15px;"><p><b>Product Code</b> </p></td>
              <td style="text-align:left; padding-left:15px;"><p><b>Product_title </b> </p></td>
              <td style="text-align:left; padding-left:15px;"><p><b>Price </b> </p></td>
              <td style="text-align:left; padding-left:15px;"><p><b>Quantity </b> </p></td>
              <td style="text-align:left; padding-left:15px;"><p><b>Total </b> </p></td>
            </tr>

            <?php 

            	foreach($cartList as $c)
                {     
            ?>
        		<tr>  
	              <td style="text-align:left; padding-left:15px;"><p> {{ $c->id }} </p></td>
	              <td style="text-align:left; padding-left:15px;"><p> {{ $c->name }} </p></td>
	              <td style="text-align:left; padding-left:15px;"><p> {{ $c->price }} USD </p></td>
	              <td style="text-align:left; padding-left:15px;"><p> {{ $c->qty }} </p></td>
                <td style="text-align:left; padding-left:15px;"><p> {{ ($c->qty)*($c->price) }} </p></td>
	         </tr>	

  			<?php
                }

                if($promo_price != NULL)
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
                <td style="text-align:left; padding-left:15px;"><p> <b>Overall Total Amount</b></p></td>
                <td style="text-align:left; padding-left:15px;"><p><b>{{ $total_amount }} $</b></p></td>
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
        <hr/>
         <br/>
        EIDEAL will contact you shortly for more info about the shipping address and the payment method.
          <br/><br/>                  
      
        
  Thank you,


@stop