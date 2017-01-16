<?php namespace eideal\Products;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 

class ProductsRepository {


     public function getAllCategory()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_category")
        );

        return $q;
    }

    public function getAllSubcategory()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_sub_category")
        );

        return $q;
    }

    public function getAllSubcategoryOrderedByDate()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_sub_category
                          ORDER BY updated_at DESC")
        );     
        return $q;
    }

      public function getSubcategory($category_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_sub_category
                          WHERE category_id = :category_id
                          ORDER BY order_number"),
            array(':category_id' => $category_id)
        );

        return $q;
    }


     public function getSubcategoryFromSubcategory_id($sub_category_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_sub_category
                          WHERE sub_category_id = :sub_category_id"),
            array(':sub_category_id' => $sub_category_id)
        );

        return $q[0];
    }


    public function updateProductCategory($sub_category_id, $input)
    {   
         $q = \DB::select(
            \DB::raw("UPDATE ta_sub_category
                      SET title = :title, 
                          image = :image,
                          updated_at = :updated_at
                      WHERE sub_category_id = :sub_category_id"),
            array(':sub_category_id' => $sub_category_id, 
                  ':title' => $input['title'], 
                  ':image' => $input['product_category_img'], 
                  ':updated_at' => $input['product_category_date']
                  )
            );
    }



    public function getAllProductsList()
    {   
          $q = \DB::select(
                \DB::raw("SELECT A.product_id, A.code, A.title, A.price, A.img1, A.img2, A.img3, A.img4, A.best_seller, A.sub_category_id, B.title AS sub_category_title, A.liquid_product, A.promo_start_date, A.promo_end_date, A.percentage
                          FROM ta_products A
                          JOIN ta_sub_category B ON A.sub_category_id = B.sub_category_id
                          WHERE A.sub_category_id = B.sub_category_id")
        );

        return $q;
    }


    public function getAllProductsPerSubcategory($sub_category_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_products
                          WHERE sub_category_id = :sub_category_id
                          ORDER BY updated_at DESC
                          "),
                array(':sub_category_id' => $sub_category_id)
        );

        return $q;
    }

    public function getAllProductsFromSearch($sequence)
    {   
          $q = \DB::select(
                \DB::raw("SELECT A.product_id, A.code, A.title, A.small_desc, A.text, A.price, A.img1, A.sub_category_id, A.liquid_product, A.updated_at, A.promo_start_date, A.promo_end_date, A.percentage 
                          FROM ta_products A
                          WHERE A.title LIKE '%".$sequence."%' OR A.small_desc LIKE '%".$sequence."%' OR A.text LIKE '%".$sequence."%'

                          UNION
                            
                          SELECT A.product_id, A.code, A.title, A.small_desc, A.text, A.price, A.img1, A.sub_category_id, A.liquid_product, A.updated_at, A.promo_start_date, A.promo_end_date, A.percentage
                          FROM ta_products as A 
                          WHERE A.sub_category_id IN (SELECT A.sub_category_id
                          FROM ta_sub_category as A
                          WHERE A.title LIKE '%".$sequence."%')
                          ")       
        );

        return $q;
    }


    public function getFourRandomRelatedProducts($sub_category_id, $product_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT * 
                          FROM ta_products
                          WHERE sub_category_id = :sub_category_id
                          AND product_id <> :product_id
                          ORDER BY RAND()
                          LIMIT 4"),
                array(':sub_category_id' => $sub_category_id,
                      ':product_id' => $product_id)
        );

        return $q;
    }

    public function getAllProductsPerSubcategoryOrder($sub_category_id, $order)
    {  
      if($order == 0) 
       { 
            $q = \DB::select(
                  \DB::raw("SELECT * 
                            FROM ta_products
                            WHERE sub_category_id = :sub_category_id
                            ORDER BY price ASC"),
                  array(':sub_category_id' => $sub_category_id)
          );

        }

      if($order == 1) 
       { 
            $q = \DB::select(
                  \DB::raw("SELECT * 
                            FROM ta_products
                            WHERE sub_category_id = :sub_category_id
                            ORDER BY price DESC"),
                  array(':sub_category_id' => $sub_category_id)
          );

        }

        return $q;
    }


    public function getProductInfoFromId($product_id)
    {   
          $q = \DB::select(
                \DB::raw("SELECT *
                          FROM ta_products
                          WHERE product_id = :product_id"),
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


    public function updateProduct($product_id, $input)
    {   
         $q = \DB::select(
            \DB::raw("UPDATE ta_products
                      SET code = :code, 
                          title = :title,
                          small_desc = :small_desc, 
                          text = :text,
                          price = :price, 
                          img1 = :img1,
                          img2 = :img2, 
                          img3 = :img3,
                          img4 = :img4, 
                          sub_category_id = :sub_category_id,  
                          updated_at = :updated_at,
                          liquid_product = :liquid_product,
                          youtube_title = :youtube_title,
                          youtube_url = :youtube_url
                      WHERE product_id = :product_id"),
            array(':product_id' => $product_id, 
                  ':code' => $input['product_code'], 
                  ':title' => $input['product_title'], 
                  ':small_desc' => $input['product_short_desc'],
                  ':text' => $input['product_long_desc'], 
                  ':price' => $input['product_price'], 
                  ':img1' => $input['product_img_1'],
                  ':img2' => $input['product_img_2'],
                  ':img3' => $input['product_img_3'], 
                  ':img4' => $input['product_img_4'], 
                  ':sub_category_id' => $input['product_category'],  
                  ':updated_at' => $input['product_date'],
                  ':liquid_product' => $input['liquid_product'],
                  ':youtube_title' => $input['youtube_title'],
                  ':youtube_url' => $input['youtube_url']
                  )
            );
    }

    public function createProduct($input)
    {  
         $q = \DB::select(
            \DB::raw("INSERT INTO ta_products (code, title, small_desc, text, price, img1, img2, img3, img4, sub_category_id, created_at, updated_at, liquid_product, youtube_title, youtube_url, promo_start_date, promo_end_date, percentage)
                      VALUES (:code, :title, :small_desc, :text, :price, :img1, :img2, :img3, :img4, :sub_category_id, :created_at, :updated_at, :liquid_product, :youtube_title, :youtube_url, NULL, NULL, NULL)"),
            array(':code' => $input['product_code'], 
                  ':title' => $input['product_title'], 
                  ':small_desc' => $input['product_short_desc'],
                  ':text' => $input['product_long_desc'], 
                  ':price' => $input['product_price'], 
                  ':img1' => $input['product_img_1'],
                  ':img2' => $input['product_img_2'],
                  ':img3' => $input['product_img_3'], 
                  ':img4' => $input['product_img_4'], 
                  ':sub_category_id' => $input['product_category'],
                  ':created_at' => $input['product_date'],  
                  ':updated_at' => $input['product_date'],
                  ':liquid_product' => $input['liquid_product'],
                  ':youtube_title' => $input['youtube_title'],
                  ':youtube_url' => $input['youtube_url']

                  )
            );
    }


        public function deleteProduct($product_id)
    {
        \DB::table('ta_products')
            ->where('product_id', '=', $product_id)
            ->delete();
    }



    public function resetAllBestSeller()
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_products
                      SET best_seller = 0")
                  );
            
    }


    public function updateBestSeller($product_id_1, $product_id_2, $product_id_3, $product_id_4)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_products 
                      SET best_seller = 1  
                      WHERE product_id 
                      IN (:product_id_1, :product_id_2, :product_id_3, :product_id_4)"),

            array(':product_id_1' => $product_id_1, 
                  ':product_id_2' => $product_id_2,
                  ':product_id_3' => $product_id_3, 
                  ':product_id_4' => $product_id_4
                  )
            );
    }




    public function getAllProductsMonth()
    {   

         $q = \DB::select(
            \DB::raw("SELECT A.product_id, A.code, A.title, A.small_desc, 
                             A.price, A.img1, A.sub_category_id, 
                             B.product_id as product_of_the_month, C.title as sub_category_title 
                      FROM ta_products A
                      LEFT JOIN ta_product_month B ON A.product_id = B.product_id
                      LEFT JOIN ta_sub_category C ON A.sub_category_id = C.sub_category_id
                       ")
            );

         return $q;
    }



    public function selectProductOfTheMonth()
    {   

         $q = \DB::select(
            \DB::raw("SELECT A.product_id, A.code, A.title, A.small_desc, A.text, 
                             A.price, A.img1, A.img2, A.img3, A.img4, A.best_seller, A.sub_category_id, A.liquid_product, A.promo_start_date, A.promo_end_date, A.percentage
                      FROM ta_products A, ta_product_month B
                      WHERE A.product_id = B.product_id
                       ")
            );

         return $q;
    }



    public function updateProductOfTheMonth($old_product, $product_id)
    {   

         $q = \DB::select(
            \DB::raw("UPDATE ta_product_month 
                      SET product_id = :product_id
                      WHERE product_id = :old_product"),

            array(':old_product' => $old_product, 
                  ':product_id' => $product_id
                  )
            );
    }

    /*public function insertProductToCart($product_id, $user_id, $price, $qty)
    {
        \DB::table('ta_product_user')->insert(
            array('product_id' => $product_id,
                'user_id' => $user_id,
                'price' => $price,
                'quantity' => $qty,
                'updated_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"))
        );
    }*/


    public function getProductsInCartFromUserId($user_id)
    {

        $q = \DB::select(
            \DB::raw("SELECT A.order_id, A.user_id, A.order_status_id, C.product_id, C.code as id, C.price, B.quantity as qty, C.title as name, C.price,
                             C.promo_start_date, C.promo_end_date, C.percentage
                      FROM ta_orders as A
                      LEFT JOIN ta_order_products as B ON A.order_id = B.order_id
                      LEFT JOIN ta_products as C on B.product_id = C.product_id
                      WHERE A.user_id = :user_id
                      AND A.order_status_id IN (1,4)"),

            array(':user_id' => $user_id)
        );
                  
        return $q;
    }


     public function getOrderId($user_id)
    {

        $q = \DB::select(
            \DB::raw("SELECT *
                      FROM ta_orders 
                      WHERE user_id = :user_id
                      AND order_status_id IN (1,4)"),

            array(':user_id' => $user_id)
        );
                  
        return $q;
    }

    // insert a new order id + the first product in the cart 
    public function insertOrderIdProduct($product_id, $user_id, $qty)
    {

        \DB::transaction(function () use ($product_id, $user_id, $qty) {
             \DB::table('ta_orders')->insert(
                  array('user_id' => $user_id,
                        'order_status_id' => 1)
              );


            $last_order_id = \DB::select(
                \DB::raw("SELECT order_id FROM ta_orders ORDER BY order_id DESC LIMIT 0,1")
            );



            \DB::table('ta_order_products')->insert(
                  array('product_id' => $product_id,
                      'quantity' => $qty,
                      'order_id' => $last_order_id[0]->order_id
                       )
              );
        });
    }


    // insert a product in the cart having the order_id
    public function insertProdcutInCart($product_id, $order_id, $quantity)
    {
          \DB::table('ta_order_products')->insert(
                  array('product_id' => $product_id,
                      'quantity' => $quantity,
                      'order_id' => $order_id
                       )
              );
    }


    public function updateProductQuantity($product_id, $order_id, $quantity)
    {   
        \DB::table('ta_order_products')
                  ->where('order_id' ,  $order_id)
                  ->where('product_id' , $product_id)
                  ->update(array('quantity' => $quantity));

    }



    public function countProductInCart($user_id)
    {

        $q = \DB::select(
            \DB::raw("SELECT SUM(B.quantity) as qty_in_cart
                      FROM ta_orders as A
                      LEFT JOIN ta_order_products as B ON A.order_id = B.order_id
                      LEFT JOIN ta_products as C on B.product_id = C.product_id
                      WHERE A.user_id = :user_id
                      AND A.order_status_id IN (1,4)"),

            array(':user_id' => $user_id)
        );
                  
        return $q;
    }
    
    


    public function incrementQuantity($product_id, $order_id)
    {   
        \DB::table('ta_order_products')
                  ->where('order_id' ,  $order_id)
                  ->where('product_id' , $product_id)
                  ->increment('quantity');

    }

    public function decrementQuantity($product_id, $order_id)
    {   
      // decrement only if item qunatity > 1
        \DB::table('ta_order_products')
                  ->where('order_id' ,  $order_id)
                  ->where('product_id' , $product_id)
                  ->where('quantity' , '>', 1)
                  ->decrement('quantity');
    }


    public function deleteProductFromcart($product_id, $order_id)
    {
        \DB::table('ta_order_products')
            ->where('product_id', '=', $product_id)
            ->where('order_id', '=', $order_id)
            ->delete();
    }

    public function deleteAllproductsIncart($order_id)
    {
        \DB::table('ta_order_products')
            ->where('order_id', '=', $order_id)
            ->delete();
    }




    public function getProductIdByCode($code)
    {

        $q = \DB::select(
            \DB::raw("SELECT product_id FROM ta_products WHERE code = :code"),

            array(':code' => $code)
        );

        $product_id = $q[0]->product_id;
        return $product_id;
    }



    public function getTotalAmountOrderId($user_id)
    {
        // return the total sum of all the products that don't have a "product promo"
        $q1 = \DB::select(
            \DB::raw("SELECT A.order_id, SUM(B.quantity*C.price) as normal_total
                      FROM ta_orders as A
                      LEFT JOIN ta_order_products as B ON A.order_id = B.order_id
                      LEFT JOIN ta_products as C on B.product_id = C.product_id
                      WHERE A.user_id = :user_id
                      AND A.order_status_id IN (1,4)
                      AND C.product_id NOT IN (
                          SELECT C.product_id
                          FROM ta_orders as A
                          LEFT JOIN ta_order_products as B ON A.order_id = B.order_id
                          LEFT JOIN ta_products as C on B.product_id = C.product_id
                          WHERE A.user_id = :user_id_2
                          AND (C.promo_start_date IS NOT NULL AND C.promo_end_date IS NOT NULL) 
                          AND (NOW() >= C.promo_start_date AND NOW() <= C.promo_end_date)
                          AND A.order_status_id IN (1,4)
                      )
                      GROUP BY B.order_id"),

            array(':user_id' => $user_id,
                  ':user_id_2' => $user_id)
        );

        // return the total sum of all the products that have a "product promo"
        $q2 = \DB::select(
            \DB::raw("SELECT A.order_id, SUM(B.quantity*C.price*((100-C.percentage)/100)) as promo_total
                          FROM ta_orders as A
                          LEFT JOIN ta_order_products as B ON A.order_id = B.order_id
                          LEFT JOIN ta_products as C on B.product_id = C.product_id
                          WHERE A.user_id = :user_id
                          AND (C.promo_start_date IS NOT NULL AND C.promo_end_date IS NOT NULL) 
                          AND (NOW() >= C.promo_start_date AND NOW() <= C.promo_end_date)
                          AND A.order_status_id IN (1,4)
                          GROUP BY B.order_id"),

            array(':user_id' => $user_id)
        );
        
        // set to 0 the subtotal in case $q1 doesn't exist
        if(empty($q1))
          $normal_total = 0;
        else
          $normal_total =  $q1[0]->normal_total;

        // set to 0 the subtotal in case $q2 doesn't exist
        if(empty($q2))
          $promo_total = 0;
        else
          $promo_total =  $q2[0]->promo_total;


        // add the 2 results $q1 + $q2
        $total_amount = $normal_total + $promo_total;

        if(empty($q2))
          $q = $q1;
        else
          $q = $q2;

        $q[0]->total = $total_amount;

        return $q;
    }



    public function updateWhenCashOnDelivery($user_id, $order_id, $original_price, $promo_price, $promo_id, $total_amout, $firstname, $lastname, $email, $phone, $country, $city, $shipping_address)
    {
        \DB::table('ta_orders')
            ->where('user_id' ,  $user_id)
            ->where('order_id' , $order_id)
            ->update(array(
                      'original_price' => $original_price,
                      'promo_price' => $promo_price,
                      'promo_id' => $promo_id,
                      'purchase_price' => $total_amout,
                      'order_status_id' => 2,
                      'firstname' => $firstname,
                      'lastname'=> $lastname,
                      'email'=> $email,
                      'phone'=> $phone,
                      'country' => $country,
                      'city'=> $city,
                      'shipping_address' => $shipping_address,
                      'payment_method_id' => 1,
                      'purchase_date' => Carbon::now('Asia/Beirut')
                    ));
    }



    public function updateBankPayment($user_id, $order_id, $original_price, $promo_price, $promo_id, $total_amout, $firstname, $lastname, $email, $phone,                                $country, $city, $shipping_address, $audi_order_ref, $audi_order_id, $audi_transaction_status, $audi_transaction_response,                                $audi_issuer_response,$audi_receipt_number, $audi_card_type, $order_status_id)
    {
        \DB::table('ta_orders')
            ->where('user_id' ,  $user_id)
            ->where('order_id' , $order_id)
            ->update(array(
                      'original_price' => $original_price,
                      'promo_price' => $promo_price,
                      'promo_id' => $promo_id,
                      'purchase_price' => $total_amout,
                      'order_status_id' => $order_status_id,
                      'firstname' => $firstname,
                      'lastname'=> $lastname,
                      'email'=> $email,
                      'phone'=> $phone,
                      'country' => $country,
                      'city'=> $city,
                      'shipping_address' => $shipping_address,
                      'payment_method_id' => 2,
                      'purchase_date' => Carbon::now('Asia/Beirut'),
                      'audi_order_reference' => $audi_order_ref,
                      'audi_order_id' => $audi_order_id,
                      'audi_transaction_status' => $audi_transaction_status,
                      'audi_transaction_response' => $audi_transaction_response,
                      'audi_issuer_response' => $audi_issuer_response,
                      'audi_receipt_number' => $audi_receipt_number,
                      'audi_card_type' => $audi_card_type
                    ));
    }



    public function getAllTransactions()
    {
      $q = \DB::select(
            \DB::raw("SELECT A.order_id, A.paypal_order_id, A.user_id, A.original_price, A.purchase_price, A.country, A.purchase_date, A.audi_order_id, A.order_status_id, B.name as payment_status, C.name as payment_method, D.username, E.title, E.percentage
              FROM ta_orders A
              JOIN ta_order_status B ON A.order_status_id = B.order_status_id
              JOIN ta_payment_methods C ON A.payment_method_id = C.payment_method_id
              JOIN users D ON A.user_id = D.id
              LEFT JOIN ta_promo E ON A.promo_id = E.promo_id
              WHERE A.order_status_id != 1
              ORDER BY purchase_date DESC")
        );
                  
        return $q;
    }



    public function updateOrderStatusId($input, $order_status_id)
    {
        \DB::table('ta_orders')
            ->where('order_id' , $input)
            ->update(array('order_status_id' => $order_status_id));
    }



    public function getOrderIdInfo($order_id)
    {
      $q = \DB::select(
            \DB::raw("SELECT A.*, B.name as payment_status, C.name as payment_method, D.title, D.percentage, B.name as order_status
                      FROM ta_orders A
                      JOIN ta_order_status B ON A.order_status_id = B.order_status_id
                      JOIN ta_payment_methods C ON A.payment_method_id = C.payment_method_id
                      LEFT JOIN ta_promo D ON A.promo_id = D.promo_id
                      WHERE A.order_id = :order_id"),
                array('order_id' => $order_id)
        );
                  
        return $q;
    }



    public function getProductsFromOrderId($order_id)
    {

        $q = \DB::select(
            \DB::raw("SELECT B.*, C.code, C.title, C.price, C.img1
                      FROM ta_orders as A
                      JOIN ta_order_products as B ON A.order_id = B.order_id
                      JOIN ta_products as C ON B.product_id = C.product_id
                      WHERE A.order_id = :order_id"),
            array(':order_id' => $order_id)
        );
                  
        return $q;
    }


    public function updatePayPalPayment($user_id, $order_id, $paypal_order_id, $original_price, $promo_price, $promo_id, $total_amount, $firstname, $lastname, $email, $phone,$country, $city, $shipping_address, $paypal_resp_msg, $order_status_id)
    {
        \DB::table('ta_orders')
            ->where('user_id' ,  $user_id)
            ->where('order_id' , $order_id)
            ->update(array(
                'paypal_order_id' => $paypal_order_id,
                'original_price' => $original_price,
                'promo_price' => $promo_price,
                'promo_id' => $promo_id,
                'purchase_price' => $total_amount,
                'order_status_id' => $order_status_id,
                'firstname' => $firstname,
                'lastname'=> $lastname,
                'email'=> $email,
                'phone'=> $phone,
                'country' => $country,
                'city'=> $city,
                'shipping_address' => $shipping_address,
                'payment_method_id' => 3,
                'purchase_date' => Carbon::now('Asia/Beirut'),
                'paypal_resp_msg' => $paypal_resp_msg
              ));
    }


}

