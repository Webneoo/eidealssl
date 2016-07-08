<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class CreateProductForm extends FormValidator {

    /**
     * Validation Rules for the Sign In form
     *
     * @var array
     */

    protected $rules =[
        'product_category' => 'required',
        'product_code' => 'required|unique:ta_products,code',
        'product_title' => 'required',
        'product_short_desc' => 'required',
        'product_long_desc' => 'required',
        'product_price' => 'required',
        'product_img_1' => 'image|required|mimes:jpeg,bmp,png,jpg',
        'product_date' => 'required'

    ];

} 