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
            
        	<table style="margin:auto;">
                <tr>
                    <td colspan="2"><HR /></td>
                </tr>

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
                   <td style="text-align:right;"><p><b>Transaction response message:</b></p> </td>
                   <td style="text-align:left; padding-left:15px;"><p>{{ $paypal_message }}</p></td>
                </tr>

            </table>
            <br/>
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