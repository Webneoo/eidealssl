<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class EditEmailAccountForm extends FormValidator {

    /**
     * Validation Rules for the Sign Up form
     *
     * @var array
     */

    protected $rules =[
        'email' => 'required|email|unique:users,email'

    ];

} 