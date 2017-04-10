<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class EditProductForm extends FormValidator {

    /**
     * Validation Rules for the Sign In form
     *
     * @var array
     */

    protected $rules =[
        'product_category' => 'required',
        'product_title' => 'required',
        'product_short_desc' => 'required',
        'product_long_desc' => 'required',
        'product_date' => 'required'
    ];

} 