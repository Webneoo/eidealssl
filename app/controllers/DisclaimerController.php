<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class DisclaimerController extends \BaseController {

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
        return View::make('disclaimer.index', array('pagename' => $pagename));
	}

}
