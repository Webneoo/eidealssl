<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class EditAccountForm extends FormValidator {

    /**
     * Validation Rules for the Sign Up form
     *
     * @var array
     */

    protected $rules =[
        'firstname' => 'required',
        'lastname' => 'required',
        'phone' =>  array('required', 'min:8', 'regex:/^[0-9\+]+$/'),
        'birth_date'  => 'date_format:Y-m-d',
        'city' => 'required',
        'address' => 'required'
    ];

} 