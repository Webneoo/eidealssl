<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;

class CurrencyController extends \BaseController {
   

	public function index()
	{  
        
        if(Request::ajax()) { 
            
            $data = Input::all();
            Session::put('quoteCurrency', $data['currency']);
                
                }

    }

}
