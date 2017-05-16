<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use eideal\Forms\SignInForm;
use eideal\Users\UserRepository;
use eideal\Home\HomeRepository;
use eideal\Media\MediasRepository;
use eideal\Products\ProductsRepository;
use eideal\Brands\BrandsRepository;
use Gloudemans\Shoppingcart\Cart;

class SessionsController extends \BaseController {

    private $signInForm;
    private $userRepository;
    private $homeRepository;
    private $productsRepository;
    private $mediasRepository;
    private $brandsRepository;
    private $cart;

    function __construct(SignInForm $signInForm, UserRepository $userRepository, HomeRepository $homeRepository, 
                         MediasRepository $mediasRepository, ProductsRepository $productsRepository, BrandsRepository $brandsRepository, Cart $cart)
    {
        $this->signInForm = $signInForm;
        $this->userRepository = $userRepository;
        $this->cart = $cart;
        $this->homeRepository = $homeRepository;
        $this->productsRepository = $productsRepository;
        $this->mediasRepository = $mediasRepository;
        $this->brandsRepository = $brandsRepository;
    }

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('cms.create');
	}

    /**
     * Log in the application and redirect to the dashboard if logged in
     *
     * @return mixed
     * @throws \Laracasts\Validation\FormValidationException
     */
    public function store()
    {
        $formData = Input::only('username', 'password');
        $this->signInForm->validate($formData, true);

        if (!Auth::attempt(array('username' => $formData['username'], 'password' => $formData['password'], 'admin' => 1))) {
            Flash::message('Incorrect Credentials. Please try again');
            return Redirect::back()->withInput();
        }

        return Redirect::intended('home-management');
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

        Session::put('user_id', $user->id);
        Session::put('username', $user->username);
        Session::put('email', $user->email);
        Session::put('firstname', $user->firstname);
        Session::put('lastname', $user->lastname);
        Session::put('birth_date', $user->birth_date);
        Session::put('phone', $user->phone);
        Session::put('address', $user->address);
        Session::put('country', $user->country);
        Session::put('promo_pts', $user->promo_pts);

        return Redirect::intended();
    }

    public function destroy()
    {
        Auth::logout();
       return View::make('cms.create');
    }


    public function destroy_fronted()
    {
        Auth::logout();
        
        $this->cart->instance('shopping')->destroy();
        Session::put('cart_item', 0);

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

                $alert_msg = '\nThank you for your interest in our products.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nPlease sign in to proceed.\nRegards';
                
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

                $alert_msg = 'Dear '.Session::get('firstname').',\n\nThank you for your interest in our products.\nYour inquiry is well received.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nOne of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status and delivery options and itinerary.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";        
            }

        }

        $newsletters_info = $this->homeRepository->getNewsLettersInfo();

        return View::make('Home.index', array('pagename' => $pagename, 'slideShowList' => $slideShowList, 'mediaList' => $mediaList,
                                              'bestSeller' => $bestSeller , 'productMonth' => $productMonth, 'brandsImages' => $brandsImages, 'newsletters_info' => $newsletters_info));
    }







}
