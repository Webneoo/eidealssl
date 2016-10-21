<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Promo\PromoRepository;
use eideal\Products\ProductsRepository;
use eideal\Forms\CreatePromoForm;
use eideal\Forms\CreatePromoProductForm;



class PromoController extends \BaseController {


    private $createPromoForm;
    private $promoRepository;
    private $productsRepository;
    private $createPromoProductForm;
    
    function __construct(CreatePromoForm $createPromoForm, PromoRepository $promoRepository, ProductsRepository $productsRepository, CreatePromoProductForm $createPromoProductForm)
    {
         $this->createPromoForm = $createPromoForm;
         $this->promoRepository = $promoRepository;
         $this->productsRepository = $productsRepository;
         $this->createPromoProductForm = $createPromoProductForm;
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



    // --------------------- CMS PROMO PER PRODUCT  -------------------------------


    public function showPromoProducts()
    {   
        $pagename = pageName();

        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.promo.show-promo-products', array('pagename' => $pagename, 'productsList' => $productsList));
    }


    public function createPromoForProduct($product_id)
    {   
        $pagename = pageName();
        $input = Input::all();

        $product_info = $this->productsRepository->getProductInfoFromId($product_id);

        return View::make('cms.promo.create-promo-product', array('pagename' => $pagename, 'product_info' => $product_info));
    }


    public function addPromoForProduct()
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

        $this->createPromoProductForm->validate($input);

        $this->promoRepository->createPromoForProducts($input, $start_date, $end_date);
        Flash::success('The Promo has been successfully created'); //confirmation msg

        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.promo.show-promo-products', array('pagename' => $pagename, 'productsList' => $productsList));
    }


    public function stopPromoForProduct()
    {   
        $pagename = pageName();
        $input = Input::all();

        $this->promoRepository->stopPromoForProducts($input);
        Flash::error('The Promo has been stopped'); //confirmation msg

        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.promo.show-promo-products', array('pagename' => $pagename, 'productsList' => $productsList));

    }

    
    

}
