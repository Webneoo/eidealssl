<?php


use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Media\MediasRepository;
use eideal\Forms\CreateMediaForm;
use eideal\Products\ProductsRepository;


class MediaController extends \BaseController {

    private $mediasRepository;
    private $createMediaForm;
    private $productsRepository;


    function __construct(MediasRepository $mediasRepository, CreateMediaForm $createMediaForm, ProductsRepository $productsRepository)
    {
        $this->mediasRepository = $mediasRepository;
        $this->createMediaForm = $createMediaForm;
        $this->productsRepository = $productsRepository;
    }


    // --------------------- CMS WHERE TO BUY  -------------------------------

    public function show()
    {   
        $pagename = pageName();
        
        $mediaList = $this->mediasRepository->getAllMediasList();  
        return View::make('cms.medias.show', array('pagename' => $pagename, 'mediaList' => $mediaList));
    }

    public function add()
    {   
        $pagename = pageName();

        $input = Input::all();
        $this->createMediaForm->validate($input);

        if(Input::hasFile('media_image'))
        {
            $file = Input::file('media_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/medias/', $file_name);
            $input['media_image'] = $real_path;
        }

        $this->mediasRepository->createMedia($input);
        Flash::success('The media has been CREATED'); //Message confirming that the post has been sent to validator

        $productsList = $this->productsRepository->getAllProductsList();    
        return View::make('cms.medias.create', array('pagename' => $pagename, 'productsList' => $productsList));
    }

    public function create()
    {   
        $pagename = pageName();
        
        $productsList = $this->productsRepository->getAllProductsList();    
        return View::make('cms.medias.create', array('pagename' => $pagename, 'productsList' => $productsList));
    }

    public function edit($media_id)
    {   
        $pagename = pageName();

        $media_info = $this->mediasRepository->getMediaInfoById($media_id);

        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.medias.edit', array('pagename' => $pagename, 'media_info' => $media_info, 'productsList' => $productsList));
    }

    public function update($media_id)
    {   
        $pagename = pageName();

        $input = Input::all();
      //  $this->createMediaForm->validate($input);

        if(Input::hasFile('media_image'))
        {
            $file = Input::file('media_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/medias/', $file_name);
            $input['media_image'] = $real_path;
        }
        else // If no image has been selected we must keep the old image ine the database
        {
            $media_info = $this->mediasRepository->getMediaInfoById($media_id);
            foreach ($media_info as $m)
            {
            $input['media_image'] = $m->img;
            }
        }

        if(!isset($input['product_media_link_id']))
        $input['product_media_link_id'] = $media_info[0]->product_id;

        $this->mediasRepository->updateMedia($media_id, $input);
        Flash::success('The media has been UPDATED'); //Message confirming that the post has been sent to validator

        $media_info = $this->mediasRepository->getMediaInfoById($media_id);
        $productsList = $this->productsRepository->getAllProductsList();
        return View::make('cms.medias.edit', array('pagename' => $pagename, 'media_info' => $media_info, 'productsList' => $productsList));
    }

    public function delete($media_id)
    {   

        $pagename = pageName();

       $this->mediasRepository->deleteMedia($media_id);
        Flash::error('The Media has been DELETED'); //Message confirming that the post has been sent to validator

        $mediaList = $this->mediasRepository->getAllMediasList();
        return View::make('cms.medias.show', array('pagename' => $pagename,'mediaList' => $mediaList));
    }

}
