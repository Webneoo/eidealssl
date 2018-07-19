<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Media\MediasRepository;
use eideal\Products\ProductsRepository;
use eideal\Forms\CreateProductForm;
use eideal\Forms\EditProductForm;
use eideal\Forms\EditCodeProductForm;
use Illuminate\Support\Facades\Session;
use eideal\Users\UserRepository;


class ProductController extends \BaseController {


    private $mediasRepository;
    private $productsRepository;
    private $createProductForm;
    private $editProductForm;
    private $editCodeProductForm;
    private $userRepository;

    function __construct(MediasRepository $mediasRepository, ProductsRepository $productsRepository, 
                         CreateProductForm $createProductForm, EditProductForm $editProductForm, 
                         EditCodeProductForm $editCodeProductForm, UserRepository $userRepository)
    {
       $this->mediasRepository = $mediasRepository;
       $this->productsRepository = $productsRepository;
       $this->createProductForm = $createProductForm;
       $this->editProductForm = $editProductForm;
       $this->editCodeProductForm = $editCodeProductForm;
       $this->userRepository = $userRepository;
    }

	public function index($id)
	{  
        // save the last session of the product in order to return to the same product when clicking "continue shopping" in the cart list
        Session::put('product_id', $id);

        $pagename = pageName();
         $input = Input::all(); 
        // select the dynamic sidebar menu
        $categoryList = $this->productsRepository->getAllCategory();
        $i=1;
        foreach ($categoryList as $c)
        {  
           $category_tab[$i] = $c->title;
           $category_id_tab[$i] = $c->category_id;
         
            $subcategoryList = $this->productsRepository->getSubcategory($category_id_tab[$i]);
            $j=1;
            foreach ($subcategoryList as $s)
            {  
               $subcategory_tab[$i][$j] = $s->title;
               $subcategory_id_tab[$i][$j] = $s->sub_category_id;
               $j++;
            }
          $subcategory_counter[$i]=$j-1;  
          $i++;
        }


        // select the products by subcategory id 

        $productsList = $this->productsRepository->getAllProductsPerSubcategory($id);

        // get the info of the subcategory from its id
        $subcategory_info = $this->productsRepository->getSubcategoryFromSubcategory_id($id);
     
         // if the product is liquid
        if(isset($input['submit_liquid_product']))
        {  
            //if the user is online
            if(!Auth::check())
            {   
             
                $alert_msg = '\nThank you for your interest in our products.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nPlease sign in to proceed.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";

                return View::make('signin.index', array('pagename' => $pagename));         
            }

            else
            {   
                $liquid_product_id = $input['liquid_product_id'];
                $user_id = Session::get('user_id');


                $liquid_product_info = $this->productsRepository->getProductInfoFromId($liquid_product_id);
                $user_info = $this->userRepository->getUserInfoById($user_id);


                $name = $user_info[0]->firstname. ' '.$user_info[0]->lastname;
                $username = $user_info[0]->username;
                $email = $user_info[0]->email;
                $phone = $user_info[0]->phone;
                $country = $user_info[0]->country;
                $city = $user_info[0]->city;
                $address = $user_info[0]->address;

                $code = $liquid_product_info[0]->code;
                $product_name = $liquid_product_info[0]->title;
              

               
                Mail::send('emails.liquid-product', array('user_id' => $user_id, 'name' => $name, 'username' => $username, 'email' => $email, 'phone' => $phone, 'country' => $country, 'liquid_product_id' => $liquid_product_id, 'code' => $code, 'product_name' => $product_name, 'city' => $city, 'address' => $address), 
                        function($message) use ($email)
                    {
                        $message->from($email, 'Eideal website')->subject('Liquid product email');
                        $message->to('ecommerce@eideal.com');
                    });

              $alert_msg = 'Dear '.Session::get('firstname').',\n\nThank you for your interest in our products.\nYour inquiry is well received.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nOne of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status and delivery options and itinerary.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";          
            }


        }


        return View::make('product.index', 
                array('pagename' => $pagename, 'categoryList' => $categoryList, 
                        'category_tab' => $category_tab, 'i' => $i, 
                        'subcategory_tab' => $subcategory_tab, 
                        'subcategory_counter' => $subcategory_counter, 
                        'subcategory_id_tab' => $subcategory_id_tab, 
                        'productsList' => $productsList,
                        'subcategory_info' => $subcategory_info, 
                        'id' => $id));

	}



    public function allProducts()
    { 
        $pagename = pageName();
        $input = Input::all(); 
        // select the dynamic sidebar menu
        $categoryList = $this->productsRepository->getAllCategory();
        $i=1;
        foreach ($categoryList as $c)
        {  
           $category_tab[$i] = $c->title;
           $category_id_tab[$i] = $c->category_id;
         
            $subcategoryList = $this->productsRepository->getSubcategory($category_id_tab[$i]);
            $j=1;
            foreach ($subcategoryList as $s)
            {  
               $subcategory_tab[$i][$j] = $s->title;
               $subcategory_id_tab[$i][$j] = $s->sub_category_id;
               $j++;
            }
          $subcategory_counter[$i]=$j-1;  
          $i++;
        }

        // get all the subcategory in the database
        $all_subcategoryList = $this->productsRepository->getAllSubcategoryOrderedByDate();
        
        // set $id = 0 for the sidebar (to highlight the selected page)
        $id = 0;

        return View::make('product.allProducts', 
                array('pagename' => $pagename, 'categoryList' => $categoryList, 
                        'category_tab' => $category_tab, 'i' => $i, 
                        'subcategory_tab' => $subcategory_tab, 
                        'subcategory_counter' => $subcategory_counter, 
                        'subcategory_id_tab' => $subcategory_id_tab,
                        'all_subcategoryList' => $all_subcategoryList,
                        'id' => $id
                        ));
    }
    


  // products returned after a search via post

  public function productSearch()
  {  
        $id = 1;
        // save the last session of the product in order to return to the same product when clicking "continue shopping" in the cart list
        Session::put('product_id', $id);

        
        $pagename = pageName();
         $input = Input::all();
        // select the dynamic sidebar menu
        $categoryList = $this->productsRepository->getAllCategory();
        $i=1;
        foreach ($categoryList as $c)
        {  
           $category_tab[$i] = $c->title;
           $category_id_tab[$i] = $c->category_id;
         
            $subcategoryList = $this->productsRepository->getSubcategory($category_id_tab[$i]);
            $j=1;
            foreach ($subcategoryList as $s)
            {  
               $subcategory_tab[$i][$j] = $s->title;
               $subcategory_id_tab[$i][$j] = $s->sub_category_id;
               $j++;
            }
          $subcategory_counter[$i]=$j-1;  
          $i++;
        }


        // select the products by subcategory id 

        $productsList = $this->productsRepository->getAllProductsFromSearch($input['sequence']);

        // get the info of the subcategory from its id
        $subcategory_info = $this->productsRepository->getSubcategoryFromSubcategory_id($id);
       
         // if the product is liquid
        if(isset($input['submit_liquid_product']))
        {  
            //if the user is offline
            if(!Auth::check())
            {   
             
                $alert_msg = '\nThank you for your interest in our products.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nPlease sign in to proceed.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";

                return View::make('signin.index', array('pagename' => $pagename));         
            }


            else
            {   

                $liquid_product_id = $input['liquid_product_id'];
                $user_id = Session::get('user_id');


                $liquid_product_info = $this->productsRepository->getProductInfoFromId($liquid_product_id);
                $user_info = $this->userRepository->getUserInfoById($user_id);


                $name = $user_info[0]->firstname. ' '.$user_info[0]->lastname;
                $username = $user_info[0]->username;
                $email = $user_info[0]->email;
                $phone = $user_info[0]->phone;
                $country = $user_info[0]->country;
                $city = $user_info[0]->city;
                $address = $user_info[0]->address;

                $code = $liquid_product_info[0]->code;
                $product_name = $liquid_product_info[0]->title;
              

               
                 Mail::send('emails.liquid-product', array('user_id' => $user_id, 'name' => $name, 'username' => $username, 'email' => $email, 'phone' => $phone, 
                                                           'country' => $country, 'liquid_product_id' => $liquid_product_id, 'code' => $code, 
                                                           'product_name' => $product_name, 'city' => $city, 'address' => $address), 
                        function($message) use ($email)
                    {
                        $message->from($email, 'Eideal website')->subject('Liquid product email');
                        $message->to('ecommerce@eideal.com');
                    });


               $alert_msg = 'Dear '.Session::get('firstname').',\n\nThank you for your interest in our products.\nYour inquiry is well received.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nOne of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status and delivery options and itinerary.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";      
            }


        }


        return View::make('product.index', 
                array('pagename' => $pagename, 'categoryList' => $categoryList, 
                        'category_tab' => $category_tab, 'i' => $i, 
                        'subcategory_tab' => $subcategory_tab, 
                        'subcategory_counter' => $subcategory_counter, 
                        'subcategory_id_tab' => $subcategory_id_tab, 
                        'productsList' => $productsList,
                        'subcategory_info' => $subcategory_info, 
                        'id' => $id,
                        'sequence' => $input['sequence'],
                        'fromSearch' => true));

  }


  








    public function indexOrder($id, $order)
    {  
        // save the last session of the product in order to return to the same product when clicking "continue shopping" in the cart list
        Session::put('product_id', $id);

        $pagename = pageName();

        // select the dynamic sidebar menu
        $categoryList = $this->productsRepository->getAllCategory();
        $i=1;
        foreach ($categoryList as $c)
        {  
           $category_tab[$i] = $c->title;
           $category_id_tab[$i] = $c->category_id;
         
            $subcategoryList = $this->productsRepository->getSubcategory($category_id_tab[$i]);
            $j=1;
            foreach ($subcategoryList as $s)
            {  
               $subcategory_tab[$i][$j] = $s->title;
               $subcategory_id_tab[$i][$j] = $s->sub_category_id;
               $j++;
            }
          $subcategory_counter[$i]=$j-1;  
          $i++;
        }


        // select the products by subcategory id 

        $productsList = $this->productsRepository->getAllProductsPerSubcategoryOrder($id, $order);

        // get the info of the subcategory from its id
        $subcategory_info = $this->productsRepository->getSubcategoryFromSubcategory_id($id);

        return View::make('product.index', 
                array('pagename' => $pagename, 'categoryList' => $categoryList, 
                        'category_tab' => $category_tab, 'i' => $i, 
                        'subcategory_tab' => $subcategory_tab, 
                        'subcategory_counter' => $subcategory_counter, 
                        'subcategory_id_tab' => $subcategory_id_tab, 
                        'productsList' => $productsList, 
                        'id' => $id,
                        'order' => $order,
                        'subcategory_info' => $subcategory_info));
    }



    public function productDetails($product_id, $id, $quoteCurrency)
    {  

        // save the last session of the product in order to return to the same product when clicking "continue shopping" in the cart list
        Session::put('product_id', $id);


        $pagename = pageName();
        $input = Input::all(); 
        // select the dynamic sidebar menu
        $categoryList = $this->productsRepository->getAllCategory();
        $i=1;
        foreach ($categoryList as $c)
        {  
           $category_tab[$i] = $c->title;
           $category_id_tab[$i] = $c->category_id;
         
            $subcategoryList = $this->productsRepository->getSubcategory($category_id_tab[$i]);
            $j=1;
            foreach ($subcategoryList as $s)
            {  
               $subcategory_tab[$i][$j] = $s->title;
               $subcategory_id_tab[$i][$j] = $s->sub_category_id;
               $j++;
            }
          $subcategory_counter[$i]=$j-1;  
          $i++;
        }

        // select the products info from the product_id
        
        $product_info = $this->productsRepository->getProductInfoFromId($product_id);

        

        // if the product is liquid
        if(isset($input['submit_liquid_product']))
        {   
            //if the user is online
            if(!Auth::check())
            {   

                $alert_msg = '\nThank you for your interest in our products.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nPlease sign in to proceed.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";

                return View::make('signin.index', array('pagename' => $pagename));         
            }


            else
            {   
                $liquid_product_id = $input['liquid_product_id'];
                $user_id = Session::get('user_id');

                $liquid_product_info = $this->productsRepository->getProductInfoFromId($liquid_product_id);
                $user_info = $this->userRepository->getUserInfoById($user_id);
    
                $name = $user_info[0]->firstname.' '.$user_info[0]->lastname;
                $username = $user_info[0]->username;
                $email = $user_info[0]->email;
                $phone = $user_info[0]->phone;
                $country = $user_info[0]->country;
                $city = $user_info[0]->city;
                $address = $user_info[0]->address;

                $code = $liquid_product_info[0]->code;
                $product_name = $liquid_product_info[0]->title;
              

               
                 Mail::send('emails.liquid-product', array('user_id' => $user_id, 'name' => $name, 'username' => $username, 'email' => $email, 'phone' => $phone, 
                                                           'country' => $country, 'liquid_product_id' => $liquid_product_id, 'code' => $code, 
                                                           'product_name' => $product_name, 'city' => $city, 'address' => $address), 
                        function($message) use ($email)
                    {
                        $message->from($email, 'Eideal website')->subject('Liquid product email');
                        $message->to('ecommerce@eideal.com');
                    });


                $alert_msg = 'Dear '.Session::get('firstname').',\n\nThank you for your interest in our products.\nYour inquiry is well received.\nThe selected product is a liquid product and cannot be added to the cart due to shipping restrictions to certain countries.\nOne of our team members will get in touch with you ASAP from 9am-6pm, Sunday through Thursday to further update you about your order’s status and delivery options and itinerary.\nRegards';
                
                echo "<script type=\"text/javascript\">alert('".$alert_msg."');</script>";      
            }


        }

        //get the list of medias inside the product details page
        $mediaList = $this->mediasRepository->getAllMediasListByProductId($product_id);


        // get 4 related products 
        $related_products = $this->productsRepository->getFourRandomRelatedProducts($id, $product_id);

        return View::make('product.productDetails', 
               array('pagename' => $pagename, 'mediaList' => $mediaList, 
                     'categoryList' => $categoryList, 'category_tab' => $category_tab, 
                     'i' => $i, 'subcategory_tab' => $subcategory_tab, 
                     'subcategory_counter' => $subcategory_counter, 
                     'subcategory_id_tab' => $subcategory_id_tab, 
                     'product_info' => $product_info, 
                     'id' => $id,
                     'product_id' => $product_id,
                     'quoteCurrency' => $quoteCurrency,
                     'related_products' => $related_products));
    }



    // -------------- CMS PRODUCTS MANAGEMENT --------------------


    public function show()
    {   
        $pagename = pageName();

        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.products.show', array('pagename' => $pagename, 'productsList' => $productsList));
    }

    public function add()
    {   
        $pagename = pageName();

        $input = Input::all();
        $this->createProductForm->validate($input);


        //image 1
        if(Input::hasFile('product_img_1'))
        {
            $file = Input::file('product_img_1');
            $file_name = time() . '-1-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_1'] = $real_path;
        }  

        //image 2
        if(Input::hasFile('product_img_2'))
        {
            $file = Input::file('product_img_2');
            $file_name = time() . '-2-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_2'] = $real_path;
        }

        else
           $input['product_img_2'] = '';


        //image 3
        if(Input::hasFile('product_img_3'))
        {
            $file = Input::file('product_img_3');
            $file_name = time() . '-3-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_3'] = $real_path;
        }

         else
           $input['product_img_3'] = '';


        //image 4
        if(Input::hasFile('product_img_4'))
        {
            $file = Input::file('product_img_4');
            $file_name = time() . '-4-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_4'] = $real_path;
        }

        else
           $input['product_img_4'] = '';

        if(!isset($input['liquid_product']) || $input['liquid_product'] != 1)
            $input['liquid_product'] = 0;



       $this->productsRepository->createProduct($input);
       Flash::success('The product has been CREATED'); //Message confirming that the post has been sent to validator

       $subcategoryList = $this->productsRepository->getAllSubcategory();
       return View::make('cms.products.create', array('pagename' => $pagename, 'subcategoryList' => $subcategoryList));
    }

     public function create()
     {   
         $pagename = pageName();

         $subcategoryList = $this->productsRepository->getAllSubcategory();
         return View::make('cms.products.create', array('pagename' => $pagename, 'subcategoryList' => $subcategoryList));
     }

    public function edit($product_id)
    {   
        $pagename = pageName();

        $subcategoryList = $this->productsRepository->getAllSubcategory();
        $product_info = $this->productsRepository->getProductInfoFromId($product_id);
        return View::make('cms.products.edit', array('pagename' => $pagename, 'product_info' => $product_info, 'subcategoryList' => $subcategoryList));
    }

    public function update($product_id)
    {   
        $pagename = pageName();

        $input = Input::all();

        $product_info = $this->productsRepository->getProductInfoFromId($product_id);
        foreach($product_info as $p)
        {
            $product_code = $p->code;
        }

        if($product_code == $input['product_code'])
        $this->editProductForm->validate($input);

        else if($product_code != $input['product_code'])
        $this->editCodeProductForm->validate($input);   



        //image 1
        if(Input::hasFile('product_img_1'))
        {
            $file = Input::file('product_img_1');
            $file_name = time() . '-1-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_1'] = $real_path;
        }

        else // If no image has been selected we must keep the old image in the database
        {
            $product_info = $this->productsRepository->getProductInfoFromId($product_id);
            foreach ($product_info as $p)
            {
            $input['product_img_1'] = $p->img1;
            }
        }


        //image 2
        if(Input::hasFile('product_img_2'))
        {
            $file = Input::file('product_img_2');
            $file_name = time() . '-2-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_2'] = $real_path;
        }

        else // If no image has been selected we must keep the old image in the database
        {
            $product_info = $this->productsRepository->getProductInfoFromId($product_id);
            foreach ($product_info as $p)
            {
            $input['product_img_2'] = $p->img2;
            }
        }


        if(isset($input['product_img_2_checkbox']) && $input['product_img_2_checkbox'] == 1) // if I selected to remove the image
        {
          $input['product_img_2'] = '';
        }



        //image 3
        if(Input::hasFile('product_img_3'))
        {
            $file = Input::file('product_img_3');
            $file_name = time() . '-3-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_3'] = $real_path;
        }

        else // If no image has been selected we must keep the old image in the database
        {
            $product_info = $this->productsRepository->getProductInfoFromId($product_id);
            foreach ($product_info as $p)
            {
            $input['product_img_3'] = $p->img3;
            }
        }


        if(isset($input['product_img_3_checkbox']) && $input['product_img_3_checkbox'] == 1) // if I selected to remove the image
        {
          $input['product_img_3'] = '';
        }


        //image 4
        if(Input::hasFile('product_img_4'))
        {
            $file = Input::file('product_img_4');
            $file_name = time() . '-4-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products/', $file_name);
            $input['product_img_4'] = $real_path;
        }

        else // If no image has been selected we must keep the old image in the database
        {
            $product_info = $this->productsRepository->getProductInfoFromId($product_id);
            foreach ($product_info as $p)
            {
            $input['product_img_4'] = $p->img4;
            }
        }


        if(isset($input['product_img_4_checkbox']) && $input['product_img_4_checkbox'] == 1) // if I selected to remove the image
        {
          $input['product_img_4'] = '';
        }




        if(!isset($input['liquid_product']) || $input['liquid_product'] != 1)
            $input['liquid_product'] = 0;

        $this->productsRepository->updateProduct($product_id, $input);
        Flash::success('The product has been UPDATED'); //Message confirming that the post has been sent to validator

        $subcategoryList = $this->productsRepository->getAllSubcategory();
        $product_info = $this->productsRepository->getProductInfoFromId($product_id);
        return View::make('cms.products.edit', array('pagename' => $pagename, 'product_info' => $product_info, 'subcategoryList' => $subcategoryList));
    }

    public function delete($product_id)
    {   
        $pagename = pageName();

        $this->productsRepository->deleteProduct($product_id);
        Flash::error('The product has been DELETED'); //Message confirming that the product has been sent to validator

        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.products.show', array('pagename' => $pagename, 'productsList' => $productsList));
    }



  // -------------- CMS BEST SELLER --------------------

    public function showBestSeller()
    {   dd('test');
        $pagename = pageName();
        $productsList = $this->productsRepository->getAllProductsList();   

        return View::make('cms.products.showBestSeller', array('pagename' => $pagename, 'productsList' => $productsList));
    }


    public function changeBestSeller()
    {   
        $pagename = pageName();
          
  

        if(!empty($_POST['best_seller'])) 
        {
             foreach($_POST['best_seller'] as $b) {

                $bs_array[] = $b; // filling the array with the selected products
             }
        }


        $this->productsRepository->resetAllBestSeller();   // Reset all the best seller of the products to 0
    
        // Set to 1 the best_seller field of the the selected products 
        $this->productsRepository->updateBestSeller($bs_array[0], $bs_array[1], $bs_array[2], $bs_array[3]);
        $productsList = $this->productsRepository->getAllProductsList(); 

        Flash::success('Your best seller products have been updated');
        return View::make('cms.products.showBestSeller', array('pagename' => $pagename, 'productsList' => $productsList));

    }


    // -------------- CMS PRODUCT OF THE MONTH --------------------


     public function showProductOfTheMonth()
    {   
        $pagename = pageName();
        $productsList = $this->productsRepository->getAllProductsMonth();   

        return View::make('cms.products.showProductOfTheMonth', array('pagename' => $pagename, 'productsList' => $productsList));
    }


    public function changeProductOfTheMonth()
    {   
        $pagename = pageName();
          
       
        $old_product_arr = $this->productsRepository->selectProductOfTheMonth();   // select the old product of the month
        
        foreach ($old_product_arr as $o)
        {
            $old_product = $o->product_id;
        }

        $product_id = $_POST['product_of_the_month'];
       
        $this->productsRepository->updateProductOfTheMonth($old_product, $product_id);
        
         $productsList = $this->productsRepository->getAllProductsMonth();    
         Flash::success('Your product of the month has been updated');
         return View::make('cms.products.showProductOfTheMonth', array('pagename' => $pagename, 'productsList' => $productsList));
    }



    // -------------- CMS PRODUCTS CATEGORY  --------------------


    public function showProductsCategory()
    {   
        $pagename = pageName();
        $products_category = $this->productsRepository->getAllSubcategoryOrderedByDate();   

        return View::make('cms.products.showProductsCategory', array('pagename' => $pagename, 'products_category' => $products_category));
    }


    public function editProductCategory($sub_category_id)
    {
        $pagename = pageName();

        $productCategoryDetails = $this->productsRepository->getSubcategoryFromSubcategory_id($sub_category_id);   

        return View::make('cms.products.editProductsCategory', array('pagename' => $pagename, 'productCategoryDetails' => $productCategoryDetails));
    }


    public function updateProductCategory($sub_category_id)
    {
        $pagename = pageName();
        
        $input = Input::all();


        if(Input::hasFile('product_category_img'))
        {
            $file = Input::file('product_category_img');
            $file_name = time(). $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/products_category/', $file_name);
            $input['product_category_img'] = $real_path;
        }

        else // If no image has been selected we must keep the old image in the database
        {
            $productCategoryDetails = $this->productsRepository->getSubcategoryFromSubcategory_id($sub_category_id);  
            $input['product_category_img'] = $productCategoryDetails->image;  
        }

       
    
        // Set to 1 the best_seller field of the the selected products 
        $this->productsRepository->updateProductCategory($sub_category_id, $input);
         $productCategoryDetails = $this->productsRepository->getSubcategoryFromSubcategory_id($sub_category_id);  

        Flash::success('The selected category has been successfully updated');
        return View::make('cms.products.editProductsCategory', array('pagename' => $pagename, 'productCategoryDetails' => $productCategoryDetails));
    }


    


}
