<?php namespace eideal\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class ServicesRepository {
public $nour = 'fakhoury';
    public function getAllServices()
    {   
          $q = \DB::select(
                \DB::raw("SELECT A.*, B.video_number
                          
                          FROM 

                          (SELECT A.*, COUNT(B.service_carousel_id) as image_number
                          FROM ta_services as A
                          LEFT JOIN ta_service_carousel as B ON A.service_id = B.service_id AND B.hidden = 0
                          WHERE A.hidden = 0
                          GROUP BY A.service_id) as A

                          JOIN

                          (SELECT A.service_id, COUNT(B.service_id) as video_number
                          FROM ta_services as A
                          LEFT JOIN ta_service_videos as B ON A.service_id = B.service_id AND B.hidden = 0
                          WHERE A.hidden = 0
                          GROUP BY A.service_id) as B

                          ON A.service_id = B.service_id
                          ORDER BY A.updated_at DESC")
                          );

        return $q;
    }


    public function insertService($input)
    {   
        \DB::table('ta_services')->insert(
            array('title' => $input['service_title'], 
                  'content' => $input['service_content'], 
                  'created_at' => Carbon::now('Asia/Beirut'), 
                  'updated_at' => $input['service_date'])
        );
    }


    public function getServiceDetailsfromId($service_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT *
                      FROM ta_services 
                      WHERE service_id = :service_id
                      AND hidden = 0"),
            array(':service_id' => $service_id)
            );
        return $q;
    }
    

    public function updateService($input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_services
                      SET title = :title, 
                          content = :content, 
                          updated_at = :updated_at                
                      WHERE service_id = :service_id"),
            array(':service_id' => $input['service_id'],
                  ':title' => $input['service_title'], 
                  ':content' => $input['service_content'], 
                  ':updated_at' => $input['service_date'])
            );
    }


    public function deleteService($service_id)
    {
        $q = \DB::select(
            \DB::raw("UPDATE ta_services
                      SET hidden = 1
                      WHERE service_id = :service_id"),
            array(':service_id' => $service_id)
            );
    }


    
    // ================== SERVICE IMAGES =========================

    public function getServiceImagesfromId($service_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT* 
                      FROM  ta_service_carousel 
                      WHERE service_id = :service_id
                      AND hidden = 0
                      ORDER BY updated_at DESC"),
            array(':service_id' => $service_id)
            );
        return $q;
    }


    public function insertImageService($input)
    {   
         \DB::table('ta_service_carousel')->insert(
            array('service_id' => $input['service_id'], 
                  'image' => $input['service_image'], 
                  'hidden' => 0,
                  'created_at' => Carbon::now('Asia/Beirut'), 
                  'updated_at' => $input['service_image_date'])
        );
    }


     public function getInfoOfImageFromId($service_carousel_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_service_carousel
                      WHERE service_carousel_id = :service_carousel_id"),
            array(':service_carousel_id' => $service_carousel_id)
            );

        return $q;
    }


     public function updateImageService($input)
    {  
         $q = \DB::select(
            \DB::raw("UPDATE ta_service_carousel
                      SET image = :image, 
                          updated_at =:updated_at
                      WHERE service_carousel_id = :service_carousel_id"),
            array(':service_carousel_id' => $input['service_carousel_id'],
                  ':image' => $input['service_image'],
                  ':updated_at' => $input['service_image_date'])
            );
    }


      public function deleteImageService($service_carousel_id)
    {
        $q = \DB::select(
            \DB::raw("UPDATE ta_service_carousel
                      SET hidden = 1
                      WHERE service_carousel_id = :service_carousel_id"),
            array(':service_carousel_id' => $service_carousel_id)
            );
    }


    // ================== SERVICE VIDEOS =========================

    public function getServiceVideosfromId($service_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT* 
                      FROM  ta_service_videos 
                      WHERE service_id = :service_id
                      AND hidden = 0
                      ORDER BY updated_at DESC"),
            array(':service_id' => $service_id)
            );
        return $q;
    }


    public function insertVideoService($input)
    {   
         \DB::table('ta_service_videos')->insert(
            array('service_id' => $input['service_id'], 
                  'title' => $input['video_title'], 
                  'url' => $input['video_url_code'],
                  'hidden' => 0,
                  'created_at' => Carbon::now('Asia/Beirut'), 
                  'updated_at' => $input['video_date'])
        );
    }


     public function getInfoOfVideoFromId($service_video_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_service_videos
                      WHERE service_video_id = :service_video_id"),
            array(':service_video_id' => $service_video_id)
            );

        return $q;
    }


     public function updateVideoService($input)
    {  
         $q = \DB::select(
            \DB::raw("UPDATE ta_service_videos
                      SET title = :title, 
                          url =:url,
                          updated_at =:updated_at
                      WHERE service_video_id = :service_video_id"),
            array(':service_video_id' => $input['service_video_id'],
                  ':title' => $input['video_title'],
                  ':url' => $input['video_url_code'],
                  ':updated_at' => $input['video_date'])
            );
    }


      public function deleteVideoService($service_video_id)
    {
        $q = \DB::select(
            \DB::raw("UPDATE ta_service_videos
                      SET hidden = 1
                      WHERE service_video_id = :service_video_id"),
            array(':service_video_id' => $service_video_id)
            );
    }


    


}

