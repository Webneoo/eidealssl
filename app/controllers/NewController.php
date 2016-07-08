<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use eideal\News\NewsRepository;
use eideal\Forms\CreateNewsForm;


class NewController extends \BaseController {


    private $createNewsForm;
    private $newsRepository;
    
    function __construct(CreateNewsForm $createNewsForm, NewsRepository $newsRepository)
    {
         $this->createNewsForm = $createNewsForm;
         $this->newsRepository = $newsRepository;
    }

	public function index($news_date)
	{     
        
        $pagename = pageName();
        if(!isset($news_date) || $news_date == 0)
        $newsList = $this->newsRepository->getAllNews();
        else
        $newsList = $this->newsRepository->getAllNewsByDate($news_date);
        return View::make('news.index', array('pagename' => $pagename, 'newsList' => $newsList, 'news_date'=>$news_date));
	}

    public function display($news_id)
    {  
        $pagename = pageName();

        $newsDetails = $this->newsRepository->getNewsById($news_id);

        return View::make('news.display', array('pagename' => $pagename, 'newsDetails' => $newsDetails));
    }

    


    // --------------------- CMS NEWS  -------------------------------


    public function show()
    {   
        $pagename = pageName();
        $newsList = $this->newsRepository->getAllNews();
        return View::make('cms.news.show', array('pagename' => $pagename, 'newsList' => $newsList));
    }

    public function create()
    {   
        $pagename = pageName();
        return View::make('cms.news.create', array('pagename' => $pagename));
    }

    public function add()
    {   
        $pagename = pageName();
         $input = Input::all();
         $this->createNewsForm->validate($input);
         
          if(Input::hasFile('news_image'))
        {
            $file = Input::file('news_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/news/', $file_name);
            $input['news_image'] = $real_path;
        }

        $this->newsRepository->createNews($input);
        Flash::success('The News has been CREATED'); //Message confirming that the post has been sent to validator

        return View::make('cms.news.create', array('pagename' => $pagename));
    }

    public function edit($news_id)
    {   
        $pagename = pageName();

        $news_info = $this->newsRepository->getNewsById($news_id);
        return View::make('cms.news.edit', array('pagename'=> $pagename, 'news_info' => $news_info));
    }

    public function update($news_id)
    {   
        $pagename = pageName();

         $input = Input::all();
         $this->createNewsForm->validate($input);
        

         if(Input::hasFile('news_image'))
        {
            $file = Input::file('news_image');
            $file_name = time() . '-' . $file->getClientOriginalName();
            $real_path = $file_name;
            $file->move(public_path() .'/images/news/', $file_name);
            $input['news_image'] = $real_path;
        }
        else // If no image has been selected we must keep the old image in the database
        {
            $news_info = $this->newsRepository->getNewsById($news_id);
            foreach ($news_info as $n)
            {
            $input['news_image'] = $n->img;
            }
        }

         $this->newsRepository->updateNews($news_id, $input);
         Flash::success('The News has been UPDATED'); //Message confirming that the post has been sent to validator

        $news_info = $this->newsRepository->getNewsById($news_id);
        return View::make('cms.news.edit', array('pagename' => $pagename, 'news_info' => $news_info));
    }

    public function delete($news_id)
    {   
        $pagename = pageName();

        $this->newsRepository->deleteNews($news_id);
        Flash::error('The News has been DELETED'); //Message confirming that the post has been sent to validator

        $newsList = $this->newsRepository->getAllNews();
        return View::make('cms.news.show', array('pagename' => $pagename, 'newsList' => $newsList));
    }

}
