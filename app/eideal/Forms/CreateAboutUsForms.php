<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class CreateAboutUsForms extends FormValidator {

    /**
     * Validation Rules for the Sign In form
     *
     * @var array
     */

    protected $rules =[
        'text1' => 'required',
        'about_us_txt_1' => 'required',
        'text2' => 'required',
        'about_us_txt_2' => 'required',
        'text3' => 'required',
        'about_us_txt_3' => 'required'
    ];

} 