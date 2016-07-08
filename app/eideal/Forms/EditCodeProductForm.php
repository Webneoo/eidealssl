<?php

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class EditCodeProductForm extends FormValidator {

    /**
     * Validation Rules for the Sign In form
     *
     * @var array
     */

    protected $rules =[
        'product_code' => 'required|unique:ta_products,code',
    ];

} 