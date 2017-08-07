<?php



use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Home\HomeRepository;
use eideal\Products\ProductsRepository;
use eideal\Forms\CreateStoreForm;
use eideal\Forms\CreateSlideshowForm;
use eideal\Media\MediasRepository;
use Illuminate\Support\Facades\Session;
use eideal\Users\UserRepository;
use eideal\Brands\BrandsRepository;
use eideal\Forms\NewslettersForm;



class HomeController extends \BaseController {

    
     private $homeRepository;
     private $createStoreForm;
     private $productsRepository;
     private $createSlideshowForm;
     private $mediasRepository;
     private $userRepository;
     private $brandsRepository;
     private $newslettersForm;

    function __construct(HomeRepository $homeRepository, MediasRepository $mediasRepository,
                         CreateStoreForm $createStoreForm, ProductsRepository $productsRepository,
                         CreateSlideshowForm $createSlideshowForm, UserRepository $userRepository, BrandsRepository $brandsRepository, NewslettersForm $newslettersForm)
    {
        $this->homeRepository = $homeRepository;
        $this->createStoreForm = $createStoreForm;
        $this->productsRepository = $productsRepository;
        $this->createSlideshowForm = $createSlideshowForm;
        $this->mediasRepository = $mediasRepository;
        $this->userRepository = $userRepository;
        $this->brandsRepository = $brandsRepository;
        $this->newslettersForm = $newslettersForm;
    }

 public function index()
 {  
        $pagename = pageName();
        $input = Input::all(); 


        $slideShowList = $this->homeRepository->showSlideshow();
       

        $bestSeller = $this->homeRepository->getBestSellerProducts();

        $productMonth = $this->productsRepository->selectProductOfTheMonth();


        $mediaList = $this->mediasRepository->getAllMediasListByProductId($productMonth[0]->product_id);

        $brandsImages = $this->brandsRepository->getAllBrandsImages();
        
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

        $newsletters_info = $this->homeRepository->getNewsLettersInfo();

        return View::make('Home.index', array('pagename' => $pagename, 'slideShowList' => $slideShowList, 'mediaList' => $mediaList, 'bestSeller' => $bestSeller , 'productMonth' => $productMonth, 'brandsImages' => $brandsImages, 'newsletters_info' => $newsletters_info));
 }


 public function newlettersSignup()
 { 
    $pagename = pageName();
        $input = Input::all(); 

        // ========================== NEWSLETTERS SIGN UP PROCESS =============================

        $this->newslettersForm->validate($input);
    
        $email_in_user_exist = $this->homeRepository->getUsersNewslettersEmail($input['email']);

        // if the email exist in the user table
        if(!empty($email_in_user_exist))
        { 
          // if the user is already subscribed for newsletters
          if($email_in_user_exist[0]->newsletters == 1)
            Flash::success('You are already subscribed to the newsletters');

          // else user exist in the user table but not subscribe to the news letters
          else
          { 
            // update the value of the news letters to 1 
            $this->homeRepository->updateNewsletterStatus($input['email']);
           
            // send an email to the subscribed user
            $email = $input['email'];

            // email for the subscriber + bcc
             Mail::send('emails.newsletters', array('email' => $input['email']),  function($message) use ($email)
               {   
                  $emails = array();

                  $emails[0] = $email;
                  //$emails[1] = 'ecommerce@eideal.com';

                  foreach($emails as $e)
                  {
                      $message->from('ecommerce@eideal.com', 'EIDEAL')->subject('EIDEAL | Thanks for subscribing');
                      $message->to($e);
                  }

                   $headers = $message->getHeaders();
                   $headers->addTextHeader('X-MC-PreserveRecipients', 'false');
                });


             // email for the admin
             Mail::send('emails.newsletters-admin', array('email' => $input['email']),  function($message) use ($email)
                {
                    $message->from('noreply@eideal.com', 'EIDEAL website')->subject('EIDEAL | Thanks for subscribing');
                    $message->to('ecommerce@eideal.com');
                });


            Flash::success('You have been successfully subscribed to the newsletters');
          }

        }

        // else the email is not in the user table then check in the ta_newsletters_email table
        else
        {
           $email_in_newsletters_exist = $this->homeRepository->CheckEmailExistInNewsletters($input['email']);

           // if the email exist in the newletters table
           if($email_in_newsletters_exist)
            Flash::success('You are already subscribed to the newsletters');

          else
          {
            // insert the email in the newsletters table
             $this->homeRepository->insertNewsletterEmail($input['email']);

              // send an email to the subscribed user + bcc 
            $email = $input['email'];

             Mail::send('emails.newsletters', array('email' => $input['email']), function($message) use ($email) 
                {   
                  $emails = array();

                  $emails[0] = $email;
                  //$emails[1] = 'ecommerce@eideal.com';

                  foreach($emails as $e)
                  {
                      $message->from('ecommerce@eideal.com', 'EIDEAL')->subject('EIDEAL | Thanks for subscribing');
                      $message->to($e);
                  }

                   $headers = $message->getHeaders();
                   $headers->addTextHeader('X-MC-PreserveRecipients', 'false');
                });

             // email for the admin
             Mail::send('emails.newsletters-admin', array('email' => $input['email']),  function($message) use ($email)
                {
                    $message->from('noreply@eideal.com', 'EIDEAL website')->subject('EIDEAL | Thanks for subscribing');
                    $message->to('ecommerce@eideal.com');
                });


             Flash::success('You have been successfully subscribed to the newsletters');
          }

        }

        // ======================= END NEWSLETTERS SIGN UP PROCESS =============================



        $slideShowList = $this->homeRepository->showSlideshow();
       

        $bestSeller = $this->homeRepository->getBestSellerProducts();

        $productMonth = $this->productsRepository->selectProductOfTheMonth();


        $mediaList = $this->mediasRepository->getAllMediasListByProductId($productMonth[0]->product_id);

        $brandsImages = $this->brandsRepository->getAllBrandsImages();
        
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

        $newsletters_info = $this->homeRepository->getNewsLettersInfo();

        return View::make('Home.index', array('pagename' => $pagename, 'slideShowList' => $slideShowList, 'mediaList' => $mediaList, 'bestSeller' => $bestSeller , 'productMonth' => $productMonth, 'brandsImages' => $brandsImages, 'newsletters_info' => $newsletters_info));

    }

    public function aboutUs()
    {   
         $pagename = pageName();

         $aboutUs = $this->homeRepository->getAboutUs();

        return View::make('Home.aboutUs', array('pagename' => $pagename, 'aboutUs' => $aboutUs));
    }

    public function whereToBuy($country_id)
    {   
        $pagename = pageName();

        //get the list of all the countries 
        $country_list = $this->homeRepository->getAllCountries();

        //get the list of all the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        

        //get the list of all the regions 
        $all_region_list = $this->homeRepository->getAllRegions();
        

        $store_info = $this->homeRepository->getStoreList();



        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 


        return View::make('Home.whereToBuy', array('pagename' => $pagename, 'store_info' => $store_info, 'country_list' => $country_list, 
                                                   'region_list'=> $region_list, 'all_region_list' => $all_region_list));

    }



    public function whereToBuySearch($country_id)
    {   

        $input = Input::all();

        $pagename = pageName();

        //get the list of al the countries 
        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);

        //get the list of all the regions 
        $all_region_list = $this->homeRepository->getAllRegions();
        
        //select all the store locator with no filter
        if($input['country_post'] == 0 && $input['region_post'] == 0)
        $store_info = $this->homeRepository->getStoreList();

        //select all the store locator with only region_id
        else if($input['country_post'] == 0 && $input['region_post'] != 0)
        $store_info = $this->homeRepository->getStoreListFromRegionId($input['region_post']);

        //select all the store locator related to the selected country
        else if($input['country_post'] != 0 && $input['region_post'] == 0)
        {
            $store_info = $this->homeRepository->getStoreListFromCountryId($input['country_post']);
        }

        //select all the store locator related to the selected region
        else if($input['country_post'] != 0 && $input['region_post'] != 0)
        {
            $store_info = $this->homeRepository->getStoreListFromRegionId($input['region_post']);
        }


        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 


        return View::make('Home.whereToBuy', array('pagename' => $pagename, 'store_info' => $store_info, 
                          'country_list' => $country_list, 'region_list'=> $region_list, 'all_region_list' => $all_region_list));

    }

     public function eteam()
    {   
        $pagename = pageName();

        $eteam = $this->homeRepository->getEteam();
        return View::make('Home.eteam', array('pagename' => $pagename, 'eteam' => $eteam));
    }






    // -------------- CMS HOME MANAGEMENT --------------------

    public function showSlideShow()
    {   
        $pagename = pageName();

        $slideShowList = $this->homeRepository->showSlideshow();
        return View::make('cms.home.showSlideShow', array('pagename' => $pagename, 'slideShowList' => $slideShowList));
    }

    public function createSlideShow()
    {   
         $pagename = pageName();
        return View::make('cms.home.createSlideShow', array('pagename' => $pagename));
    }

    public function addSlideShow()
    {   
         $pagename = pageName();
         $input = Input::all(); 
         $this->createSlideshowForm->validate($input);

         if(Input::hasFile('slideshow_image'))
        {
            $file = Input::file('slideshow_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/slideshow/', $file_name);
            $input['slideshow_image'] = $real_path;
        }

        $this->homeRepository->addSlideshow($input);
        Flash::success('Your image has been CREATED'); //Message confirming that the post has been sent to validator

        return View::make('cms.home.createSlideShow', array('pagename' => $pagename));
    }

    public function editSlideShow($image_id)
    {   
        $pagename = pageName();
        $slide_show_info = $this->homeRepository->getSlideShowFromId($image_id);
        return View::make('cms.home.editSlideShow', array('pagename' => $pagename, 'slide_show_info' => $slide_show_info));
    }

    public function updateSlideShow($image_id)
    {    
         $pagename = pageName();
         $input = Input::all();
         $this->createSlideshowForm->validate($input);
        
         if(Input::hasFile('slideshow_image'))
        {
            $file = Input::file('slideshow_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/slideshow/', $file_name);
            $input['slideshow_image'] = $real_path;
        }
        else // If no image has been selected we must keep the old image in the database
        {
            $slide_show_info = $this->homeRepository->getSlideShowFromId($image_id);
            foreach ($slide_show_info as $s)
            {
                $input['slideshow_image'] = $s->img_url;
            }
        }
        
         $this->homeRepository->updateSlideshow($input, $image_id);
         Flash::success('Your image has been UPDATED'); //Message confirming that the post has been sent to validator

        $slide_show_info = $this->homeRepository->getSlideShowFromId($image_id);
        return View::make('cms.home.editSlideShow', array('pagename' => $pagename, 'slide_show_info' => $slide_show_info));
    }

    public function deleteSlideShow($image_id)
    {   
        $pagename = pageName();
        $this->homeRepository->deleteSlideShow($image_id);
        Flash::error('The select image has been DELETED'); //Message confirming that the post has been sent to validator

       $slideShowList = $this->homeRepository->showSlideshow();
        return View::make('cms.home.showSlideShow', array('pagename' => $pagename, 'slideShowList' => $slideShowList));
    }


     // -------------- CMS ABOUT US --------------------

  
    public function editAboutUs()
    {   
         $pagename = pageName();
         $aboutUs = $this->homeRepository->getAboutUs();

        return View::make('cms.home.editAboutUs', array('pagename' => $pagename, 'aboutUs' => $aboutUs));
    }

    public function updateAboutUs()
    {   
         $pagename = pageName();
         $input = Input::all();

         if(Input::hasFile('about_us_img'))
        {
            $file = Input::file('about_us_img');
            $file_name = time() . '-1-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/', $file_name);
            $input['about_us_img'] = $real_path;
        }
        else // If no image has been selected we must keep the old image in the database
        {
            $about_us = $this->homeRepository->getAboutUs();
            foreach ($about_us as $a)
            {
            $input['about_us_img'] = $a->img;
            }
        }

         $this->homeRepository->updateAboutUs($input);
         Flash::success('The about us content has been UPDATED'); //Message confirming that the post has been sent to validator

        $aboutUs = $this->homeRepository->getAboutUs();
        return View::make('cms.home.editAboutUs', array('pagename' => $pagename, 'aboutUs' => $aboutUs));
    }


    // --------------------- CMS WHERE TO BUY  -------------------------------



    public function show($country_id)
    {   
        $pagename = pageName();

        //get the list of al the countries 
        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        

        $store_info = $this->homeRepository->getStoreList();



        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 

        return View::make('cms.home.show', array('pagename' => $pagename, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));

    }



    public function showSearch($country_id)
    {   
        $pagename = pageName();


        $input = Input::all();

        $pagename = pageName();

        //get the list of al the countries 
        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        
        //select all the store locator with no filter
        if($input['country_post'] == 0)
        $store_info = $this->homeRepository->getStoreList();

        //select all the store locator related to the selected country
        else if($input['country_post'] != 0 && $input['region_post'] == 0)
        {
            $store_info = $this->homeRepository->getStoreListFromCountryId($input['country_post']);
        }

        //select all the store locator related to the selected region
        else if($input['country_post'] != 0 && $input['region_post'] != 0)
        {
            $store_info = $this->homeRepository->getStoreListFromRegionId($input['region_post']);
        }


        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 

          return View::make('cms.home.show', array('pagename' => $pagename, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));
    }

    public function create($country_id)
    {   
         $pagename = pageName();


        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        

        $store_info = $this->homeRepository->getStoreList();



        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 


        return View::make('cms.home.create', array('pagename' => $pagename, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));
    }

    public function add($country_id)
    {   
         $pagename = pageName();
         $input = Input::all();
         $this->createStoreForm->validate($input);
         $this->homeRepository->createStore($input);
        Flash::success('The store locator has been CREATED'); //Message confirming that the post has been sent to validator

        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        

        $store_info = $this->homeRepository->getStoreList();



        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 


        return View::make('cms.home.create', array('pagename' => $pagename, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));
    }

    public function edit($locator_id, $country_id)
    {   

        $pagename = pageName();


    
        $locator_info = $this->homeRepository->getLocatorInfoById($locator_id);

        
        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);

        $store_info = $this->homeRepository->getStoreList();


        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 



        return View::make('cms.home.edit', array('pagename' => $pagename, 'locator_info' => $locator_info, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));
    }

    public function update($locator_id, $country_id)
    {   
         $pagename = pageName();
         $input = Input::all();
         $this->createStoreForm->validate($input);
         $this->homeRepository->updateStore($locator_id, $input);
         Flash::success('The store information has been UPDATED'); //Message confirming that the post has been sent to validator

        $locator_info = $this->homeRepository->getLocatorInfoById($locator_id);


        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        

        $store_info = $this->homeRepository->getStoreList();


        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 

        return View::make('cms.home.show', array('pagename' => $pagename, 'locator_info' => $locator_info, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));
    }

    public function delete($locator_id, $country_id)
    {   
         $pagename = pageName();
        // $this->newsRepository->deleteNews($news_id);
        Flash::error('The store locator has been DELETED'); //Message confirming that the post has been sent to validator

        $this->homeRepository-> deleteStore($locator_id);
        
        $country_list = $this->homeRepository->getAllCountries();

        //get the list of al the region from country id 
        $region_list = $this->homeRepository->getRegionsFromCountryId($country_id);
        

        $store_info = $this->homeRepository->getStoreList();


        if (Request::ajax())
       {
          $region = $this->homeRepository->getRegionsFromCountryId($country_id);

          return Response::json( $region );
       } 

        return View::make('cms.home.show', array('pagename' => $pagename, 'store_info' => $store_info, 'country_list' => $country_list, 'region_list'=> $region_list));
    }



    public function showEteam()
    {   
        $pagename = pageName();

        $eteam = $this->homeRepository->getEteam();
        
        return View::make('cms.home.editEteam', array('pagename' => $pagename, 'eteam' => $eteam));
    }



    public function updateEteam()
    {   
         $pagename = pageName();
         $input = Input::all();

         if(Input::hasFile('eteam_img'))
        {
            $file = Input::file('eteam_img');
            $file_name = time() . '-1-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/', $file_name);
            $input['eteam_img'] = $real_path;
        }
        else // If no image has been selected we must keep the old image in the database
        {
            $eteam = $this->homeRepository->getEteam();
            foreach ($eteam as $e)
            {
            $input['eteam_img'] = $e->img;
            }
        }

         $this->homeRepository->updateEteam($input);
         Flash::success('The E-TEAM content has been UPDATED'); //Message confirming that the post has been sent to validator

        $eteam = $this->homeRepository->getEteam();
       return View::make('cms.home.editEteam', array('pagename' => $pagename, 'eteam' => $eteam));
    }



     public function editNewsLetters()
    {   
        $pagename = pageName();

        
        $newsletters_email_list = $this->homeRepository->getNewsLettersEmailsList();

        $newsletters_info = $this->homeRepository->getNewsLettersInfo();
        
        return View::make('cms.newsletters.edit', array('pagename' => $pagename, 'newsletters_info' => $newsletters_info, 'newsletters_email_list' => $newsletters_email_list));
    }


    public function updateNewsLetters()
    {   
        $pagename = pageName();
        $input = Input::all();

        $this->homeRepository->updateNewletters($input);
        Flash::success('Your newsletters info has been UPDATED');
        
        $newsletters_email_list = $this->homeRepository->getNewsLettersEmailsList();

        $newsletters_info = $this->homeRepository->getNewsLettersInfo();


        return View::make('cms.newsletters.edit', array('pagename' => $pagename, 'newsletters_info' => $newsletters_info, 'newsletters_email_list' => $newsletters_email_list));
    }


    

}
