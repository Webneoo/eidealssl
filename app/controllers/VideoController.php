<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\Videos\VideoRepository;



class VideoController extends \BaseController {


    private $videoRepository;
    
    function __construct(VideoRepository $videoRepository)
    {
         $this->videoRepository = $videoRepository;
    }

	public function index()
	{     
        
        $pagename = pageName();
       
        $all_videos = $this->videoRepository->getAllVideos();
        return View::make('videos.index', array('pagename' => $pagename, 'all_videos' => $all_videos));
	}

    // --------------------- CMS NEWS  -------------------------------


    public function show()
    {   
        $pagename = pageName();
        $all_videos = $this->videoRepository->getAllVideos();

        return View::make('cms.videos.show', array('pagename' => $pagename, 'all_videos' => $all_videos));
    }

    public function create()
    {   
        $pagename = pageName();
        return View::make('cms.videos.create', array('pagename' => $pagename));
    }

    public function add()
    {   
        $pagename = pageName();
        $input = Input::all();
       
        $this->videoRepository->addVideo($input);
        Flash::success('Your video has been added'); //Message confirming that the post has been sent to validator

        $all_videos = $this->videoRepository->getAllVideos();
         return View::make('cms.videos.show', array('pagename' => $pagename, 'all_videos' => $all_videos));
    }

    public function edit($video_id)
    {   
        $pagename = pageName();

        $video_info = $this->videoRepository->getVideoById($video_id);
        return View::make('cms.videos.edit', array('pagename'=> $pagename, 'video_info' => $video_info));
    }

    public function update($video_id)
    {   
        $pagename = pageName();

         $input = Input::all();
       

         $this->videoRepository->updateVideo($video_id, $input);
         Flash::success('Your video has been updated'); //Message confirming that the post has been sent to validator

         $all_videos = $this->videoRepository->getAllVideos();
         return View::make('cms.videos.show', array('pagename' => $pagename, 'all_videos' => $all_videos));
    }

    public function delete($video_id)
    {   
        $pagename = pageName();

        $this->videoRepository->deletevideo($video_id);
        Flash::error('Your video has been deleted'); //Message confirming that the post has been sent to validator

        $all_videos = $this->videoRepository->getAllVideos();
         return View::make('cms.videos.show', array('pagename' => $pagename, 'all_videos' => $all_videos));
    }

}
