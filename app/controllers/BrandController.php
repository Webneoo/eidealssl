<?php


use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Brands\BrandsRepository;
use eideal\Forms\CreateBrandForm;


class BrandController extends \BaseController {

    private $brandsRepository;
    private $createBrandForm;


    function __construct(BrandsRepository $brandsRepository, CreateBrandForm $createBrandForm)
    {
        $this->brandsRepository = $brandsRepository;
        $this->createBrandForm = $createBrandForm;
    }

     public function index($brand_id)
    {  
        $pagename = pageName();

        $brand_info = $this->brandsRepository->getBrandInfoById($brand_id);

        $brand_images = $this->brandsRepository->getImagesFromBrandId($brand_id);

        return View::make('brands.index', array('pagename' => $pagename, 'brand_info' => $brand_info, 'brand_images' => $brand_images));
    }


    // --------------------- CMS WHERE TO BUY  -------------------------------

    public function show()
    {   
        $pagename = pageName();
        $brandList = $this->brandsRepository->getAllBrands();dd('nour');
        return View::make('cms.brands.show', array('pagename' => $pagename, 'brandList' => $brandList));
    }


     public function delete_brand($brand_id)
    {   
        $pagename = pageName();

        $this->brandsRepository->deleteBrand($brand_id);
        Flash::error('The Prize has been DELETED'); //Message confirming that the post has been sent to validator

        $brandList = $this->brandsRepository->getAllBrands();
        return View::make('cms.brands.show', array('pagename' => $pagename,'brandList' => $brandList));
    }

    public function createBrand()
    {   
        $pagename = pageName();
        return View::make('cms.brands.createBrand', array('pagename' => $pagename));
    }


    public function add()
    {   
        $pagename = pageName();

        $input = Input::all();
        $this->createBrandForm->validate($input);

        if(Input::hasFile('brand_logo'))
        {
            $file = Input::file('brand_logo');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/brands/', $file_name);
            $input['brand_logo'] = $real_path;
        }

        $this->brandsRepository->createBrand($input);
        Flash::success('The new brand has been CREATED'); //Message confirming that the post has been sent to validator

        $brandList = $this->brandsRepository->getAllBrands();
        return View::make('cms.brands.show', array('pagename' => $pagename,'brandList' => $brandList));
    }


    public function editDetails($brand_id)
   {    
        $pagename = pageName();

        $brand_info = $this->brandsRepository->getBrandInfoById($brand_id);
        return View::make('cms.brands.editBrandDetails', array('pagename' => $pagename, 'brand_info' => $brand_info));
   }


    public function updateDetails($brand_id)
    {   
        $pagename = pageName();

        $input = Input::all();
        $this->createBrandForm->validate($input);

        if(Input::hasFile('brand_logo'))
        {
            $file = Input::file('brand_logo');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/brands_logo/', $file_name);
            $input['brand_logo'] = $real_path;
        }
        else // If no image has been selected we must keep the old image ine the database
        {
            $brand_info = $this->brandsRepository->getBrandInfoById($brand_id);
            foreach ($brand_info as $b)
            {
            $input['brand_logo'] = $b->brand_logo;
            }
        }

        $this->brandsRepository->updateBrandDetails($brand_id, $input);
        Flash::success('The brand info has been UPDATED'); //Message confirming that the post has been sent to validator

        $brand_info = $this->brandsRepository->getBrandInfoById($brand_id);
        return View::make('cms.brands.editBrandDetails', array('pagename' => $pagename, 'brand_info' => $brand_info));
    }



    public function showBrandSlideShow($brand_id)
   {
        $pagename = pageName();


       $brandDetails = $this->brandsRepository->getBrandInfoById($brand_id);

       $brandImages = $this->brandsRepository->getImagesFromBrandId($brand_id);
        return View::make('cms.brands.showBrandSlideShow', array('pagename' => $pagename, 'brandDetails' => $brandDetails, 'brandImages' => $brandImages, 'brand_id' => $brand_id));
   }



     public function createBrandSlideshow($brand_id)
    {   
        $pagename = pageName();

        return View::make('cms.brands.createSlideShow', array('pagename' => $pagename, 'brand_id' => $brand_id));
    }


    public function addSlideShowImage($brand_id)
    {   
        $pagename = pageName();

        $input = Input::all();

        if(Input::hasFile('brand_slideshow_image'))
        {
            $file = Input::file('brand_slideshow_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/brands/', $file_name);
            $input['brand_slideshow_image'] = $real_path;
        }

        Flash::success('The new image has been added to the brand'); //Message confirming that the post has been sent to validator
    
       $this->brandsRepository->createSlideShowImage($input, $brand_id);
       
       $brandDetails = $this->brandsRepository->getBrandInfoById($brand_id);

       $brandImages = $this->brandsRepository->getImagesFromBrandId($brand_id);
       return View::make('cms.brands.showBrandSlideShow', array('pagename' => $pagename, 'brandImages' => $brandImages, 'brand_id' => $brand_id, 'brandDetails' => $brandDetails));
    }



   public function editSlideshow($brand_image_id)
   {    
        $pagename = pageName();

        $brandImageDetails = $this->brandsRepository->getInfoOfBrandImageFromId($brand_image_id);
        return View::make('cms.brands.editBrandSlideShow', array('pagename' => $pagename, 'brandImageDetails' => $brandImageDetails));
   }


    public function updateBrandImage($brand_image_id, $brand_id)
    {   
        $pagename = pageName();

        $input = Input::all();

        if(Input::hasFile('slideshow_image'))
        {
            $file = Input::file('slideshow_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/brands/', $file_name);
            $input['slideshow_image'] = $real_path;
        }
        else // If no image has been selected we must keep the old image ine the database
        {
            $brand_image_info = $this->brandsRepository->getInfoOfBrandImageFromId($brand_image_id);
            foreach ($brand_image_info as $b)
            {
            $input['slideshow_image'] = $b->url_img;
            }
        }

        $this->brandsRepository->updateBrandSlideshow($brand_image_id, $input);
        Flash::success('The info of the brand image has been UPDATED'); //Message confirming that the post has been sent to validator

        $brandImages = $this->brandsRepository->getImagesFromBrandId($brand_id);

        $brandDetails = $this->brandsRepository->getBrandInfoById($brand_id);
 
        //$brandImageDetails = $this->brandsRepository->getInfoOfBrandImageFromId($brand_image_id);
      
        return View::make('cms.brands.showBrandSlideShow', array('pagename' => $pagename, 'brandImages' => $brandImages,  'brandDetails' => $brandDetails, 'brand_id' => $brand_id));
    }

   

    public function deleteBrandImage($brand_image_id, $brand_id)
    {   

        $pagename = pageName();

        $this->brandsRepository->deleteBrandImage($brand_image_id);
        Flash::error('The image has been DELETED'); //Message confirming that the post has been sent to validator

       $brandImages = $this->brandsRepository->getImagesFromBrandId($brand_id);

       $brandDetails = $brandDetails = $this->brandsRepository->getBrandInfoById($brand_id);

       return View::make('cms.brands.showBrandSlideShow', array('pagename' => $pagename, 'brandImages' => $brandImages, 'brand_id' => $brand_id, 'brandDetails' =>$brandDetails));
    }

}