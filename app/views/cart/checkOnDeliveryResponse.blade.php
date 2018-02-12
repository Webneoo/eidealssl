@extends('layouts.default')

@section('content')

<div id="start" class="container">
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';"><br/>
			<h3>Successful Purchase</h3>
			<hr style="border-top:2px solid #dfdfdf;"> </hr>
		</div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 my_Account_details">
          <br/><br/>
            Thank you for purchasing from EIDEAL!<br/><br/>
            Your order ID is <b> {{ $order_id }} </b><br/><br/>

            You will shortly receive an email with your purchase details and we will contact you very soon for more delivery information.
            <br/><br/><br/><br/>
          
        </div>
    </div>

    <div class="row">
  		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3" style="text-align:center;font-family:'MontserratRegular';">
  			 <a type="button" class="btn" style="width:160px; font-family:MontserratLight; color:white;background-color:#676767;"
            href="{{ route('all_products_path') }}"> Continue shopping </a>
  		</div>
    </div>
    <br/><br/>

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