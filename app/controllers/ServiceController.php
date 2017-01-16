<?php


use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Services\ServicesRepository;
use Carbon\Carbon; 


class ServiceController extends \BaseController {

    private $servicesRepository;


    function __construct(ServicesRepository $servicesRepository)
    {
        $this->servicesRepository = $servicesRepository;
    }

     public function index($service_id)
    {  
        $pagename = pageName();

        $service_details = $this->servicesRepository->getServiceDetailsfromId($service_id);
        $service_images = $this->servicesRepository->getServiceImagesfromId($service_id);
        $service_videos = $this->servicesRepository->getServiceVideosfromId($service_id);

        return View::make('services.index', array('pagename' => $pagename, 'service_details' => $service_details, 'service_images' => $service_images, 'service_videos' => $service_videos));
    }


    // --------------------- CMS WHERE TO BUY  -------------------------------

    public function show()
    {   
        $pagename = pageName();
        $service_list = $this->servicesRepository->getAllServices();
        return View::make('cms.services.show', array('pagename' => $pagename, 'service_list' => $service_list));
    }


  
    public function createService()
    {   
        $pagename = pageName();
        return View::make('cms.services.create-service', array('pagename' => $pagename, 'actual_date' => Carbon::now('Asia/Beirut')));
    }


    public function addService()
    {   
        $pagename = pageName();

        $input = Input::all();  

        $this->servicesRepository->insertService($input);
        Flash::success('The new service has been successfully CREATED'); //Message confirming that the post has been sent to validator

        // redirect to the service management page
        return Redirect::away('cms-services-management');

    }


    public function editService($service_id)
   {    
        $pagename = pageName();

        $service_details = $this->servicesRepository->getServiceDetailsfromId($service_id);
        return View::make('cms.services.edit-service', array('pagename' => $pagename, 'service_details' => $service_details));
   }


    public function updateService()
    {   
        $pagename = pageName();

        $input = Input::all();


        $this->servicesRepository->updateService($input);
        Flash::success('Your service info has been successfully UPDATED'); //Message confirming that the post has been sent to validator

         // redirect to the service management page
        return Redirect::away('cms-services-management');
    }


       public function deleteService()
    {   
        $pagename = pageName();

        $input = Input::all();  

        $this->servicesRepository->deleteService($input['service_id']);
        Flash::error('Your service has been DELETED'); //Message confirming that the post has been sent to validator

        return Redirect::away('cms-services-management');
    }


    // ================== SERVICE IMAGES =========================

    public function showServiceImages($service_id)
   {
       $pagename = pageName();

       $service_images = $this->servicesRepository->getServiceImagesfromId($service_id);
       $service_details = $this->servicesRepository->getServiceDetailsfromId($service_id);

       return View::make('cms.services.show-service-images', array('pagename' => $pagename, 'service_images' => $service_images, 'service_details' => $service_details));
   }


     public function createImagesService($service_id)
    {   
        $pagename = pageName();
        $service_details = $this->servicesRepository->getServiceDetailsfromId($service_id);

        return View::make('cms.services.create-service-image', array('pagename' => $pagename, 'actual_date' => Carbon::now('Asia/Beirut'), 'service_details' => $service_details));
    }


    public function addImageService()
    {   
        $pagename = pageName();

        $input = Input::all();

        if(Input::hasFile('service_image'))
        {
            $file = Input::file('service_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/services/', $file_name);
            $input['service_image'] = $real_path;
        }

        Flash::success('The new image has been added to the service'); //Message confirming that the post has been sent to validator
    
        $this->servicesRepository->insertImageService($input);

        return Redirect::away('show-service-images-'.$input['service_id']);
       
    }


   public function editImageService($service_carousel_id)
   {         
        $pagename = pageName();

        $image_details = $this->servicesRepository->getInfoOfImageFromId($service_carousel_id);
 

        return View::make('cms.services.edit-service-image', array('pagename' => $pagename, 'image_details' => $image_details));
   }


    public function updateImageService($input)
    {   
        $pagename = pageName();

        $input = Input::all();

        if(Input::hasFile('service_image'))
        {
            $file = Input::file('service_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/services/', $file_name);
            $input['service_image'] = $real_path;
        }
        else // If no image has been selected we must keep the old image ine the database
        {
            $image_details = $this->servicesRepository->getInfoOfImageFromId($input['service_carousel_id']);
            $input['service_image'] = $image_details[0]->image;
            
        }

        $this->servicesRepository->updateImageService($input);
        Flash::success('The info of your image were UPDATED'); //Message confirming that the post has been sent to validator

        $image_details = $this->servicesRepository->getInfoOfImageFromId($input['service_carousel_id']);

        return Redirect::away('show-service-images-'.$image_details[0]->service_id);
    }

   
    public function deleteImageService()
    {   

        $pagename = pageName();

        $input = Input::all();

        $this->servicesRepository->deleteImageService($input['service_carousel_id']);
        Flash::error('The image has been DELETED'); //Message confirming that the post has been sent to validator

        $image_details = $this->servicesRepository->getInfoOfImageFromId($input['service_carousel_id']);

        return Redirect::away('show-service-images-'.$image_details[0]->service_id);
    }





    // ================== SERVICE VIDEOS =========================

    public function showServiceVideos($service_id)
   {
       $pagename = pageName();

       $service_videos = $this->servicesRepository->getServiceVideosfromId($service_id);
       $service_details = $this->servicesRepository->getServiceDetailsfromId($service_id);

       return View::make('cms.services.show-service-videos', array('pagename' => $pagename, 'service_videos' => $service_videos, 'service_details' => $service_details));
   }


     public function createVideoService($service_id)
    { 
        $pagename = pageName();
        $service_details = $this->servicesRepository->getServiceDetailsfromId($service_id);

        return View::make('cms.services.create-service-video', array('pagename' => $pagename, 'actual_date' => Carbon::now('Asia/Beirut'), 'service_details' => $service_details));
    }


    public function addVideoService()
    {   
        $pagename = pageName();

        $input = Input::all();

        Flash::success('The new video has been added to the service'); //Message confirming that the post has been sent to validator
    
        $this->servicesRepository->insertVideoService($input);

        return Redirect::away('show-service-videos-'.$input['service_id']);
       
    }


   public function editVideoService($service_video_id)
    {
        $pagename = pageName();

        $video_details = $this->servicesRepository->getInfoOfVideoFromId($service_video_id);

        return View::make('cms.services.edit-service-video', array('pagename' => $pagename, 'video_details' => $video_details));
   }


    public function updateVideoService($input)
    {   
        $pagename = pageName();

        $input = Input::all();


        $this->servicesRepository->updateVideoService($input);
        Flash::success('The info of your video were UPDATED'); //Message confirming that the post has been sent to validator

        $video_details = $this->servicesRepository->getInfoOfVideoFromId($input['service_video_id']);

        return Redirect::away('show-service-videos-'.$video_details[0]->service_id);
    }

   
    public function deleteVideoService()
    {   

        $pagename = pageName();

        $input = Input::all();

        $this->servicesRepository->deleteVideoService($input['service_video_id']);
        Flash::error('The image has been DELETED'); //Message confirming that the post has been sent to validator

        $video_details = $this->servicesRepository->getInfoOfVideoFromId($input['service_video_id']);

        return Redirect::away('show-service-videos-'.$video_details[0]->service_id);
    }

}