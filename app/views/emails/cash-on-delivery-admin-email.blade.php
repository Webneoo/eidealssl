@extends('layouts.email_template')

@section('content')

<?php $actual_date = Carbon::now('Asia/Beirut'); ?>

	<h1> Dear Admin,  </h1>
 
       The following user has purchased the following products using the payment method: <b>"Cash on delivery"</b>:<br/>
       <b> Order id is {{$order_id}} </b>
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

                <?php
                  // check if the product has a product promo
                  if( ($c->promo_start_date != NULL && $c->promo_end_date != NULL) && ($actual_date >= $c->promo_start_date && $actual_date <= $c->promo_end_date) )
                  {
                      // affect the promo price to the product
                      $c->price = $c->price*(100-$c->percentage)/100;
                  }
                ?>

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
        Please contact the user and check the shopping section in the CMS for more info about the shipping address and the payment method.
          <br/><br/>                  
      
        
  Thank you,


@stop