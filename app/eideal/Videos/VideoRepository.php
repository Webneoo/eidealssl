<?php namespace eideal\Videos;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class VideoRepository {


    public function getAllVideos()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_videos
                          ORDER BY updated_at DESC")
        );

        return $q;
    }

    public function addVideo($input)
    {   

         \DB::table('ta_videos')->insert(
            array('title' => $input['video_title'],
                  'url' => $input['video_url_code'],  
                  'created_at' => $input['video_date'],
                  'updated_at' => $input['video_date'])
            );
    }


    public function getVideoById($video_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_videos 
                      WHERE video_id = :video_id"),
            array(':video_id' => $video_id)
            );

        return $q;
    }

    public function updateVideo($video_id, $input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_videos
                      SET title =:title, 
                          url = :url, 
                          updated_at = :updated_at
                      WHERE video_id = :video_id"),
            array(':video_id' => $video_id,
                  ':title' => $input['video_title'], 
                  ':url' => $input['video_url_code'], 
                  ':updated_at' => $input['video_date'])
            );
    }


        public function deletevideo($video_id)
    {
        \DB::table('ta_videos')
            ->where('video_id', '=', $video_id)
            ->delete();
    }

}

