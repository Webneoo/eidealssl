@extends('layouts.default')

@section('content')

<div id="start" class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';"><br/>
			<h3>Payment Details</h3>
			<hr style="border-top:2px solid #dfdfdf;"> </hr>
		</div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 my_Account_details">
            
        <?php  
          if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" || $errorExists == true) 
              {

                echo $errorTxt;
                echo "<br/><br/>";
                echo $hashValidated;
              }

          else
           {

        ?>

        	<table style="margin:auto;">
                <tr>
                    <td colspan="2"><HR /></td>
                </tr>

        		    <tr>  
                  <td style="text-align:right;"><p><b>Transaction Date:</b> </p></td>
                  <td style="text-align:left; padding-left:15px;"><p> {{ $trans_date }} </p></td>
                </tr>  
              
               	<tr>
                   <td style="text-align:right;"><p><b>Order Reference:</b></p></td>
                   <td style="text-align:left; padding-left:15px;">
                    <p>
                      @if($orderInfo != "No Value Returned")
                        {{ $orderInfo }}
                      @endif
                    </p>
                  </td>
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
                   <td style="text-align:left; padding-left:15px;">
                    <p>
                      @if($message != "No Value Returned")
                        {{ $message }}
                      @endif
                    </p>
                  </td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b>Transaction response:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $txnResponseCodeDesc }}</p></td>
                </tr>

                <tr>
                   <td style="text-align:right;"><p><b> Issuer Response:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;">
                    <p>
                      @if($issuerResponseCodeDesc != "No Value Returned")
                        {{ $issuerResponseCodeDesc }}
                      @endif
                    </p>
                  </td>
                </tr>

               
                <?php
                  // only display the following fields if not an error condition
                  if ($txnResponseCode != "7" && $txnResponseCode != "No Value Returned") 
                  { 
                ?>
                  <tr>
                       <td style="text-align:right;"><p><b>Receipt Number:</b></p> </td>
                       <td style="text-align:left; padding-left:15px;">
                        <p>
                          @if($receiptNo != "No Value Returned")
                            {{ $receiptNo }}
                          @endif
                        </p>
                      </td>
                  </tr>
                  
                  <tr>
                      <td align="right"><b>Card Type: </b></td>
                      <td style="text-align:left; padding-left:15px;">
                        <p>
                          @if($cardType != "No Value Returned")
                            {{ $cardType }}
                          @endif
                        </p>
                      </td>
                  </tr> 
                  <tr>
                      <td colspan="2"><HR /></td>
                  </tr>
                <?php 
                 } 
                ?>    

            </table>

        <?php 

          }

         ?>
           
        </div>
    </div>

    <div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';">
			<button onclick="printPage()" class="button_account">PRINT</button>
		</div>
    </div>

</div>


<script>
function printPage() {

   w=window.open();
   w.document.write($('.my_Account_details').html());
   w.print();
   w.close();
}

</script>
<script type='text/javascript' src='js/header_margin.js'></script>

@stop