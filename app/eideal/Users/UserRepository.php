<?php namespace eideal\Users;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class UserRepository {

    public function resetPassword($input)
    {
        $password =\DB::table('users as A')
            ->where('A.id', '=', Auth::user()->id)
            ->select('A.password')
            ->first();


        if (Hash::check($input['old_password'], $password->password))
        {
            \DB::table('users')
                ->where('id', '=', Auth::user()->id)
                ->update(
                    array('password' => Hash::make($input['password']),
                        'updated_at' => date("Y-m-d H:i:s"))
                );

            return $old_password = true;
        }
        else
        {
            return $old_password = false;
        }
    }

    public function resetPasswordByUsername($username)
    {
        $random_string = "";

        $valid_chars = 'ABCDEFGHIJKLBNOPQRSTUVWXYZ1234567890';

        $num_valid_chars = strlen($valid_chars);

        for ($i = 0; $i < 10; $i++) {
            $random_pick = mt_rand(1, $num_valid_chars);

            $random_char = $valid_chars[$random_pick - 1];

            $random_string .= $random_char;
        }


        \DB::table('users')
            ->where('username', '=', $username)
            ->update(
                array('password' => Hash::make($random_string),
                    'updated_at' => date("Y-m-d H:i:s"))
            );

        return $random_string;


    }

    public function getUsersList()
    {   
          $q = \DB::select(
                \DB::raw("SELECT * FROM users")
        );

        return $q;
    }


    public function deleteUser($user_id)
    {
        \DB::table('users')
            ->where('id', '=', $user_id)
            ->delete();
    }

    public function getUserInfoById($user_id)
    {   

         $q = \DB::select(
            \DB::raw("SELECT * FROM users 
                      WHERE id = :user_id"),
            array(':user_id' => $user_id)
            );

        return $q;
    }

    public function updateUserInfo($user_id, $input)
    {
        $q = \DB::select(
            \DB::raw(" UPDATE users
                        SET firstname = :firstname,
                        lastname = :lastname,
                        phone = :phone,
                        birth_date = :birth_date,
                        email = :email,
                        city = :city,
                        address = :address
                      WHERE id = :user_id"),
            array(':user_id' => $user_id,
                ':firstname' => $input['firstname'],
                ':lastname' => $input['lastname'],
                ':phone' => $input['phone'],
                ':birth_date' => $input['birth_date'],
                ':email' => $input['email'],
                ':city' => $input['city'],
                ':address' => $input['address'])
        );

    }

    public function updatePasswordByUserId($user_id, $random_password)
    {
        $q = \DB::select(
            \DB::raw(" UPDATE users
                        SET password = :password
                      WHERE id = :user_id"),
            array(':password' => Hash::make($random_password),
                  ':user_id' => $user_id)
        );
    }


    public function getUserInfoByUsername($username)
    {
        $q = \DB::select(
            \DB::raw("SELECT * FROM users as A WHERE A.username = :username"),
            array(':username' => $username)
        );

        return $q;
    }



    public function addNewUser($formData)
    {


        \DB::table('users')->insert(
            array('username' => $formData['username'],
                'email' => $formData['email'],
                'firstname' => $formData['firstname'],
                'lastname' => $formData['lastname'],
                'password' => Hash::make($formData['password']),
                'phone' => $formData['phone'],
                'birth_date' => $formData['birthDay'],
                'newsletters' => $formData['newsletters'],
                'country' => $formData['country'],
                'city' => $formData['city'],
                'address' => $formData['address'],
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
                'admin' => 0
        ));


    }

}

