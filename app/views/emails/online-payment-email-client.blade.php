<?php $actual_date = Carbon::now('Asia/Beirut'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Eideal | Billing invoices and receipts</title>

<style type="text/css">
  
  /* -------------------------------------
      GLOBAL
      A very basic CSS reset
  ------------------------------------- */
  * {
    margin: 0;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    box-sizing: border-box;
    font-size: 14px;
  }

  img {
    max-width: 100%;
  }

  body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6em;
    /* 1.6em * 14px = 22.4px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
    /*line-height: 22px;*/
  }

  /* Let's make sure all tables have defaults */
  table td {
    vertical-align: top;
  }

  /* -------------------------------------
      BODY & CONTAINER
  ------------------------------------- */
  body {
    background-color: #f6f6f6;
  }

  .body-wrap {
    background-color: #f6f6f6;
    width: 100%;
  }

  .container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
  }

  .content {
    max-width: 600px;
    margin: 0 auto;
    display: block;
    padding: 20px;
  }

  /* -------------------------------------
      HEADER, FOOTER, MAIN
  ------------------------------------- */
  .main {
    background-color: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
  }

  .content-wrap {
    padding: 20px;
  }

  .content-block {
    padding: 0 0 20px;
  }

  .header {
    width: 100%;
    margin-bottom: 20px;
  }

  .footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
  }
  .footer p, .footer a, .footer td {
    color: #999;
    font-size: 12px;
  }

  /* -------------------------------------
      TYPOGRAPHY
  ------------------------------------- */
  h1, h2, h3 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2em;
    font-weight: 400;
  }

  h1 {
    font-size: 32px;
    font-weight: 500;
    /* 1.2em * 32px = 38.4px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
    /*line-height: 38px;*/
  }

  h2 {
    font-size: 24px;
    /* 1.2em * 24px = 28.8px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
    /*line-height: 29px;*/
  }

  h3 {
    font-size: 18px;
    /* 1.2em * 18px = 21.6px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
    /*line-height: 22px;*/
  }

  h4 {
    font-size: 14px;
    font-weight: 600;
  }

  p, ul, ol {
    margin-bottom: 10px;
    font-weight: normal;
  }
  p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
  }

  /* -------------------------------------
      LINKS & BUTTONS
  ------------------------------------- */
  a {
    color: #348eda;
    text-decoration: underline;
  }

  .btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #348eda;
    border: solid #348eda;
    border-width: 10px 20px;
    line-height: 2em;
    /* 2em * 14px = 28px, use px to get airier line-height also in Thunderbird, and Yahoo!, Outlook.com, AOL webmail clients */
    /*line-height: 28px;*/
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
  }

  /* -------------------------------------
      OTHER STYLES THAT MIGHT BE USEFUL
  ------------------------------------- */
  .last {
    margin-bottom: 0;
  }

  .first {
    margin-top: 0;
  }

  .aligncenter {
    text-align: center;
  }

  .alignright {
    text-align: right;
  }

  .alignleft {
    text-align: left;
  }

  .clear {
    clear: both;
  }

  /* -------------------------------------
      ALERTS
      Change the class depending on warning email, good email or bad email
  ------------------------------------- */
  .alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
  }
  .alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
  }
  .alert.alert-warning {
    background-color: #FF9F00;
  }
  .alert.alert-bad {
    background-color: #D0021B;
  }
  .alert.alert-good {
    background-color: #68B90F;
  }

  /* -------------------------------------
      INVOICE
      Styles for the billing table
  ------------------------------------- */
  .invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
  }
  .invoice td {
    padding: 5px 0;
  }
  .invoice .invoice-items {
    width: 100%;
  }
  .invoice .invoice-items td {
    border-top: #eee 1px solid;
  }
  .invoice .invoice-items .total td {
    border-top: 2px solid #333;
    font-weight: 700;
  }

  .resp_table
  {
    padding-left:55px;
  }

  /* -------------------------------------
      RESPONSIVE AND MOBILE FRIENDLY STYLES
  ------------------------------------- */
  @media only screen and (max-width: 640px) {
    body {
      padding: 0 !important;
    }

    h1, h2, h3, h4 {
      font-weight: 800 !important;
      margin: 20px 0 5px !important;
    }

    h1 {
      font-size: 22px !important;
    }

    h2 {
      font-size: 18px !important;
    }

    h3 {
      font-size: 16px !important;
    }

    .container {
      padding: 0 !important;
      width: 100% !important;
    }

    .content {
      padding: 0 !important;
    }

    .content-wrap {
      padding: 10px !important;
    }

    .invoice {
      width: 100% !important;
    }

    .resp_table
    {
      padding-left:0px;
    }
  }

  /*# sourceMappingURL=styles.css.map */

</style>

</head>

<body itemscope itemtype="http://schema.org/EmailMessage">

<table class="body-wrap">
  <tr>
    <td></td>
    <td class="container" width="600">
      <div class="content">
        <table class="main" width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td class="content-wrap aligncenter">
              <table width="100%" cellpadding="0" cellspacing="0">
                
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <tr align="center"><img style="width:150px; margin-bottom:20px; margin-top:30px;" src="https://eideal.com/images/eideal_logo_black.png"></tr>
                  <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding-left:55px; text-align:left;" valign="top">
                    Dear {{$firstname}},
                  </td>
                </tr>
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding-left:55px; text-align:left;" valign="top">
                    Thank you for your purchase from <a href="https://eideal.com">www.eideal.com</a>. 
                  </td>
                </tr>

                @if($success_flag == 0)
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding-left:55px; text-align:left;" valign="top">
                    It seems that something went wrong and your transaction was declined.
                  </td>
                </tr>
                @endif


                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding-left:55px; text-align:left;" valign="top">
                    Please find below your detailed order:
                  </td>
                </tr>
                <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                  <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding-left:55px; text-align:left;" valign="top">
                    Order#: {{$order_id}} placed on {{$purchase_date}} at {{$purchase_time}}
                  </td>
                </tr>


                <tr>
                  <td class="content-block aligncenter">
                    <table class="invoice" style="margin-bottom:10px;">
                     
                      <tr>
                        <td>
                          <table class="invoice-items" cellpadding="0" cellspacing="0">
                            <tr>
                              <th style="width:42%">Product</th>
                              <th style="width:18%; text-align:center;">Price ({{ $quoteCurr }})</th>
                              <th style="width:10%; text-align:center;">Qty</th>
                              <th class="alignright" style="width:20%">Total ({{ $quoteCurr }})</th>
                            </tr>
                            @foreach($cartList as $c)
                            <tr>  
                              <?php
                                // check if the product has a product promo
                                if( ($c->promo_start_date != NULL && $c->promo_end_date != NULL) && ($actual_date >= $c->promo_start_date && $actual_date <= $c->promo_end_date) )
                                {
                                    // affect the promo price to the product
                                    $c->price = $c->price*(100-$c->percentage)/100;
                                }
                              ?>

                              <td>{{ $c->name }}</td>
                              <td style="text-align:center;">{{ number_format((float)$c->price*$curr, 2, '.', '') }}</td>
                              <td style="text-align:center;">{{ $c->qty }}</td>
                              <td class="alignright">{{ number_format((float)(($c->qty)*($c->price)*($curr)), 2, '.', '') }}</td>
                            </tr>
                            @endforeach

                            <?php

                              if($promo_price != NULL)
                              {
                            ?>
                              <tr class="total">
                                <td></td>
                                <td></td>
                                <td class="alignright">Subtotal</td>
                                <td class="alignright">{{ number_format((float)$original_price*$curr, 2, '.', '') }}</td>
                              </tr>

                              <tr class="total">
                                <td></td>
                                <td></td>
                                <td class="alignright">Discount</td>
                                <td class="alignright">{{ $promo_percentage }}%</td>
                              </tr>
                            <?php 
                              }
                            ?>

                              <tr class="total">
                                <td></td>
                                <td></td>
                                <td class="alignright">VAT</td>
                                <td class="alignright">{{ Config::get('global.VAT') }}%</td>
                              </tr>

                              <tr class="total">
                                <td></td>
                                <td></td>
                                <td class="alignright">TOTAL</td>
                                <td class="alignright">{{ number_format((float)$total_amount*$curr, 2, '.', '') }}</td>
                              </tr>

                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                  <table width="100%" cellpadding="0" cellspacing="0" class="resp_table">
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        <b>Billing address</b>
                      </td>
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        <b>Delivery address</b>
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                       {{ Session::get('firstname') }} {{ Session::get('lastname') }}
                      </td>
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        {{$firstname}} {{$lastname}}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                       {{ Session::get('address') }}
                      </td>
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        {{$shipping_address}}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                       {{ Session::get('city') }}
                      </td>
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        {{$city}}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                       {{ Session::get('country') }}
                      </td>
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        {{$country}}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                       Mobile number: {{ Session::get('phone') }}
                      </td>
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left; width:50%; padding: 0 0 3px;" valign="top">
                        Mobile number: {{$phone}}
                      </td>
                    </tr>
                  </table>

                  <table width="100%" cellpadding="0" cellspacing="0" class="resp_table" style="margin-top:40px;">
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin-top: 30px;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;text-align:left; padding: 0 0 3px;" valign="top">
                        <b>Bank response</b>
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                        <u>Order Reference</u>: {{ $orderInfo }}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                       <u>Transaction #</u>: {{ $transactionNo }}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                       <u>Transaction status</u>: {{ $txn_message }}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                       <u>Transaction response</u>: {{ $txnResponseCodeDesc }}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                       <u>Issuer Response</u>: {{ $issuerResponseCodeDesc }}
                      </td>
                    </tr>

                   
                  <!-- only display the following fields if not an error condition -->
                  @if ($txnResponseCode != "7" && $txnResponseCode != "No Value Returned") 
                  
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                       <u>Transaction response</u>: {{ $txnResponseCodeDesc }}
                      </td>
                    </tr>
                    <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; margin: 0;">
                      <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 13px; vertical-align: top; margin: 0;text-align:left;padding: 0 0 3px;" valign="top">
                       <u>Issuer Response</u>: {{ $issuerResponseCodeDesc }}
                      </td>
                    </tr>

                  @endif

                  </table>
         

                <table width="100%" cellpadding="0" cellspacing="0" class="resp_table" style="margin-top:40px;"> 
                  <tr style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                    <td class="content-block" style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding-top:14px; text-align:left;" valign="top">
                      The EIDEAL team
                    </td>
                  </tr>
                </table>

              </table>
            </td>
          </tr>
        </table>
    </div>
    </td>
    <td></td>
  </tr>
</table>

</body>
</html>








