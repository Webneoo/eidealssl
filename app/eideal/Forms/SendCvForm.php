<?php
/**
 * Created by PhpStorm.
 * User: machkar
 * Date: 01/12/2014
 * Time: 18:55
 */

namespace eideal\Forms;

use Laracasts\Validation\FormValidator;

class SendCvForm extends FormValidator {

    /**
     * Validation Rules for the Sign In form
     *
     * @var array
     */

    protected $rules =[
        'fullname' => 'required',
        'birth_date' => 'required',
        'email' => 'required|email',
        'position' => 'required',
        'salary' => 'required',
        'experience' => 'required',
        'cv_upload' => 'required'
    ];

} 