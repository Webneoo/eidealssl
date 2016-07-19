<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Promo\PromoRepository;
use eideal\Forms\CreatePromoForm;


class PromoController extends \BaseController {


    private $createPromoForm;
    private $promoRepository;
    
    function __construct(CreatePromoForm $createPromoForm, PromoRepository $promoRepository)
    {
         $this->createPromoForm = $createPromoForm;
         $this->promoRepository = $promoRepository;
    }


    // --------------------- CMS PROMO  -------------------------------


    public function show()
    {   
        $pagename = pageName();
        $promoList = $this->promoRepository->getAllPromos();
        return View::make('cms.promo.show', array('pagename' => $pagename, 'promoList' => $promoList));
    }


    public function updateStatus()
    {   
        $pagename = pageName();

         $input = Input::all();

         $this->promoRepository->updateStatus($input);
         Flash::success('Your promotion status has been successfully updated'); //confirmation msg

        $promoList = $this->promoRepository->getAllPromos();
        return View::make('cms.promo.show', array('pagename' => $pagename, 'promoList' => $promoList));
    }


    public function createPromo()
    {   
        $pagename = pageName();
        return View::make('cms.promo.create', array('pagename' => $pagename));
    }

    public function addPromo()
    {   
        $pagename = pageName();
        $input = Input::all();

        // explode the date the date to reformat it
        $date_array = explode("-", $input['daterange']);
        
        // reformat start date
        $tmp_start_date = new DateTime($date_array[0]);
        $start_date = date_format($tmp_start_date, 'Y-m-d');
        $start_date = $start_date." 00:00:00";

        //reformat end date
        $tmp_end_date = new DateTime($date_array[1]);
        $end_date = date_format($tmp_end_date, 'Y-m-d');
        $end_date = $end_date." 23:59:59";

        $this->createPromoForm->validate($input);

        $this->promoRepository->createPromo($input, $start_date, $end_date);
        Flash::success('The Promo has been successfully created'); //confirmation msg

        $promoList = $this->promoRepository->getAllPromos();
        return View::make('cms.promo.show', array('pagename' => $pagename, 'promoList' => $promoList));
    }


    

    // public function delete($news_id)
    // {   
    //     $pagename = pageName();

    //     $this->newsRepository->deleteNews($news_id);
    //     Flash::error('The News has been DELETED'); //Message confirming that the post has been sent to validator

    //     $newsList = $this->newsRepository->getAllNews();
    //     return View::make('cms.news.show', array('pagename' => $pagename, 'newsList' => $newsList));
    // }

}
