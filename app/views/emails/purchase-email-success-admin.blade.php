@extends('layouts.email_template')

@section('content')

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
            <td style="text-align:left; padding-left:15px;"><p><b> Price </b></p></td>
            <td style="text-align:left; padding-left:15px;"><p><b> Quantity </b></p></td>
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
       <hr/>

       <h3>Payment Details</h3>


       <table>
      
        		<tr>  
                  <td style="text-align:right;"><p><b>Transaction Date:</b> </p></td>
                  <td style="text-align:left; padding-left:15px;"><p> {{ $trans_date }} </p></td>
                </tr>  
                
               	<tr>
                   <td style="text-align:right;"><p><b>Order Reference:</b></p></td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $orderInfo }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Order ID:</b></p></td>
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
        <hr/>
        <br/>
  For more information, check the shopping section in the CMS.<br/>      
  Thank you,


@stop