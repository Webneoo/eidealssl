@extends('cms.layouts.default')

@section('content')

   
        <h1> Transaction #4</h1>
    

    
          <table class="table table-striped table-bordered table-hover" id="dataTables-example">
           <tbody>
                <tr>
                    <td colspan="2" style="text-align:center; font-size:17px; background:#337ab7; color:white"><b>Client Info</b></td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>First name</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->firstname }}</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>Last name</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->lastname }}</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>E-mail</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->email }}</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>Phone</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->phone }}</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>Country</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->country }}</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>City</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->city }}</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>Shipping Address</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->shipping_address }}</td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align:center; font-size:17px; background:#337ab7; color:white"><b>Purchased Products</b></td>
                </tr>
                
                <tr>
                    <td style="text-align:center;"><b>Products</b></td>
                    <td style="text-align:center;">
                      <table class="table table-hover">
                        <tr>
                          <td style="text-align:center;"><b>Product</b></td>
                          <td style="text-align:center;"><b>Image</b></td>
                          <td style="text-align:center;"><b>Quantity</b></td>
                          <td style="text-align:center;"><b>Price</b></td>
                          <td style="text-align:center;"><b>Total</b></td>
                        </tr>
                        @foreach($products as $p)
                        <tr>
                            <td style="text-align:center;"><b>{{ $p->title }} - {{ $p->code }}</b></td>
                            <td style="text-align:center;"><img style="width:100px;" src="images/products/<?php echo $p->img1; ?>"/></td>
                            <td style="text-align:center;">{{ $p->quantity }}</td>
                            <td style="text-align:center;">$ {{ $p->price }}</td>
                            <td style="text-align:center;">$ {{ ($p->price)*($p->quantity) }}</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;"><b>Total</b></td>
                            <td style="text-align:center;"><b>${{ $order_id_info[0]->purchase_price }}</b></td>
                        </tr>
                      </table>
                    </td>
                </tr>
                <!-- <tr>
                    <td style="text-align:center;"><b>Promo code</b></td>
                    <td style="text-align:center;">34636</td>
                </tr>
                <tr>
                    <td style="text-align:center;"><b>Shipping Fees</b></td>
                    <td style="text-align:center;">Free</td>
                </tr> -->

                <tr>
                    <td colspan="2" style="text-align:center; font-size:17px; background:#337ab7; color:white"><b>Payment Details</b></td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Payment Method</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->payment_method }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Purchased Amount</b></td>

                    <td style="text-align:center;">$ {{ $order_id_info[0]->purchase_price }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Transaction date</b></td>
                    <td style="text-align:center;">$ {{ $order_id_info[0]->purchase_date }}</td>
                </tr>

                @if($order_id_info[0]->order_status_id == 3 || $order_id_info[0]->order_status_id == 4)

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Order ID</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_order_id }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Order Reference</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_order_reference }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Transaction status</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_transaction_status }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Transaction Response</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_transaction_response }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Issuer Response</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_issuer_response }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Receipt Number</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_receipt_number }}</td>
                </tr>

                <tr>
                    <td style="text-align:center;"><b>Bank Audi Card Type</b></td>
                    <td style="text-align:center;">{{ $order_id_info[0]->audi_card_type }}</td>
                </tr>

                @endif
           </tbody>
          </table>
          <a href="{{ route('shopping_management_path') }}"><button type="button" class="btn btn-primary" style="float:right;">Back</button></a>
          
     
    
   
@stop