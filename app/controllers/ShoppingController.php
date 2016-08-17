<?php

use Illuminate\Support\Facades\View;
use eideal\Products\ProductsRepository;


class ShoppingController extends \BaseController {

    private $userRepository;

    function __construct(ProductsRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }


    public function show()
    {   
        $pagename = pageName();
        $transactions = $this->productsRepository->getAllTransactions();
        return View::make('cms.shopping.show', array('pagename' => $pagename, 'transactions' => $transactions));
    }


     public function display($order_id)
    {   
        $pagename = pageName();

        // get the info of the order 
        $order_id_info = $this->productsRepository->getOrderIdInfo($order_id);

        // get the products related to the cart 
        $products = $this->productsRepository->getProductsFromOrderId($order_id);


        return View::make('cms.shopping.display', array('pagename' => $pagename, 'order_id_info' => $order_id_info, 'products' => $products));
    }



    public function updateCashOnDelivery()
    {   
        $pagename = pageName();

        $input = Input::all(); 

        // update the status of the order_id from cash on delivery (2) to paid on delivery (5)
        $this->productsRepository->updateOrderStatusId($input['order_id'], 5);

        $transactions = $this->productsRepository->getAllTransactions();

        return View::make('cms.shopping.show', array('pagename' => $pagename, 'transactions' => $transactions));
    }



    public function paypalValidation($order_id, $order_status_id)
    {
        $pagename = pageName();

         $this->productsRepository->updateOrderStatusId($order_id, $order_status_id);

         $transactions = $this->productsRepository->getAllTransactions();

        return View::make('cms.shopping.show', array('pagename' => $pagename, 'transactions' => $transactions));
    }

    




}
