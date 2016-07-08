<?php

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class CheckoutForm extends FormValidator {

    /**
     * Validation Rules for the Sign Up form
     *
     * @var array
     */

    protected $rules =[
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'country' => 'required',
        'city' => 'required',
        'address' => 'required',
        'payement' => 'required'
    ];

} 