<?php namespace eideal\Home;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class HomeRepository {

    
    public function getUserInfoById($user_id)
    {   

         $q = \DB::select(
            \DB::raw("SELECT * FROM users 
                      WHERE id = :user_id"),
            array(':user_id' => $user_id)
            );

        return $q;
    }

    public function getNewslettersSubscribers()
    {
        $u = \DB::table('users as A')
            ->join('ta_profiles as B', 'A.id', '=', 'B.user_id')
            ->where('newsletters', '=', 1)
            ->select('A.email')
            ->get();

        return  $u;
    }

    public function getSecretQuestionByEmail($email)
    {
        $q = \DB::table('users as A')
            ->join('ta_secret_questions as B', 'A.secret_question_id', '=', 'B.secret_question_id')
            ->where('A.email', $email)
            ->select('A.username',
                    'A.secret_answer',
                    'B.desc')
            ->first();

        return $q;
    }



    public function getSecretQuestionByUsername($username)
    {
        $q = \DB::table('users as A')
            ->join('ta_secret_questions as B', 'A.secret_question_id', '=', 'B.secret_question_id')
            ->where('A.username', $username)
            ->select('A.username',
                    'A.secret_answer',
                'B.desc')
            ->first();

        return $q;
    }

    public function getSecretQuestionsList()
    {
        $q = \DB::table('ta_secret_questions as A')
            ->get();

        return $q;

    }



    /* ------------------- WHERE TO BUY ------------------- */

    public function getStoreList()
    {   
          $q = \DB::select(
                \DB::raw("SELECT A.locator_id, A.name, A.region_id, A.country_id, A.address, A.phone, B.desc as country, C.desc as region
                          FROM ta_store_locator as A, ta_country as B, ta_regions as C
                          WHERE A.region_id = C.region_id
                          AND A.country_id = B.country_id")
        );

        return $q;
    }


    public function getAllCountries()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_country as A
                          ORDER BY A.desc ASC")
        );

        return $q;
    }


    public function getRegionsFromCountryId($country_id)
    {   
      if($country_id == 0) //get all regions
      {
         $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_regions as A
                          ORDER BY A.desc ASC")
        );
      }

      else // get specific regions for specific countries
      {
         $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_regions as A
                          WHERE country_id = :country_id
                          ORDER BY A.desc ASC"),
            array(':country_id' => $country_id)
        );
      } 

      return $q;
    }


    public function getAllRegions()
    { 
     $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_regions as A
                          ORDER BY A.desc ASC")
        );
      return $q;
    }

    public function getStoreListFromCountryId($country_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT A.locator_id, A.name, A.region_id, A.country_id, A.address, A.phone, B.desc as country, C.desc as region
                          FROM ta_store_locator as A, ta_country as B, ta_regions as C
                          WHERE A.region_id = C.region_id
                          AND A.country_id = B.country_id
                          AND A.country_id = :country_id"),
                array(':country_id' => $country_id)
        );

        return $q;
    }


     public function getStoreListFromRegionId($region_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT A.locator_id, A.name, A.region_id, A.country_id, A.address, A.phone, B.desc as country, C.desc as region
                          FROM ta_store_locator as A, ta_country as B, ta_regions as C
                          WHERE A.region_id = C.region_id
                          AND A.country_id = B.country_id
                          AND A.region_id = :region_id"),
                array(':region_id' => $region_id)
        );

        return $q;
    }



    public function deleteStore($locator_id)
    {
        \DB::table('ta_store_locator')
            ->where('locator_id', '=', $locator_id)
            ->delete();
    }


    public function getLocatorInfoById($locator_id)
    {   
         
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_store_locator 
                      WHERE locator_id = :locator_id"),
            array(':locator_id' => $locator_id)
            );
        return $q;
    }

    public function updateStore($locator_id, $input)
    {   
         $q = \DB::select(
            \DB::raw("UPDATE ta_store_locator
                      SET name = :name, 
                          region_id = :region_id, 
                          address = :address, 
                          phone = :phone,
                          country_id =:country_id
                      WHERE locator_id = :locator_id"),
            array(':locator_id' => $locator_id, 
                  ':name' => $input['name'], 
                  ':region_id' => $input['region_post'], 
                  ':address' => $input['address'] ,
                  ':phone' => $input['phone'],
                  ':country_id' => $input['country_post'])
            );
    }


    public function createStore($input)
    {   

         $q = \DB::select(
            \DB::raw("INSERT INTO ta_store_locator (name, region_id, address, phone, country_id)
                      VALUES (:name, :region_id, :address, :phone, :country_id)"),
            array(':name' => $input['name'], 
                  ':region_id' => $input['region_post'], 
                  ':address' => $input['address'] ,
                  ':phone' => $input['phone'],
                  ':country_id' => $input['country_post']
                  )
            );
    }



     public function getBestSellerProducts()
    {   
         $q = \DB::select(
            \DB::raw("SELECT * FROM ta_products 
                      WHERE best_seller = 1")
            );

        return $q;
    }



    // ABOUT US ---------------------------------------------

     public function getAboutUs()
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_about_us 
                      WHERE aboutus_id = 1")
            );

        return $q;
    }


     public function updateAboutUs($input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_about_us 
                      SET img = :img,
                          title1 = :title1,
                          text1 = :about_us_txt1,
                          title2 = :title2,
                          text2 = :about_us_txt2,
                          title3 = :title3,
                          text3 = :about_us_txt3,
                          title4 = :title4,
                          text4 = :about_us_txt4,
                          title5 = :title5,
                          text5 = :about_us_txt5
                      WHERE aboutus_id = 1"),

            array(':img' => $input['about_us_img'], 
                  ':title1' => $input['title_1'], 
                  ':about_us_txt1' => $input['about_us_txt_1'],
                  ':title2' => $input['title_2'],
                  ':about_us_txt2' => $input['about_us_txt_2'],
                  ':title3' => $input['title_3'],
                  ':about_us_txt3' => $input['about_us_txt_3'],
                  ':title4' => $input['title_4'],
                  ':about_us_txt4' => $input['about_us_txt_4'],
                  ':title5' => $input['title_5'],
                  ':about_us_txt5' => $input['about_us_txt_5']    
                  )
            );
    }


     public function showSlideshow()
    {   
         $q = \DB::select(
            \DB::raw("SELECT *
                      FROM ta_slideshow
                      ORDER BY slideshow_date DESC")
            );

      return $q;  
    }



     public function getSlideShowFromId($image_id)
    {   
         $q = \DB::select(
            \DB::raw("SELECT *
                      FROM ta_slideshow
                      WHERE image_id = :image_id"),
             array(':image_id' => $image_id)
            );

      return $q;  
    }



     public function addSlideshow($input)
    {   
         $q = \DB::select(
            \DB::raw("INSERT INTO ta_slideshow (img_url, slideshow_date)
                      VALUES (:img_url, :date_slideshow)"),
            array(':img_url' => $input['slideshow_image'], 
                  ':date_slideshow' => $input['date_slideshow']
                 )
            );
    }


     public function updateSlideshow($input, $image_id)
    {   
         $q = \DB::select(
            \DB::raw("UPDATE ta_slideshow
                      SET img_url = :img_url, 
                          slideshow_date = :date_slideshow 
                      WHERE image_id = :image_id"),
            array(':image_id' => $image_id, 
                  ':img_url' => $input['slideshow_image'], 
                  ':date_slideshow' => $input['date_slideshow']
                 )
            );
    }



    public function deleteSlideShow($image_id)
    {
        \DB::table('ta_slideshow')
            ->where('image_id', '=', $image_id)
            ->delete();
    }



    // E-TEAM ---------------------------------------------

     public function getEteam()
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_eteam")
            );

        return $q;
    }



    public function updateEteam($input)
    {  
         $q = \DB::select(
            \DB::raw("UPDATE ta_eteam
                      SET img = :img, 
                          description = :description
                      WHERE id_ta_eteam = 1"),
            array(':img' => $input['eteam_img'], 
                  ':description' => $input['eteam_desc'])
            );
    }



    // NEWSLETTERS ---------------------------------------------

    public function getNewsLettersEmailsList()
    {   
         $q = \DB::select(
            \DB::raw("SELECT email 
                      FROM users
                      WHERE newsletters = 1

                      UNION

                      SELECT newsletters_email as email
                      FROM ta_newsletters_emails")
            );

        return $q;
    }


    public function getUsersNewslettersEmail($email)
    {   
         $q = \DB::select(
            \DB::raw("SELECT email, newsletters 
                      FROM users
                      WHERE email = :email"
            ),
            array(':email' => $email)
            );

        return $q;
    }

     public function getNewsLettersInfo()
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_newsletters_info")
            );

        return $q;
    }


    public function updateNewsletterStatus($email)
    {  
         $q = \DB::select(
            \DB::raw("UPDATE users
                      SET newsletters = 1
                      WHERE email = :email"),
            array(':email' => $email)
            );
    }

     public function CheckEmailExistInNewsletters($email)
    {   
         $q = \DB::select(
            \DB::raw("SELECT * 
                      FROM ta_newsletters_emails
                       WHERE newsletters_email = :email"),
            array(':email' => $email)
            );

        if(empty($q))
          return false;
        else
          return true;
    }


     public function insertNewsletterEmail($email)
    {   
         $q = \DB::select(
            \DB::raw("INSERT INTO ta_newsletters_emails 
                      VALUES (NULL, :email)"),
            array(':email' => $email)
            );
    }

    

    

  

     public function updateNewletters($input)
    {  
         $q = \DB::select(
            \DB::raw("UPDATE ta_newsletters_info
                      SET newsletters_title = :newsletters_title, 
                          newsletters_text = :newsletters_text
                      WHERE newsletters_id = 1"),
            array(':newsletters_title' => $input['title'], 
                  ':newsletters_text' => $input['content'])
            );
    }
    

}

