<?php


use eideal\Forms\SignUpForm;
use eideal\Forms\EditAccountForm;
use eideal\Forms\EditEmailAccountForm;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use eideal\Users\UserRepository;


class UsersController extends \BaseController {


    private $userRepository;
    private $signUpForm;
    private $editAccountForm;

    
    function __construct(UserRepository $userRepository, SignUpForm $signUpForm, EditAccountForm $editAccountForm,
                         EditEmailAccountForm $editEmailAccountForm)
    {
        $this->userRepository = $userRepository;
        $this->signUpForm = $signUpForm;
        $this->editAccountForm = $editAccountForm;
        $this->editEmailAccountForm = $editEmailAccountForm;
    }

    public function index()
    {
        $pagename = pageName();
        $user_id = Session::get('user_id');
        $user_info = $this->userRepository->getUserInfoById($user_id);
        return View::make('users.my-account',array('pagename' => $pagename, 'user_info' => $user_info));
    }

    public function edit()
    {
        $user_id = Session::get('user_id');
        $pagename = pageName();
        $user_info = $this->userRepository->getUserInfoById($user_id);
        return View::make('users.edit-my-account', array('pagename' => $pagename, 'user_info' => $user_info));
    }

    public function update()
    {
        $user_id = Session::get('user_id');
        $pagename = pageName();
        $input = Input::all();
        $old_user_info = $this->userRepository->getUserInfoById($user_id);
        foreach($old_user_info as $o)
        {
            $old_email = $o->email;
        }

        if($old_email != $input['email']) // if the user changes his email test if the email already exists in the database
        $this->editEmailAccountForm->validate($input, true);    
        
        $this->editAccountForm->validate($input, true);
        $this->userRepository->updateUserInfo($user_id, $input);
        Flash::success('Your account info has been updated');
        $user_info = $this->userRepository->getUserInfoById($user_id);
        return View::make('users.my-account', array('pagename' => $pagename, 'user_info' => $user_info));
    }

    public function signUp()
	{  
        $pagename = pageName();
        return View::make('users.sign_up', array('pagename' => $pagename));
	}

    public function show()
    {   
        $pagename = pageName();

        $usersList = $this->userRepository->getUsersList();
        return View::make('cms.users.show', array('pagename' => $pagename, 'usersList' => $usersList));
    }

    public function delete($user_id)
    {
         $pagename = pageName();

        $this->userRepository->deleteUser($user_id);
        Flash::error('The User has been DELETED'); //Message confirming that the post has been deleted

        $usersList = $this->userRepository->getUsersList();
        return View::make('cms.users.show', array('pagename' => $pagename, 'usersList' => $usersList));
    }

    public function display($user_id)
    {   
        $pagename = pageName();
        $user_info = $this->userRepository->getUserInfoById($user_id);
        return View::make('cms.users.display', array('pagename' => $pagename, 'user_info' => $user_info));
    }

    public function create()
    {   
        $pagename = pageName();
        $formData = Input::all();
       
        $this->signUpForm->validate($formData, true);
        $this->userRepository->addNewUser($formData);

        $username = $formData['username'];
        $firstname = $formData['firstname'];
        $email = $formData['email'];

        Flash::success('You have been successfully registered');//Message confirming that the posts have been generated

        Mail::send('emails.signup-email-template', array('username' => $username, 'firstname' => $firstname), function($message) use ($email)
                {
                    $message->from('noreply@eideal.com', 'EIDEAL')->subject('Welcome to EIDEAL');
                    $message->to($email);
                });


        return View::make('signin.index', array('pagename' => $pagename));
    
    }


}
