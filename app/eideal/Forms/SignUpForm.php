<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class SignUpForm extends FormValidator {

    /**
     * Validation Rules for the Sign Up form
     *
     * @var array
     */

    protected $rules =[
        'username' => 'required|unique:users,username',
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' =>  array('required'),
        'birth_month' => array('required'),
        'birth_day' => array('required'),
        'birth_year' => array('required'),
        'password' => 'required|min:6',
        're-password' => 'required|min:6|same:password',
        'country' => 'required',
        'city' => 'required',
        'address' => 'required'
    ];

} 