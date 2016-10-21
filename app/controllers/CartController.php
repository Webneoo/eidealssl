<?php

use eideal\Home\HomeRepository;
use eideal\Media\MediasRepository;
use eideal\Products\ProductsRepository;
use eideal\Promo\PromoRepository;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Gloudemans\Shoppingcart\Cart;
use eideal\Forms\CheckoutForm;
use Carbon\Carbon; 


class CartController extends \BaseController {
   
    private $cart;
    private $session;
    private $productsRepository;
    private $promoRepository;
    private $homeRepository;
    private $mediasRepository;
    private $checkoutForm;


    function __construct(Cart $cart, \Illuminate\Session\SessionManager $session, \Illuminate\Events\Dispatcher $event, ProductsRepository $productsRepository,
                         PromoRepository $promoRepository, HomeRepository $homeRepository, MediasRepository $mediasRepository, CheckoutForm $checkoutForm)
    {
        $this->cart = $cart;
        $this->session = $session;
        $this->productsRepository = $productsRepository;
        $this->promoRepository = $promoRepository;
        $this->homeRepository = $homeRepository;
        $this->mediasRepository = $mediasRepository;
        $this->checkoutForm = $checkoutForm;
    }

	public function index()
	{  
        $pagename = pageName();

        // if the user is online
        if(Auth::check())
        {   
            //check if the user already has a filled cart
            $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id'));  

            // count the number of the item in your cart from the database
                $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                $itemNb = $itemNb[0]->qty_in_cart;
        }

         // if the user is offline
        else
        {   
            $cartList = $this->cart->instance('shopping')->content();
            $itemNb = $this->cart->instance('shopping')->count();
        }


        Session::put('cart_item', $itemNb);

        return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
	}


    public function store($product_id)
    {   
        $pagename = pageName();
        $products = $this->productsRepository->getProductInfoFromId($product_id);

        $actual_date = Carbon::now('Asia/Beirut');
        // check if the product has a product promo
        if( ($products[0]->promo_start_date != NULL && $products[0]->promo_end_date != NULL) && ($actual_date >= $products[0]->promo_start_date && $actual_date <= $products[0]->promo_end_date) )
        {
            // affect the promo price to the product
            $products[0]->price = $products[0]->price*(100-$products[0]->percentage)/100;
        }

            // if the user is online
            if(Auth::check())
            {  
                //check if the user already has a filled cart
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id'));  
                if(empty($cartList)) // if the cart is empty => add a new order_id
                {   
                    // adding a new order id with the first product associated to the order_id
                    $this->productsRepository->insertOrderIdProduct($products[0]->product_id, Session::get('user_id'), 1);
                }
                else // if the cart is not empty and the user already have an order_id
                {   
                    $product_exist_flag = 0; // flag that determine if the product exist or no. 0 => doesn't exist, 1 => exist
                    foreach($cartList as $c)
                        {
                            if($c->product_id == $product_id) // if the product already exist in the cart
                            {  
                                $this->productsRepository->incrementQuantity($c->product_id, $c->order_id); //update it quantity
                                $product_exist_flag = 1; // set flag to 1 => product exist => updating the product
                            }      
                        }

                    if($product_exist_flag == 0) // if we didn't find the product in the cart => insert a new product same order id
                    {   
                        $this->productsRepository->insertProdcutInCart($product_id, $cartList[0]->order_id, 1);
                    }
                    
                }

                // get the cart that exist in the database
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

                // count the number of the item in your cart from the database
                $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                $itemNb = $itemNb[0]->qty_in_cart;
            }

            // if the user is offline
            else
            {   
                $options = array('size' => $products[0]->product_id);
                $this->cart->instance('shopping')->add($products[0]->code, $products[0]->title, 1, $products[0]->price, $options);

                $cartList = $this->cart->instance('shopping')->content();
                $itemNb = $this->cart->instance('shopping')->count();    
            }
        
            Session::put('cart_item', $itemNb);  


        return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
    }



    public function remove($product_id)
    {   
        $pagename = pageName();
        $products = $this->productsRepository->getProductInfoFromId($product_id);

         
            // if the user is online
            if(Auth::check())
            {   
                // get the order_id of the logged in user
                $order_id = $this->productsRepository->getOrderId(Session::get('user_id'));

                if(!empty($order_id))
                    // remove 1 item from the selected product
                    $this->productsRepository->decrementQuantity($product_id, $order_id[0]->order_id);

                // get the cart that exist in the database
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

                // count the number of the item in your cart from the database
                $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                $itemNb = $itemNb[0]->qty_in_cart; 
            }

             // if the user is offline
            else
            {
                $options = array('size' => $products[0]->product_id);
                $row_id_array = $this->cart->instance('shopping')->search(array('options' => array('size' => $products[0]->product_id)));
                $row_id =  $row_id_array[0];

                $cartList = $this->cart->instance('shopping')->content();

                $actual_quantity = $cartList[$row_id]['qty'];

                if($actual_quantity > 1)
                { 
                  $this->cart->instance('shopping')->update($row_id, array('qty' => $actual_quantity-1));
                  $cartList = $this->cart->instance('shopping')->content();
                }

                $itemNb = $this->cart->instance('shopping')->count();
            }

        
        Session::put('cart_item', $itemNb);

        return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
    }
    

    public function delete($product_id, $product_code)
    {   
    
        $pagename = pageName();


        // if the user is online
        if(Auth::check())
            { 
                // get the order_id of the logged in user
                $order_id = $this->productsRepository->getOrderId(Session::get('user_id'));

                if(!empty($order_id))
                    // remove 1 item from the selected product
                    $this->productsRepository->deleteProductFromcart($product_id, $order_id[0]->order_id);

                // get the cart that exist in the database
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

                // count the number of the item in your cart from the database
                $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                $itemNb = $itemNb[0]->qty_in_cart; 
            }

        // if the user is offline
        else
            {
                $rowId = $this->cart->instance('shopping')->search(array('id' => $product_code));
                $this->cart->instance('shopping')->remove($rowId[0]);
                $itemNb = $this->cart->instance('shopping')->count();
                $cartList = $this->cart->instance('shopping')->content();
            }

        Session::put('cart_item', $itemNb);


        return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
    }


    public function destroy()
    {
        $pagename = pageName();

        // if the user is online
        if(Auth::check())
            { 
                // get the order_id of the logged in user
                $order_id = $this->productsRepository->getOrderId(Session::get('user_id'));

                if(!empty($order_id))
                    // remove 1 item from the selected product
                    $this->productsRepository->deleteAllproductsIncart($order_id[0]->order_id);

                // get the cart that exist in the database
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

                // count the number of the item in your cart from the database
                $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                $itemNb = $itemNb[0]->qty_in_cart; 
            }

        // if the user is offline
        else
            {
                 $this->cart->instance('shopping')->destroy();

                 $itemNb = $this->cart->instance('shopping')->count();
                 $cartList = $this->cart->instance('shopping')->content();
            }

       
        Session::put('cart_item', $itemNb);


        return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
    }



     public function checkout()
    {   
        $pagename = pageName();
       
        if(!Auth::check())
        {
            return View::make('signin.index', array('pagename' => $pagename));
        }

        else
        {   
            return View::make('cart.checkout', array('pagename' => $pagename));
        }// end else of if(!Auth::check())
    }




    public function placeOrder()
    {   

        Session::forget('promo_id'); // clear the promo_id session variable if it exists 
        Session::forget('total_after_discount'); // clear the total_after_discount session variable if it exists
        Session::forget('promo_percentage'); // clear the total_after_discount session variable if it exists
        Session::forget('promo_id'); // clear the promo_id session variable if it exists


        $pagename = pageName();
        $flag = 0;

        if(!Auth::check())
        {
            return View::make('signin.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
        }

        else
        {   
            $input = Input::all();

            $this->checkoutForm->validate($input);

            
                Session::put('checkout_firstname', $input['firstname']);
                Session::put('checkout_lastname', $input['lastname']);
                Session::put('checkout_email', $input['email']);
                Session::put('checkout_phone', $input['phone']);
                Session::put('checkout_country', $input['country']);
                Session::put('checkout_city', $input['city']);
                Session::put('checkout_address', nl2br($input['address']));
                Session::put('checkout_payment', $input['payement']);

                //get the total amout of your cart 
                $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));
                $total_amount = $q[0]->total;

                // get the cart that exist in the database
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

                // count the number of the item in your cart from the database
                $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                $itemNb = $itemNb[0]->qty_in_cart; 

                Session::put('cart_item', $itemNb);

                // get all the active promo
                $active_promo = $this->promoRepository->getActivePromo();

                return View::make('cart.placeOrder', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb, 'total_amount' => $total_amount, 'active_promo' => $active_promo, 'flag' =>$flag));

        }// end else of if(!Auth::check())
    }


    public function applyPromoCode()
    {   
        $pagename = pageName();

        $input = Input::all();
        $promo_valid = $this->promoRepository->getInfoFromPromoCode($input['promo_code'], Session::get('user_id'));
        $flag = 0; // flag to hide the promo error message if valid

        //check if the promo code is valid (not used before, active and in range date)
        if(empty($promo_valid))
        {   
           $flag= 0; 
           Flash::error('Invalid promo code'); 

           Session::forget('promo_id'); // clear the promo_id session variable if it exists 
           Session::forget('total_after_discount'); // clear the total_after_discount session variable if it exists
           Session::forget('promo_percentage'); // clear the total_after_discount session variable if it exists

           //get the total amout of your cart 
            $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));
            $total_amount = $q[0]->total;

            // get the cart that exist in the database
            $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

            // count the number of the item in your cart from the database
            $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
            $itemNb = $itemNb[0]->qty_in_cart; 

            Session::put('cart_item', $itemNb);

            // get all the active promo
            $active_promo = $this->promoRepository->getActivePromo();

            return View::make('cart.placeOrder', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb, 'total_amount' => $total_amount, 'active_promo' => $active_promo, 'flag' => $flag));

        }

        else // if promo code is valid
        {   
            $flag= 1; // set the flag to one to remove the invalid promo msg if exist
            
           
            //get the total amout of your cart 
            $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));
            $total_amount = $q[0]->total;
           

            // get the cart that exist in the database
            $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

            // count the number of the item in your cart from the database
            $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
            $itemNb = $itemNb[0]->qty_in_cart; 

            Session::put('cart_item', $itemNb);

            // get all the active promo
            $active_promo = $this->promoRepository->getActivePromo();

            Session::forget('promo_id'); // clear the promo_id session variable if it exists 
            Session::forget('total_after_discount'); // clear the total_after_discount session variable if it exists
            Session::forget('promo_percentage'); // clear the promo_percentage session variable if it exists
   
            //get the latest promo code selected
            $promo_valid = $this->promoRepository->getInfoFromPromoCode($input['promo_code'], Session::get('user_id'));

            // set a new session variable
            Session::put('promo_id', $promo_valid[0]->promo_id);

            // calculate the price after applying the promo and stock it into a session variable
            $total_after_discount = (float)$total_amount*(100-$promo_valid[0]->percentage)/100;
            Session::put('total_after_discount', $total_after_discount);


            Session::put('promo_percentage', $promo_valid[0]->percentage);

             return View::make('cart.placeOrder', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb, 'total_amount' => $total_amount, 'active_promo' => $active_promo, 'promo_valid' => $promo_valid, 'flag' => $flag));
        }
        
    }

    public function cashOndelivery()
    {   
        $pagename = pageName();
        $input = Input::all();

        if(!Auth::check())
        {
            return View::make('signin.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
        }

        else
        {  
            if(isset($input['checkout'])) 
            {
                // get the total amout and the order_id of the cart to buy 
                $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));
                $order_id = $q[0]->order_id;
                $total_amount = $q[0]->total;


                // check if there is a promo applied 
                if (Session::has('total_after_discount'))
                {
                    $original_price = $q[0]->total;
                    $total_amount = Session::get('total_after_discount');
                    $promo_price  = Session::pull('total_after_discount');
                    $promo_percentage = Session::pull('promo_percentage');   
                }
                else // if no promo is applied
                {
                    $original_price = $q[0]->total;
                    $total_amount = $q[0]->total;
                    $promo_price  = NULL;
                    $promo_percentage  = NULL;
                }
               
                if (Session::has('promo_id'))
                $promo_id = Session::get('promo_id');
                else 
                $promo_id = NULL;



                // get the cart that exist in the database
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 
                
                // update the the order_status_id to 2 and the shipping information
                $this->productsRepository->updateWhenCashOnDelivery(Session::get('user_id'), $order_id, $original_price, $promo_price, $promo_id, $total_amount, Session::get('checkout_firstname'), Session::get('checkout_lastname'), Session::get('checkout_email'), 
                                        Session::get('checkout_phone'), Session::get('checkout_country'), Session::get('checkout_city'),
                                        Session::get('checkout_address'));

                // mark the promo as used if there is a promo
                if (Session::has('promo_id'))
                {
                    $this->promoRepository->markPromoAsUsed(Session::get('promo_id'), Session::get('user_id'));
                }

                // empty the cart item counter 
                Session::put('cart_item', 0);


                // ----------- SEND EMAIL TO BOTH ADMIN AND USER -------------------------
                
                 //mail for the client ------------------------------------
                 $email_client = Session::get('checkout_email');

                 Mail::send('emails.cash-on-delivery-client-email', 
                            array('cartList' => $cartList, 'firstname' => Session::get('checkout_firstname'), 'lastname' => Session::get('checkout_lastname'),
                                  'email_address' => Session::get('checkout_email'), 'phone' => Session::get('checkout_phone'),
                                  'country' => Session::get('checkout_country'), 'city' => Session::get('checkout_city'), 'shipping_address' => Session::get('checkout_address'), 'order_id' => $order_id, 'original_price' => $original_price, 'total_amount' => $total_amount, 'promo_percentage' => $promo_percentage, 'promo_price' => $promo_price), 
                            function($message) use ($email_client)
                        {
                            $message->from('ecommerce@eideal.com', 'Eideal Online')->subject('Thank you for your purchase | Eideal');
                            $message->to($email_client);
                        });


                 //mail for EIDEAL admin --------------------------------
                 $email_admin = 'ecommerce@eideal.com';
                
                 Mail::send('emails.cash-on-delivery-admin-email', 
                            array('cartList' => $cartList, 'firstname' => Session::get('checkout_firstname'), 'lastname' => Session::get('checkout_lastname'),
                                  'email_address' => Session::get('checkout_email'), 'phone' => Session::get('checkout_phone'),
                                  'country' => Session::get('checkout_country'), 'city' => Session::get('checkout_city'), 
                                  'shipping_address' => Session::get('checkout_address'), 'order_id' => $order_id, 'original_price' => $original_price, 'total_amount' => $total_amount, 'promo_percentage' => $promo_percentage, 'promo_price' => $promo_price), 
                            function($message) use ($email_admin)
                        {
                            $message->from(Session::get('checkout_email'), Session::get('checkout_firstname').' '.Session::get('checkout_lastname'))->subject('Product Purchase | Cash on delivery');
                            $message->to($email_admin);
                        });
                


            }

            return View::make('cart.checkOnDeliveryResponse', array('pagename' => $pagename, 'order_id' => $order_id));
            
        }// end else of if(!Auth::check())
    }




    public function buy()
    {   
        $pagename = pageName();

        if(!Auth::check())
        {
            return View::make('signin.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
        }

        // if the user if online
        else{

            $user_id = Session::get('user_id');

            // get the cart that exist in the database
            $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

            // count the number of the item in your cart from the database
            $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
            $itemNb = $itemNb[0]->qty_in_cart; 

            //get the total amout of your cart 
            $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));
            
            // test if the user applied a promo discount
            if (Session::has('total_after_discount'))
            $total_amount = Session::get('total_after_discount');
            else 
            $total_amount = $q[0]->total;


           

            if($itemNb == 0)
            {
                return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
            }


            else
            {

            // ------------------------------------ BANK GATEWAY ----------------------------------
            // ------------------------------------------------------------------------------------

                $SECURE_SECRET = "2ED66F5C89B9F38AE24B86CD192BDD9B";
                $appendAmp = 0;
                $vpcURL = "";
                $newHash = "";

                $param['accessCode']="0B84BA42";
                $param['merchTxnRef']= time().'-'.$user_id; // concatenate the time stamp and the user id
                $param['merchant']= "845601";
                $param['orderInfo']= time().'-'.$user_id; // concatenate the time stamp and the user id

                //function that ceil with specific digits number
                function round_up ($value, $places=0) 
                {
                  if ($places < 0) { $places = 0; }
                  $mult = pow(10, $places);
                  return ceil($value * $mult) / $mult;
                }

                 $bank_audi_total = round_up($total_amount, 2);
                 $bank_audi_total = $total_amount*100;
                
                $param['amount'] = (int)$bank_audi_total;
               

                $param['returnURL'] = "https://eideal.com/bank-audi-response?action=py";
               
             // if all the parameteres exists
                if (isset($param['accessCode']))
                {
                    ksort($param);
                    $md5HashData = $SECURE_SECRET;
                    
                    foreach($param as $key => $value) 
                    {
                        // create the md5 input and URL leaving out any fields that have no value
                        if (strlen($value) > 0 && ($key == 'accessCode' || $key == 'merchTxnRef' || $key == 'merchant' || $key == 'orderInfo' || $key == 'amount' || $key == 'returnURL')) {
                            print 'Key: '.$key.'  Value: '.$value."<br>";
                            // this ensures the first paramter of the URL is preceded by the '?' char
                            if ($appendAmp == 0) 
                            {
                                $vpcURL .= urlencode($key) . '=' . urlencode($value);
                                $appendAmp = 1;
                            } else {
                                $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                            }
                            $md5HashData .= $value;
                        }
                    }   
                    $newHash .= $vpcURL."&vpc_SecureHash=" . strtoupper(md5($md5HashData));
                    echo "<script language=\"javascript\">top.location.href='https://gw1.audicards.com/TPGWeb/payment/prepayment.action?$newHash'</script>";
                    //exit;
                }

            }


        }


    }


   


    public function bankAudiResponse()
    {
        $user_id = Session::get('user_id');
        $pagename = pageName();
        // get the cart that exist in the database
        $cartList = $this->productsRepository->getProductsInCartFromUserId($user_id); 

        // count the number of the item in your cart from the database
        $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
        $itemNb = $itemNb[0]->qty_in_cart; 

         $SECURE_SECRET = "2ED66F5C89B9F38AE24B86CD192BDD9B";

        //check if this page is being redirected from payment client thus carrying the field vpc_TxnResponseCode
            if (isset($_GET['vpc_TxnResponseCode']))
            {
                //function to map each response code number to a text message   
                function getResponseDescription($responseCode) 
                {
                    switch ($responseCode) {
                        case "0" : $result = "Transaction Successful"; break;
                        case "?" : $result = "Transaction status is unknown"; break;
                        case "1" : $result = "Unknown Error"; break;
                        case "2" : $result = "Bank Declined Transaction"; break;
                        case "3" : $result = "No Reply from Bank"; break;
                        case "4" : $result = "Expired Card"; break;
                        case "5" : $result = "Insufficient funds"; break;
                        case "6" : $result = "Error Communicating with Bank"; break;
                        case "7" : $result = "Payment Server System Error"; break;
                        case "8" : $result = "Transaction Type Not Supported"; break;
                        case "9" : $result = "Bank declined transaction (Do not contact Bank)"; break;
                        case "A" : $result = "Transaction Aborted"; break;
                        case "C" : $result = "Transaction Cancelled"; break;
                        case "D" : $result = "Deferred transaction has been received and is awaiting processing"; break;
                        case "E" : $result = "Invalid Credit Card"; break;
                        case "F" : $result = "3D Secure Authentication failed"; break;
                        case "I" : $result = "Card Security Code verification failed"; break;
                        case "G" : $result = "Invalid Merchant"; break;
                        case "L" : $result = "Shopping Transaction Locked (Please try the transaction again later)"; break;
                        case "N" : $result = "Cardholder is not enrolled in Authentication scheme"; break;
                        case "P" : $result = "Transaction has been received by the Payment Adaptor and is being processed"; break;
                        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;
                        case "S" : $result = "Duplicate SessionID (OrderInfo)"; break;
                        case "T" : $result = "Address Verification Failed"; break;
                        case "U" : $result = "Card Security Code Failed"; break;
                        case "V" : $result = "Address Verification and Card Security Code Failed"; break;
                        case "X" : $result = "Credit Card Blocked"; break;
                        case "Y" : $result = "Invalid URL"; break;                
                        case "B" : $result = "Transaction was not completed"; break;                
                        case "M" : $result = "Please enter all required fields"; break;                
                        case "J" : $result = "Transaction already in use"; break;
                        case "BL" : $result = "Card Bin Limit Reached"; break;                
                        case "CL" : $result = "Card Limit Reached"; break;                
                        case "LM" : $result = "Merchant Amount Limit Reached"; break;                
                        case "Q" : $result = "IP Blocked"; break;                
                        case "R" : $result = "Transaction was not processed - Reached limit of retry attempts allowed"; break;                
                        case "Z" : $result = "Bin Blocked"; break;

                        default  : $result = "Unable to be determined"; 
                    }
                    return $result;
                }




                  //function to map each issuer response code number to a text message   
                function getIssuerResponseDescription($acqResponseCode) 
                {
                    switch ($acqResponseCode) {
                        case "00" : $result = "Approved"; break;
                        case "01" : $result = "Refer to Card Issuer"; break;
                        case "02" : $result = "Refer to Card Issuer"; break;
                        case "03" : $result = "Invalid Merchant"; break;
                        case "04" : $result = "Pick Up Card"; break;
                        case "05" : $result = "Do Not Honor"; break;
                        case "07" : $result = "Pick Up Card"; break;
                        case "12" : $result = "Invalid Transaction"; break;
                        case "14" : $result = "Invalid Card Number (No such Number)"; break;
                        case "15" : $result = "No Such Issuer"; break;
                        case "33" : $result = "Expired Card"; break;
                        case "34" : $result = "Suspected Fraud"; break;
                        case "36" : $result = "Restricted Card"; break;
                        case "39" : $result = "No Credit Account"; break;
                        case "41" : $result = "Card Reported Lost"; break;
                        case "43" : $result = "Stolen Card"; break;
                        case "51" : $result = "Insufficient Funds"; break;
                        case "54" : $result = "Expired Card"; break;
                        case "57" : $result = "Transaction Not Permitted"; break;
                        case "59" : $result = "Suspected Fraud"; break;
                        case "62" : $result = "Restricted Card"; break;
                        case "65" : $result = "Exceeds withdrawal frequency limit"; break;
                        case "91" : $result = "Cannot Contact Issuer"; break;
 
                        default  : $result = "Unable to be determined"; 
                    }
                    return $result;
                }



                
                //function to display a No Value Returned message if value of field is empty
                function null2unknown($data) 
                {
                    if ($data == "") 
                        return "No Value Returned";
                     else 
                        return $data;
                }       
                //get secure hash value of merchant 
                //get the secure hash sent from payment client
                $vpc_Txn_Secure_Hash = addslashes($_GET["vpc_SecureHash"]);
                unset($_GET["vpc_SecureHash"]); 
                ksort($_GET);
                // set a flag to indicate if hash has been validated
                $errorExists = false;
                //check if the value of response code is valid
                if (strlen($SECURE_SECRET) > 0 && addslashes($_GET["vpc_TxnResponseCode"]) != "7" && addslashes($_GET["vpc_TxnResponseCode"]) != "No Value Returned") 
                {
                    //creat an md5 variable to be compared with the passed transaction secure hash to check if url has been tampered with or not
                    $md5HashData = $SECURE_SECRET;

                    //creat an md5 variable to be compared with the passed transaction secure hash to check if url has been tampered with or not
                    $md5HashData_2 = $SECURE_SECRET;

                    // sort all the incoming vpc response fields and leave out any with no value
                    foreach($_GET as $key => $value) 
                    {
                        if ($key != "vpc_SecureHash" && strlen($value) > 0 && $key != 'action' ) 
                        {
                            
                            $md5HashData_2 .= str_replace(" ",'+',$value);
                            $md5HashData .= $value;
                            
                        }
                    }

                    //if transaction secure hash is the same as the md5 variable created 
                    if ((strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData)) || strtoupper($vpc_Txn_Secure_Hash) == strtoupper(md5($md5HashData_2))))
                    {
                        $hashValidated = "<b>CORRECT</b>";
                        $errorExists = false;
                    } 
                    else 
                    {
                        $hashValidated = "<b>INVALID HASH</b>";
                        $errorExists = true;
                    }
                } 
                else 
                {
                    $hashValidated = "<FONT color='orange'><b>Not Calculated - No 'SECURE_SECRET' present.</b></FONT>";
                }
                
                //the the fields passed from the url to be displayed
                if(isset($_GET["amount"]))
                $amount          = null2unknown(addslashes($_GET["amount"])/100);
                else
                $amount='No Value Returned';

                if(isset($_GET["vpc_Message"]))
                $message         = null2unknown(addslashes($_GET["vpc_Message"]));
                else
                $message='No Value Returned';

                if(isset($_GET["vpc_Card"]))
                $cardType        = null2unknown(addslashes($_GET["vpc_Card"]));
                else
                $cardType='No Value Returned';

  
                if(isset($_GET["vpc_TransactionNo"]))
                $transactionNo   = null2unknown(addslashes($_GET["vpc_TransactionNo"]));
                else
                $transactionNo='No Value Returned';

                if(isset($_GET["orderInfo"]))
                $orderInfo       = null2unknown(addslashes($_GET["orderInfo"]));
                else
                $orderInfo='No Value Returned';

                if(isset($_GET["vpc_ReceiptNo"]))
                $receiptNo       = null2unknown(addslashes($_GET["vpc_ReceiptNo"]));
                else
                $receiptNo='No Value Returned';

                if(isset($_GET["merchTxnRef"]))
                $merchTxnRef     = null2unknown(addslashes($_GET["merchTxnRef"]));
                else
                $merchTxnRef='No Value Returned';

                if(isset($_GET["vpc_AcqResponseCode"]))
                $acqResponseCode = null2unknown(addslashes($_GET["vpc_AcqResponseCode"]));
                else
                $acqResponseCode='No Value Returned';


                if(isset($_GET["vpc_TxnResponseCode"]))
                $txnResponseCode = null2unknown(addslashes($_GET["vpc_TxnResponseCode"]));
                else
                $txnResponseCode='No Value Returned';


            
                if(isset($_GET["vpc_TxnResponseCode"]))
                $txnResponseCodeDesc =getResponseDescription($txnResponseCode);
                else
                $txnResponseCodeDesc='No Value Returned';
                
                if(isset($_GET["vpc_AcqResponseCode"]))
                $issuerResponseCodeDesc =getIssuerResponseDescription($acqResponseCode);
                else
                $issuerResponseCodeDesc='No Value Returned';



                $trans_date = Carbon::now();
                // Show 'Error' in title if an error condition
                $errorTxt = "";
                

                // Hash value false, false gateway
                if ($txnResponseCode == "7" || $txnResponseCode == "No Value Returned" || $errorExists == true) 
                {
                    $errorTxt = "Error ";
                     return View::make('cart.bankAudiResponse', 
                            array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb, 'errorTxt' => $errorTxt, 
                                  'hashValidated' =>  $hashValidated, 'errorExists' => $errorExists, 'txnResponseCode' => $txnResponseCode,
                                  'trans_date' => $trans_date));
                }



                if ($txnResponseCode != "7" && $txnResponseCode != "No Value Returned" && $errorExists == false) 

                {       

                    // get the total amount and the order_id of the cart to buy 
                            $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));
                            $order_id = $q[0]->order_id;
                           
                            // check if there is a promo applied 
                            if (Session::has('total_after_discount'))
                            {
                                $original_price = $q[0]->total;
                                $total_amount = Session::get('total_after_discount');
                                $promo_price  = Session::pull('total_after_discount');
                                $promo_percentage = Session::pull('promo_percentage');
                            }
                            else // if no promo is applied
                            {
                                $original_price = $q[0]->total;
                                $total_amount = $q[0]->total;
                                $promo_price  = NULL;
                                $promo_percentage  = NULL;
                            }
                           
                            if (Session::has('promo_id'))
                            $promo_id = Session::get('promo_id');
                            else 
                            $promo_id = NULL;



                            $firstname = Session::get('checkout_firstname');
                            $lastname = Session::get('checkout_lastname');
                            $email = Session::get('checkout_email');
                            $phone = Session::get('checkout_phone');
                            $country = Session::get('checkout_country');
                            $city = Session::get('checkout_city');
                            $shipping_address = Session::get('checkout_address');

                            $admin_email="ecommerce@eideal.com";


                    // transaction approved, insert in the database
                        if($txnResponseCode == "0" && $errorExists == false)
                        {   
                            // update the status of the order (3)(payment approved) using the bank repsonse and the shipping info 
                            $this->productsRepository->updateBankPayment($user_id, $order_id, $original_price, $promo_price, $promo_id, $total_amount, $firstname, $lastname, $email, 
                                        $phone, $country, $city, $shipping_address, $orderInfo, $transactionNo, $message, 
                                        $txnResponseCodeDesc, $issuerResponseCodeDesc, $receiptNo, $cardType, 3);
                            
                            // if promo applied, insert the promo id in the ta_promo_user table to mark as used    
                            if (Session::has('promo_id'))
                                $this->promoRepository->markPromoAsUsed(Session::pull('promo_id'), Session::get('user_id'));
                                
                            
                        //send the receipt to the client by mail -------------------
                         Mail::send('emails.purchase-email-success-client', 
                            array('cartList' => $cartList, 'merchTxnRef' => $merchTxnRef,
                                  'transactionNo' => $transactionNo, 'orderInfo' => $orderInfo, 'amount' => $total_amount, 
                                  'txnResponseCodeDesc' => $txnResponseCodeDesc, 'receiptNo' => $receiptNo, 'cardType' => $cardType, 
                                  'issuerResponseCodeDesc' => $issuerResponseCodeDesc,'txn_message' => $message, 'txnResponseCode' => $txnResponseCode, 
                                  'trans_date' => $trans_date,'errorExists' => $errorExists, 'firstname' => $firstname, 'lastname' => $lastname,
                                  'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                                  'shipping_address' => $shipping_address,'promo_percentage' => $promo_percentage, 'original_price' => $original_price),
                            function($message) use ($email)
                        {
                            $message->from('ecommerce@eideal.com', 'EIDEAL')->subject('Thank you for your purchase | EIDEAL');
                            $message->to($email);
                        });


                         //send an email notification to the admin -------------------
                          
                         Mail::send('emails.purchase-email-success-admin', 
                            array('cartList' => $cartList, 'firstname' => $firstname,'merchTxnRef' => $merchTxnRef,
                                  'transactionNo' => $transactionNo, 'orderInfo' => $orderInfo, 'amount' => $total_amount, 
                                  'txnResponseCodeDesc' => $txnResponseCodeDesc, 'receiptNo' => $receiptNo, 'cardType' => $cardType, 
                                  'issuerResponseCodeDesc' => $issuerResponseCodeDesc,'txn_message' => $message, 'txnResponseCode' => $txnResponseCode, 
                                  'trans_date' => $trans_date,'errorExists' => $errorExists, 'firstname' => $firstname, 'lastname' => $lastname,
                                  'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                                  'shipping_address' => $shipping_address,'promo_percentage' => $promo_percentage, 'original_price' => $original_price), 
                            function($message) use ($admin_email)
                        {
                            $message->from(Session::get('checkout_email'), Session::get('checkout_firstname').' '.Session::get('checkout_lastname'))->subject('Online product purchase | online payment');
                            $message->to($admin_email);
                        });



                          $this->cart->instance('shopping')->destroy();
                         
                          // set the number of items in the cart to zero  
                          Session::put('cart_item', 0);


                        return View::make('cart.bankAudiResponse', 
                                array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb, 'merchTxnRef' => $merchTxnRef,
                                      'transactionNo' => $transactionNo, 'orderInfo' => $orderInfo, 'amount' => $amount, 
                                      'txnResponseCodeDesc' => $txnResponseCodeDesc, 'receiptNo' => $receiptNo, 'cardType' => $cardType, 
                                      'issuerResponseCodeDesc' => $issuerResponseCodeDesc,'message' => $message, 'txnResponseCode' => $txnResponseCode, 
                                      'trans_date' => $trans_date, 'errorExists' => $errorExists));

                        }



                        else //transaction not approved, other error
                        {
                            // update the status of the order (4)(bank audi error) using the bank repsonse and the shipping info 
                            $this->productsRepository->updateBankPayment($user_id, $order_id, $original_price, $promo_price, $promo_id, $total_amount, $firstname, $lastname, $email, 
                                        $phone, $country, $city, $shipping_address, $orderInfo, $transactionNo, $message, 
                                        $txnResponseCodeDesc, $issuerResponseCodeDesc, $receiptNo, $cardType, 4);
                                


                        //send the email failed notification to the client  -------------------
                         Mail::send('emails.purchase-email-failed-client', 
                            array('cartList' => $cartList, 'merchTxnRef' => $merchTxnRef,
                                  'transactionNo' => $transactionNo, 'orderInfo' => $orderInfo, 'amount' => $total_amount, 
                                  'txnResponseCodeDesc' => $txnResponseCodeDesc, 'receiptNo' => $receiptNo, 'cardType' => $cardType, 
                                  'issuerResponseCodeDesc' => $issuerResponseCodeDesc,'txn_message' => $message, 'txnResponseCode' => $txnResponseCode, 
                                  'trans_date' => $trans_date,'errorExists' => $errorExists, 'firstname' => $firstname, 'lastname' => $lastname,
                                  'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                                  'shipping_address' => $shipping_address, 'promo_percentage' => $promo_percentage, 'original_price' => $original_price),
                            function($message) use ($email)
                        {
                            $message->from('ecommerce@eideal.com', 'EIDEAL')->subject('Purchase transaction failed | EIDEAL');
                            $message->to($email);
                        });


                         //send an email notification to the admin -------------------

                         Mail::send('emails.purchase-email-failed-admin', 
                            array('cartList' => $cartList, 'firstname' => $firstname,'merchTxnRef' => $merchTxnRef,
                                  'transactionNo' => $transactionNo, 'orderInfo' => $orderInfo, 'amount' => $total_amount, 
                                  'txnResponseCodeDesc' => $txnResponseCodeDesc, 'receiptNo' => $receiptNo, 'cardType' => $cardType, 
                                  'issuerResponseCodeDesc' => $issuerResponseCodeDesc,'txn_message' => $message, 'txnResponseCode' => $txnResponseCode, 
                                  'trans_date' => $trans_date,'errorExists' => $errorExists, 'firstname' => $firstname, 'lastname' => $lastname,
                                  'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                                  'shipping_address' => $shipping_address, 'promo_percentage' => $promo_percentage, 'original_price' => $original_price), 
                            function($message) use ($admin_email)
                        {
                            $message->from(Session::get('checkout_email'), Session::get('checkout_firstname').' '.Session::get('checkout_lastname'))->subject('Online purchase failed | Bank Error');
                            $message->to($admin_email);
                        });





                        return View::make('cart.bankAudiResponse', 
                                array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb, 'merchTxnRef' => $merchTxnRef,
                                      'transactionNo' => $transactionNo, 'orderInfo' => $orderInfo, 'amount' => $total_amount, 
                                      'txnResponseCodeDesc' => $txnResponseCodeDesc, 'receiptNo' => $receiptNo, 'cardType' => $cardType, 
                                      'issuerResponseCodeDesc' => $issuerResponseCodeDesc,'message' => $message, 'txnResponseCode' => $txnResponseCode, 
                                      'trans_date' => $trans_date, 'errorExists' => $errorExists));
                        }
          
                }



         } // end if (isset($_GET['vpc_TxnResponseCode']))

    } // end bankAudiResponse



    public function paypalResponse()
    {   
        $user_id = Session::get('user_id');
        $pagename = pageName();

        // get the cart that exist in the database
        $cartList = $this->productsRepository->getProductsInCartFromUserId($user_id); 

         // get the total amount and the order_id of the cart to buy 
        $q = $this->productsRepository->getTotalAmountOrderId(Session::get('user_id'));

        if(!empty($q))
        {
            $order_id = $q[0]->order_id;
          
            // check if there is a promo applied 
            if (Session::has('total_after_discount'))
            {
                $original_price = $q[0]->total;
                $total_amount = Session::get('total_after_discount');
                $total_amount = number_format((float)$total_amount, 2, '.', '');
                $promo_price  = Session::pull('total_after_discount');
                $promo_percentage = Session::pull('promo_percentage');
            }
            else // if no promo is applied
            {
                $original_price = $q[0]->total;
                $total_amount = $q[0]->total;
                $total_amount = number_format((float)$total_amount, 2, '.', '');
                $promo_price  = NULL;
                $promo_percentage  = NULL;
            }
           
            if (Session::has('promo_id'))
            $promo_id = Session::get('promo_id');
            else 
            $promo_id = NULL;


            $firstname = Session::get('checkout_firstname');
            $lastname = Session::get('checkout_lastname');
            $email = Session::get('checkout_email');
            $phone = Session::get('checkout_phone');
            $country = Session::get('checkout_country');
            $city = Session::get('checkout_city');
            $shipping_address = Session::get('checkout_address');

            $admin_email="ecommerce@eideal.com";


            // get the current date and time
            $trans_date = Carbon::now();

            // ======= IF TRANSACTION APPROVED ===============
           

            // verify that paypal had return the response GET parameters
            if(isset($_GET['tx']) && isset($_GET['amt']) && isset($_GET['cc']) && isset($_GET['st']))
            {   
                // check if the sent paypal amount is the same as the real cost amount
                if($_GET['amt'] == $total_amount)
                {  
                    $paypal_transaction_id = $_GET['tx'];
                   // $paypal_amount = $_GET['amt'];
                   // $paypal_currency = $_GET['cc'];
                    $paypal_status = $_GET['st'];
                    $paypal_message = $_GET['cm'];


                    // update the status of the order using the paypal repsonse and the shipping info 
                    $this->productsRepository->updatePayPalPayment($user_id, $order_id, $paypal_transaction_id, $original_price, $promo_price, $promo_id, $total_amount, $firstname, $lastname, $email, $phone, $country, $city, $shipping_address, $paypal_message, 6);
                    
                    // if promo applied, insert the promo id in the ta_promo_user table to mark as used    
                    if (Session::has('promo_id'))
                        $this->promoRepository->markPromoAsUsed(Session::pull('promo_id'), Session::get('user_id'));




                    //send the receipt to the client by mail -------------------
                     Mail::send('emails.paypal-purchase-email-success-client', 
                        array('cartList' => $cartList, 'amount' => $total_amount, 'trans_date' => $trans_date, 'firstname' => $firstname, 'lastname' => $lastname, 'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                              'shipping_address' => $shipping_address, 'promo_percentage' => $promo_percentage, 'original_price' => $original_price, 'paypal_transaction_id' => $paypal_transaction_id, 'order_id' => $order_id, 'paypal_message' => $paypal_message),
                        function($message) use ($email)
                    {
                        $message->from('ecommerce@eideal.com', 'EIDEAL')->subject('Thank you for your purchase | EIDEAL');
                        $message->to($email);
                    });


                     //send an email notification to the admin -------------------
                      
                     Mail::send('emails.paypal-purchase-email-success-admin', 
                       array('cartList' => $cartList, 'amount' => $total_amount, 'trans_date' => $trans_date, 'firstname' => $firstname, 'lastname' => $lastname, 'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                              'shipping_address' => $shipping_address, 'promo_percentage' => $promo_percentage, 'original_price' => $original_price, 'paypal_transaction_id' => $paypal_transaction_id, 'order_id' => $order_id, 'paypal_message' => $paypal_message), 
                        function($message) use ($admin_email)
                    {
                        $message->from(Session::get('checkout_email'), Session::get('checkout_firstname').' '.Session::get('checkout_lastname'))->subject('Online product purchase | online payment');
                        $message->to($admin_email);
                    });






                    //destroy the cart 
                    $this->cart->instance('shopping')->destroy();
                             
                    // set the number of items in the cart to zero  
                    Session::put('cart_item', 0);

                    

                    return View::make('cart.paypalResponse', 
                            array('pagename' => $pagename,'paypal_transaction_id' => $paypal_transaction_id,
                                  'order_id' => $order_id, 'amount' => $total_amount, 'trans_date' => $trans_date, 'paypal_message' => $paypal_message));

                }

            }

            // if paypal failed to return response
            else

            {
                if(!isset($_GET['tx']))
                    $paypal_transaction_id = 'none';
                if(!isset($_GET['cm']) || empty($_GET['cm']))
                    $paypal_message = 'Paypal error';

                 // update the status of the order using the paypal repsonse and the shipping info 
                    $this->productsRepository->updatePayPalPayment($user_id, $order_id, $paypal_transaction_id, $original_price, $promo_price, $promo_id, $total_amount, $firstname, $lastname, $email, $phone, $country, $city, $shipping_address, $paypal_message, 7);

                    //send the failed transaction receipt to the client by mail -------------------
                     Mail::send('emails.paypal-purchase-email-failed-client', 
                        array('cartList' => $cartList, 'amount' => $total_amount, 'trans_date' => $trans_date, 'firstname' => $firstname, 'lastname' => $lastname, 'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                              'shipping_address' => $shipping_address, 'promo_percentage' => $promo_percentage, 'original_price' => $original_price, 'paypal_transaction_id' => $paypal_transaction_id, 'order_id' => $order_id, 'paypal_message' => $paypal_message),
                        function($message) use ($email)
                    {
                        $message->from('ecommerce@eideal.com', 'EIDEAL')->subject('Failed Transaction | EIDEAL');
                        $message->to($email);
                    });


                     //send a failed transaction email notification to the admin -------------------
                      
                     Mail::send('emails.paypal-purchase-email-failed-admin', 
                       array('cartList' => $cartList, 'amount' => $total_amount, 'trans_date' => $trans_date, 'firstname' => $firstname, 'lastname' => $lastname, 'email_address' => $email, 'phone' => $phone, 'country' => $country, 'city' => $city, 
                              'shipping_address' => $shipping_address, 'promo_percentage' => $promo_percentage, 'original_price' => $original_price, 'paypal_transaction_id' => $paypal_transaction_id, 'order_id' => $order_id, 'paypal_message' => $paypal_message), 
                        function($message) use ($admin_email)
                    {
                        $message->from(Session::get('checkout_email'), Session::get('checkout_firstname').' '.Session::get('checkout_lastname'))->subject('Failed purchase transaction | Paypal Error');
                        $message->to($admin_email);
                    });

                     return View::make('cart.paypalResponse', 
                            array('pagename' => $pagename,'paypal_transaction_id' => $paypal_transaction_id,
                                  'order_id' => $order_id, 'amount' => $total_amount, 'trans_date' => $trans_date, 'paypal_message' => $paypal_message));

            }

        }// end if(!empty($q))

        else // if the cart is empty
        {
            // if the user is online
            if(Auth::check())
            {   
                //check if the user already has a filled cart
                $cartList = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id'));  

                // count the number of the item in your cart from the database
                    $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
                    $itemNb = $itemNb[0]->qty_in_cart;
            }

             // if the user is offline
            else
            {   
                $cartList = $this->cart->instance('shopping')->content();
                $itemNb = $this->cart->instance('shopping')->count();
            }


            Session::put('cart_item', $itemNb);

            return View::make('cart.index', array('pagename' => $pagename, 'cartList' => $cartList, 'itemNb' => $itemNb));
            }


        }

} // end cartController
