<?php namespace eideal\Promo;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PromoRepository {


    public function getAllPromos()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_promo
                          ORDER BY updated_at DESC")
        );

        return $q;
    }


    public function createPromo($input, $start_date, $end_date)
    {   

         \DB::table('ta_promo')->insert(
            array('title' => $input['title'],
                  'promo_code' => $input['code'],
                  'percentage' => $input['percentage'],  
                  'start_date' => $start_date,
                  'end_date' => $end_date,
                  'active' => 1,
                  'created_at' => Carbon::now('Asia/Beirut'),
                  'updated_at' => Carbon::now('Asia/Beirut'))
            );
    }

    public function updateStatus($input)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_promo
                      SET active = :status,
                          updated_at = :updated_at
                      WHERE promo_id = :promo_id"),
            array(':status' => $input['change_status'],
                  ':promo_id' => $input['promo_id'],
                  ':updated_at' => Carbon::now('Asia/Beirut'))
            );
    }


    public function getActivePromo()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_promo
                          WHERE active = 1")
        );

        return $q;
    }



    public function getInfoFromPromoCode($promo_code, $user_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_promo 
                          WHERE promo_code = :promo_code
                          AND active = 1
                          AND NOW() >= start_date
                          AND NOW() < end_date
                          AND promo_id NOT IN
                          (SELECT promo_id
                            FROM ta_promo_user
                            WHERE user_id = :user_id)"),
                array('promo_code' => $promo_code,
                      'user_id' => $user_id)
        );

        return $q;
    }



    public function markPromoAsUsed($promo_id, $user_id)
    {   

         \DB::table('ta_promo_user')->insert(
            array('promo_id' => $promo_id,
                  'user_id' => $user_id,
                  'created_at' => Carbon::now('Asia/Beirut'))
            );
    }
    

}

