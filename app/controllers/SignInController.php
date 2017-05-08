<?php


use eideal\Home\HomeRepository;
use eideal\Media\MediasRepository;
use eideal\Products\ProductsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use eideal\Forms\SignInForm;
use eideal\Users\UserRepository;
use eideal\Brands\BrandsRepository;
use Gloudemans\Shoppingcart\Cart;


class SignInController extends \BaseController {

    private $signInForm;

    private $userRepository;

    private $homeRepository;

    private $mediasRepository;

    private $productsRepository;

    private $brandsRepository;

    private $cart;

    function __construct(SignInForm $signInForm, UserRepository $userRepository, HomeRepository $homeRepository, 
                         MediasRepository $mediasRepository, ProductsRepository $productsRepository, 
                         BrandsRepository $brandsRepository, Cart $cart)
    {
        $this->signInForm = $signInForm;
        $this->userRepository = $userRepository;
        $this->homeRepository = $homeRepository;
        $this->mediasRepository = $mediasRepository;
        $this->productsRepository = $productsRepository;
        $this->brandsRepository = $brandsRepository;
        $this->cart = $cart;
    }

	public function index()
	{  
        $pagename = pageName();
        return View::make('signin.index', array('pagename' => $pagename));
	}

    public function signIn()
    {

        $formData = Input::only('username', 'password');
        $this->signInForm->validate($formData, true);
        if(! Auth::attempt(array('username' => $formData['username'], 'password' => $formData['password'])))
        {
            return Redirect::back()->withInput();
        }


        $user = $this->userRepository->getUserInfoById(Auth::user()->id);

        Session::put('user_id', $user[0]->id);
        Session::put('username', $user[0]->username);
        Session::put('email', $user[0]->email);
        Session::put('firstname', $user[0]->firstname);
        Session::put('lastname', $user[0]->lastname);
        Session::put('birth_date', $user[0]->birth_date);
        Session::put('phone', $user[0]->phone);
        Session::put('address', $user[0]->address);
        Session::put('country', $user[0]->country);
        Session::put('city', $user[0]->city);
        Session::put('address', $user[0]->address);



        // update the cart -----------------------------------------------

        $cart_content_db = $this->productsRepository->getProductsInCartFromUserId(Session::get('user_id')); 

        //if the cart of the user in the database is completely empty (NO order id)
        if(empty($cart_content_db))
        {    
            // if cookies cart not empty (database cart empty)
            if($this->cart->instance('shopping')->count() != 0)
            {   
                // get all the item inside the cookies cart
                $cart_content_cookies = $this->cart->instance('shopping')->content();
                
                $i=1;
                foreach($cart_content_cookies as $c)
                {
                    if($i==1)
                    {   // insert order_id + first product
                        $this->productsRepository->insertOrderIdProduct($c->options->size, Session::get('user_id'), $c->qty); 
                    }
                    else
                    {   
                        $order_id = $this->productsRepository->getOrderId(Session::get('user_id'));
                        $this->productsRepository->insertProdcutInCart($c->options->size, $order_id[0]->order_id, $c->qty);
                    }
                $i++;
                }
            }
        }

         //if the cart of the user in the database is not empty 
        else
        {
            // if cookies cart not empty (database cart not empty)
            if($this->cart->instance('shopping')->count() != 0)
            {   
                // get all the item inside the cookies cart
                $cart_content_cookies = $this->cart->instance('shopping')->content();
                
                $i=1;
                foreach($cart_content_cookies as $c)
                {
                   foreach($cart_content_db as $cdb)
                   {
                    //if the product in the cookies cart already exist in the database cart => update it quantity
                    if($c->options->size == $cdb->product_id) 
                    {
                        $this->productsRepository->updateProductQuantity($cdb->product_id, $cdb->order_id, ($c->qty));
                    }
                    else //if the product in the cookies cart doesn't exist in the database cart => insert new product
                    {
                       $this->productsRepository->insertProdcutInCart($c->options->size, $cdb->order_id, $c->qty); 
                    }   
                    break;
                   }
                }
            }
        }

        // count the number of the item in your cart from the database
        $itemNb = $this->productsRepository->countProductInCart(Session::get('user_id'));
        $itemNb = $itemNb[0]->qty_in_cart;
        Session::put('cart_item', $itemNb); 
        

        $pagename = pageName();
        $input = Input::all(); 


        $slideShowList = $this->homeRepository->showSlideshow();
       

        $bestSeller = $this->homeRepository->getBestSellerProducts();

        $productMonth = $this->productsRepository->selectProductOfTheMonth();


        $mediaList = $this->mediasRepository->getAllMediasListByProductId($productMonth[0]->product_id);

        $brandsImages = $this->brandsRepository->getAllBrandsImages();
        
         // if the product is liquid
        if(isset($input['submit_liquid_product']))
        {   
            //if the user is online
            if(!Auth::check())
            {   

                $alert_msg = '\nThank you for your interest in our products.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nPlease sign in to proceed';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";

                return View::make('signin.index', array('pagename' => $pagename));         
            }

            else
            {   

                $liquid_product_id = $input['liquid_product_id'];
                $user_id = Session::get('user_id');


                $liquid_product_info = $this->productsRepository->getProductInfoFromId($liquid_product_id);
                $user_info = $this->userRepository->getUserInfoById($user_id);


                $name = $user_info[0]->firstname. ' '.$user_info[0]->lastname;
                $username = $user_info[0]->username;
                $email = $user_info[0]->email;
                $phone = $user_info[0]->phone;
                $country = $user_info[0]->country;
                $city = $user_info[0]->city;
                $address = $user_info[0]->address;

                $code = $liquid_product_info[0]->code;
                $product_name = $liquid_product_info[0]->title;
              

               
                 Mail::send('emails.liquid-product', array('user_id' => $user_id, 'name' => $name, 'username' => $username, 'email' => $email, 'phone' => $phone, 
                                                           'country' => $country, 'liquid_product_id' => $liquid_product_id, 'code' => $code, 
                                                           'product_name' => $product_name, 'city' => $city, 'address' => $address), 
                        function($message) use ($email)
                    {
                        $message->from($email, 'Eideal website')->subject('Liquid product email');
                        $message->to('ecommerce@eideal.com');
                    });

                $alert_msg = 'Dear '.Session::get('firstname').'\n\nThank you for your interest in our products.\nYour inquiry is well received.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nOne of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status and delivery options and itinerary.\n';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";          
            }

        }

         $newsletters_info = $this->homeRepository->getNewsLettersInfo();

         return View::make('Home.index', array('pagename' => $pagename, 'slideShowList' => $slideShowList, 'mediaList' => $mediaList,
                                              'bestSeller' => $bestSeller , 'productMonth' => $productMonth, 'brandsImages' => $brandsImages, 'newsletters_info' => $newsletters_info));

    }

    public function destroy()
    {
        Auth::logout();
        return Redirect::intended();
    }



}
