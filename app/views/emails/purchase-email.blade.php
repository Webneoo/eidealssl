@extends('layouts.email_template')

@section('content')

	<h1> Dear {{ $firstname }},  </h1>
 
       Thank you for purchasing the following products:<br/>
      
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
        
  Thank you,


@stop