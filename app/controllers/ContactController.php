<?php

use eideal\Forms\SendCvForm;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class ContactController extends \BaseController {
    /**
     * @var SendCvForm
     */
    private $sendCvForm;


    /**
     * @param UserRepository $userRepository
     * @param DrawsRepository $drawsRepository
     */
    function __construct(SendCvForm $sendCvForm)
    {
        $this->sendCvForm = $sendCvForm;
    }

	public function index()
	{  
        $pagename = pageName();

        $input = Input::all();

         // Sending email from Dubai form 

        if(isset($input['submit_dubai_form']))
        {   
            if (isset($input['name_contact_dubai']) && isset($input['email_contact_dubai']) && isset($input['msg_contact_dubai']))
                {   
                    $name_dubai = $input['name_contact_dubai'];
                    $email_dubai = $input['email_contact_dubai'];
                    $msg_dubai = nl2br($input['msg_contact_dubai']);

                    if(isset($input['phone_contact_dubai']))
                     {
                        $phone_dubai = $input['phone_contact_dubai'];
                     }   
                     else
                     {
                        $phone_dubai = ' ';
                     }
                

                    Mail::send('emails.contact-us-dubai', array('name_dubai' => $name_dubai, 'msg_dubai' => $msg_dubai, 'phone_dubai' => $phone_dubai), function($message) use ($email_dubai)
                    {
                        $message->from($email_dubai, 'Eideal website')->subject('Message from eideal website');
                        $message->to('info@eideal.com');
                    });
                    Flash::success('Your email has been succsessfully sent to EIDEAL DUBAI'); 
                }
        }


        // Sending email from Beirut form 

        if(isset($input['submit_beirut_form']))
        {
            if (isset($input['name_contact_beirut']) && isset($input['email_contact_beirut']) && isset($input['msg_contact_beirut']))
                {
                    $name_beirut = $input['name_contact_beirut'];
                    $email_beirut = $input['email_contact_beirut'];
                    $msg_beirut = nl2br($input['msg_contact_beirut']);

                    if(isset($input['phone_contact_beirut']))
                     {
                        $phone_beirut = $input['phone_contact_beirut'];
                     }   
                     else
                     {
                        $phone_beirut = ' ';
                     }
                

                    Mail::send('emails.contact-us-beirut', array('name_beirut' => $name_beirut, 'msg_beirut' => $msg_beirut, 'phone_beirut' => $phone_beirut), function($message) use ($email_beirut)
                    {
                        $message->from($email_beirut, 'Eideal website')->subject('Message from eideal website');
                        $message->to('info@eideal.com');
                    });
                    Flash::success('Your email has been succsessfully sent to EIDEAL BEIRUT');
                }
        }


        return View::make('contact.index', array('pagename' => $pagename));
	}

    public function sendCv()
    {
        $pagename = pageName();
        $input = Input::all();

        $this->sendCvForm->validate($input, true);


        if(Input::hasFile('cv_upload'))
        {
            $file = Input::file('cv_upload');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = '/images/' . $file_name;
            $file->move(public_path() .'/images/', $file_name);
            $input['cv_upload'] = $real_path;
        }

        else
            $input['cv_upload'] ="";


        if(Input::hasFile('photo_upload'))
        {
            $file = Input::file('photo_upload');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = '/images/' . $file_name;
            $file->move(public_path() .'/images/', $file_name);
            $input['photo_upload'] = $real_path;
        }

        else
            $input['photo_upload'] ="";



        Mail::send('emails.careers', array('input' => $input), function($message) use($input)
        {
            $message->from($input['email'], 'Careers From Website')->subject('Careers From Eideal Website');
            if($input['cv_upload'] != "")
            $message->attach(ltrim($input['cv_upload'], '/'));
            if($input['photo_upload'] != "")
            $message->attach(ltrim($input['photo_upload'], '/'));
            $message->to('careers@eideal.com');
        });
        Flash::success('Your CV has been succsessfully sent to EIDEAL');



        return View::make('contact.index', array('pagename' => $pagename));
    }

}
