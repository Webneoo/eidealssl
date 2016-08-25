<?php

use Laracasts\Commander\CommanderTrait;

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
        $this->ex_rate = number_format(3.65, 5, '.', '');

        else
        {
            //Google currency convertion rate
             $url = "http://www.google.com/finance/converter?a=1&from=USD&to=$quoteCurrency"; 
             $request = curl_init(); 
             $timeOut = 0; 
             curl_setopt ($request, CURLOPT_URL, $url); 
             curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
             curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
             curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut); 
             $response = curl_exec($request); 
             curl_close($request);  

            $regularExpression     = '#\<span class=bld\>(.+?)\<\/span\>#s';
            preg_match($regularExpression, $response, $finalData);

             //split the currency units from the number
            $html_number = preg_split('/(?=[A-Z])/', $finalData[0]);
            
            //split 
            $this->ex_rate = preg_split('/>/', $html_number[0]);
            $this->ex_rate = (float)$this->ex_rate[1];
            $this->ex_rate = number_format($this->ex_rate, 5, '.', '');
        }
 
        // sharing the ex_rate to all the views
        View::share ( 'curr', $this->ex_rate);
        View::share ( 'quoteCurr', $quoteCurrency);

	}

}
