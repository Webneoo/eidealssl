@extends('layouts.email_template')

@section('content')

<?php $actual_date = Carbon::now('Asia/Beirut'); ?>

	<div style="font-style:italic">

     Dear {{ $firstname }},  <br/><br/>
 
     Thank you for your interest and recent purchase from eideal.com:<br/><br/>
     This e-mail confirms that we have received your inquiry<br/><br/>
      
       <br/>

       <hr/>
       <h3>Purchased products</h3>
        <table style="margin:auto;">

        	<tr>  
              <td style="text-align:left; padding-left:15px;"><p><b>Product Code:</b> </p></td>
              <td style="text-align:left; padding-left:15px;"><p> Product_title </p></td>
              <td style="text-align:left; padding-left:15px;"><p> Price </p></td>
              <td style="text-align:left; padding-left:15px;"><p> Quantity </p></td>
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
	            </tr>	

  			<?php
                }
             ?>

        </table>

        <br/>

         Please find below your payment details: <br/><br/>                  
       <hr/>

       <h3>Payment Details</h3>


       <table style="margin:auto;">
      
        		<tr>  
                  <td style="text-align:right;"><p><b>Transaction Date:</b> </p></td>
                  <td style="text-align:left; padding-left:15px;"><p> {{ $trans_date }} </p></td>
                </tr>  
                
               	<tr>
                   <td style="text-align:right;"><p><b>Order Reference:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $orderInfo }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Transaction Number:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $transactionNo }}</p></td>
                </tr>
                
               	<tr>
                   <td style="text-align:right;"><p><b>Purchase Amount:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>$ {{ $amount }} </p></td>
                </tr>

               	<tr>
                   <td style="text-align:right;"><p><b>Transaction status:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $txn_message }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Transaction response:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $txnResponseCodeDesc }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b> Issuer Response:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $issuerResponseCodeDesc }}</p></td>
                </tr>

               


                <?php
                  // only display the following fields if not an error condition
                  if ($txnResponseCode != "7" && $txnResponseCode != "No Value Returned") 
                  { 
                ?>
                  <tr>
                       <td style="text-align:right;"><p><b>Receipt Number:</b></p> </td>
                       <td style="text-align:left; padding-left:15px;"><p>{{ $receiptNo }}</p></td>
                  </tr>
                  
                  <tr>
                      <td align="right"><b>Card Type: </b></td>
                      <td style="text-align:left; padding-left:15px;"><p> {{ $cardType }}</td>
                  </tr> 
                
                <?php 
                 } 
                ?>    
        </table>
        <br/>
        <hr/>
        
One of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status.<br/><br/>

       Should you have any questions, please feel free to contact our Customer Care team on info@eideal.com or +97142594665 who will be happy to help.
      <br/><br/>                  
      
      Best wishes,<br/><br/>
        
      The EIDEAL Team

</div>


@stop