<?php namespace eideal\Media;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class MediasRepository  {


    public function getSomeMediasList()
    {
          $q = \DB::select(
                \DB::raw("SELECT *
                          FROM ta_medias
                          ORDER BY RAND()
                          LIMIT 0,6")
        );

        return $q;
    }

    public function getAllMediasList()
    {
          $q = \DB::select(
                \DB::raw("SELECT *
                          FROM ta_medias A, ta_products B
                          WHERE A.product_id = B.product_id")
        );

        return $q;
    }


    public function getAllMediasListByProductId($product_id)
    {
          $q = \DB::select(
                \DB::raw("SELECT *
                          FROM ta_medias
                          WHERE product_id = :product_id
                          ORDER BY updated_at DESC
                          LIMIT 0,6"),
            array(':product_id' => $product_id)
        );

        return $q;
    }


    public function getMediaInfoById($media_id)
    {
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_medias
                      WHERE media_id = :media_id"),
            array(':media_id' => $media_id)
            );

        return $q;
    }


    public function updateMedia($media_id, $input)
    {

         $q = \DB::select(
            \DB::raw("UPDATE ta_medias
                      SET img = :img,
                          url = :url,
                          updated_at = :updated_at,
                          product_id = :product_id
                      WHERE media_id = :media_id"),
            array(':media_id' => $media_id,
                  ':img' => $input['media_image'],
                  ':url' => $input['media_url'],
                  ':updated_at' => $input['media_date'],
                  ':product_id' => $input['product_media_link_id'])
            );
    }

    public function createMedia($input)
    {

         $q = \DB::select(
            \DB::raw("INSERT INTO ta_medias (img, url, created_at, updated_at, product_id)
                      VALUES (:img, :url, :created_at, :updated_at, :product_id)"),
            array(':img' => $input['media_image'],
                  ':url' => $input['media_url'],
                  ':created_at' => $input['media_date'] ,
                  ':updated_at' => $input['media_date'],
                  ':product_id' => $input['product_media_link_id'])
            );
    }


        public function deleteMedia($media_id)
    {
        \DB::table('ta_medias')
            ->where('media_id', '=', $media_id)
            ->delete();
    }

}

