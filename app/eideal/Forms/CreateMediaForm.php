<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class CreateMediaForm extends FormValidator {

    /**
     * Validation Rules for the Sign In form
     *
     * @var array
     */

    protected $rules =[
        'media_date' => 'required',
        'media_image' => 'image|required|mimes:jpeg,bmp,png,jpg',
    ];

} 