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
        Session::put('city', $user->city);
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

        return Redirect::to('/home');
    }







}
