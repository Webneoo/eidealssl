<?php

use Laracasts\Commander\CommanderTrait;

use eideal\Services\ServicesRepository;

class BaseController extends Controller {

    use CommanderTrait;

     public $ex_rate;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	protected function setupLayout()
	{   
 		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

        View::share('currentUser', Auth::user());
        View::share('signedIn', Auth::user());

       
        if (!Session::has('quoteCurrency'))
         Session::put('quoteCurrency', 'AED');
      
        $quoteCurrency = Session::get('quoteCurrency');

        // fix the exchange rate of AED to 3.65
        if($quoteCurrency == 'AED')
        $ex_rate = number_format(3.65, 5, '.', '');

        else
        {
            //Google currency convertion rate
            // $url = "http://finance.google.com/finance/converter?a=1&from=USD&to=$quoteCurrency";
           
            // $data = file_get_contents($url);
            // preg_match_all("/<span class=bld>(.*)<\/span>/", $data, $converted);
            // $final = preg_replace("/[^0-9.]/", "", $converted[1][0]);  
            
            
             $url = file_get_contents('http://free.currencyconverterapi.com/api/v3/convert?q=USD_' . $quoteCurrency . '&compact=ultra');
             $json = json_decode($url, true);

             $final = $json['USD_' . $quoteCurrency];

             $ex_rate = (float)$final;
             $ex_rate = number_format($ex_rate, 2, '.', '');

        }

        // get all services for the menu
        View::share('menu_services', \DB::select(\DB::raw("SELECT * FROM ta_services ORDER BY updated_at DESC") ));
        // get all brands for the menu
        View::share('menu_brands', \DB::select(\DB::raw("SELECT * FROM ta_brands ORDER BY brand_title ASC") ));


        // sharing the ex_rate to all the views
        View::share ( 'curr', $ex_rate);
        View::share ( 'quoteCurr', $quoteCurrency);

	}

}
