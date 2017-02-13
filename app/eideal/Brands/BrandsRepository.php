<?php namespace eideal\Brands;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class BrandsRepository {


    public function getAllBrands()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_brands")
        );

        return $q;
    }

     public function getAllBrandsImages()
    {   
          $q = \DB::select(
                \DB::raw("SELECT *
                          FROM (
                          SELECT B.brand_id, brand_image_id, url_img, brand_title 
                          FROM eideal.ta_brand_image B, ta_brands C
                          WHERE B.brand_id = C.brand_id
                          ORDER BY RAND()
                          ) A
                          GROUP BY A.brand_id")
        );

        return $q;
    }




    public function getBrandInfoById($brand_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_brands 
                      WHERE brand_id = :brand_id"),
            array(':brand_id' => $brand_id)
            );

        return $q;
    }


       public function deleteBrand($brand_id)
    {
        \DB::table('ta_brands')
            ->where('brand_id', '=', $brand_id)
            ->delete();
    }


    public function updateBrandDetails($brand_id, $input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_brands
                      SET brand_title = :brand_title, 
                          brand_logo = :brand_logo, 
                          title1 = :title1,
                          desc1 = :desc1,
                          title2 = :title2,
                          desc2 = :desc2,
                          title3 = :title3,
                          desc3 = :desc3,
                          title4 = :title4,
                          desc4 = :desc4,
                          title5 = :title5,
                          desc5 = :desc5
                      WHERE brand_id = :brand_id"),
            array(':brand_id' => $brand_id,
                  ':brand_title' => $input['brand_title'], 
                  ':brand_logo' => $input['brand_logo'], 
                  ':title1' => $input['title_1'], 
                  ':desc1' => $input['brand_txt_1'],
                  ':title2' => $input['title_2'], 
                  ':desc2' => $input['brand_txt_2'],
                  ':title3' => $input['title_3'], 
                  ':desc3' => $input['brand_txt_3'],
                  ':title4' => $input['title_4'], 
                  ':desc4' => $input['brand_txt_4'],
                  ':title5' => $input['title_5'], 
                  ':desc5' => $input['brand_txt_5'])
            );
    }

    public function createBrand($input)
    {   

        \DB::table('ta_brands')->insert(
            array('brand_title' => $input['brand_title'], 
                  'brand_logo' => $input['brand_logo'], 
                  'title1' => $input['title_1'], 
                  'desc1' => $input['brand_txt_1'],
                  'title2' => $input['title_2'], 
                  'desc2' => $input['brand_txt_2'],
                  'title3' => $input['title_3'], 
                  'desc3' => $input['brand_txt_3'],
                  'title4' => $input['title_4'], 
                  'desc4' => $input['brand_txt_4'],
                  'title5' => $input['title_5'], 
                  'desc5' => $input['brand_txt_5'])
        );
    }



    public function getImagesFromBrandId($brand_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_brand_image 
                      WHERE brand_id = :brand_id
                      ORDER BY updated_at DESC"),
            array(':brand_id' => $brand_id)
            );

        return $q;
    }



    public function createSlideShowImage($input, $brand_id)
    {   
         $q = \DB::select(
            \DB::raw("INSERT INTO ta_brand_image (url_img, brand_id, created_at, updated_at)
                      VALUES (:url_img, :brand_id, :created_at, :updated_at)"),
            array(':url_img' => $input['brand_slideshow_image'],
                  ':brand_id' => $brand_id,
                  ':created_at' => $input['date_slideshow'],
                  ':updated_at' => $input['date_slideshow'],
                 )
            );
    }


     public function getInfoOfBrandImageFromId($brand_image_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_brand_image
                      WHERE brand_image_id = :brand_image_id"),
            array(':brand_image_id' => $brand_image_id)
            );

        return $q;
    }


     public function updateBrandSlideshow($brand_image_id, $input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_brand_image
                      SET url_img = :url_img, 
                          updated_at =:updated_at
                      WHERE brand_image_id = :brand_image_id"),
            array(':brand_image_id' => $brand_image_id,
                  ':url_img' => $input['slideshow_image'], 
                  ':updated_at' => $input['date_slideshow'])
            );
    }


      public function deleteBrandImage($brand_image_id)
    {
        \DB::table('ta_brand_image')
            ->where('brand_image_id', '=', $brand_image_id)
            ->delete();
    }



    


     

}

