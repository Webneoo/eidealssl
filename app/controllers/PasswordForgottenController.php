<?php

use eideal\Users\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class PasswordForgottenController extends \BaseController {
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * @param UserRepository $userRepository
     * @param DrawsRepository $drawsRepository
     */
    function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

	public function index()
	{  
        $pagename = pageName();
        return View::make('passwordforgotten.index', array('pagename' => $pagename));
	}

    public function reset()
    {  
        $pagename = pageName();
        $input = Input::all();

        $username = $this->userRepository->getUserInfoByUsername($input['username']);

        if(!empty($username))
        {    
            foreach($username as $u)
            {
                $email = $u->email;
                $user_id = $u->id;


                $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                $pass = array(); //remember to declare $pass as an array
                $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                $random_password = implode($pass); //turn the array into a string

                $this->userRepository->updatePasswordByUserId($user_id, $random_password);


                Mail::send('emails.reset-password', array('random_password' => $random_password), function($message) use ($email)
                {
                    $message->from('info@eidealonline.com', 'Eideal website')->subject('Reset Your Password');
                    $message->to($email);
                });

                 Flash::success('Your password has been reset and sent to the following email address: <b>'.$username[0]->email.'</b>'); 
            }
        }

        else
            Flash::error('The username you entered doesn\'t exist'); 

        return View::make('passwordforgotten.index', array('pagename' => $pagename));
    }


}
