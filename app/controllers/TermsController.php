<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class TermsController extends \BaseController {



    /**
     * @param UserRepository $userRepository
     * @param DrawsRepository $drawsRepository
     */
    function __construct()
    {
        
    }

	public function index()
	{  
        $pagename = pageName();
        return View::make('terms.index', array('pagename' => $pagename));
	}



    public function faq()
    {  
        $pagename = pageName();
        return View::make('terms.faq', array('pagename' => $pagename));
    }


}
