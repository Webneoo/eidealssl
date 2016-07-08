<?php namespace eideal\News;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class NewsRepository {


    public function getAllNews()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_news
                          ORDER BY updated_at DESC")
        );

        return $q;
    }


    public function getAllNewsByDate($news_date)
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_news 
                          WHERE YEAR(updated_at)= :news_date
                          ORDER BY updated_at DESC")
                ,
            array(':news_date' => $news_date)
        );

        return $q;
    }



    public function getNewsById($news_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_news 
                      WHERE news_id = :news_id"),
            array(':news_id' => $news_id)
            );

        return $q;
    }


    public function createNews($input)
    {   

         \DB::table('ta_news')->insert(
            array('img' => $input['news_image'],
                  'title' => $input['news_title'],
                  'text' => $input['news_content'],  
                  'created_at' => $input['news_date'],
                  'updated_at' => $input['news_date'])
            );
    }



    public function updateNews($news_id, $input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_news
                      SET img = :img,
                          title =:title, 
                          text = :text, 
                          updated_at = :updated_at
                      WHERE news_id = :news_id"),
            array(':news_id' => $news_id, 
                  ':img' => $input['news_image'],
                  ':title' => $input['news_title'], 
                  ':text' => $input['news_content'], 
                  ':updated_at' => $input['news_date'])
            );
    }


        public function deleteNews($news_id)
    {
        \DB::table('ta_news')
            ->where('news_id', '=', $news_id)
            ->delete();
    }

}

