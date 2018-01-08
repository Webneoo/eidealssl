<?php

use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;


class ImageController extends \BaseController {

    // function that fix the name of the image by removing all the illegal characters
    public function fixFileName($fileName)
    {
        $fileName = str_replace("#", "", $fileName);
        $fileName = str_replace("$", "", $fileName);
        $fileName = str_replace("%", "", $fileName);
        $fileName = str_replace("^", "", $fileName);
        $fileName = str_replace("&", "", $fileName);
        $fileName = str_replace("*", "", $fileName);
        $fileName = str_replace("?", "", $fileName);
        $fileName = str_replace("'","",$fileName);
        $fileName = str_replace("\"","",$fileName);
        $fileName = str_replace("\\","",$fileName);
        $fileName = str_replace("/","",$fileName);
        $fileName = str_replace(" - ","_",$fileName);
        $fileName = str_replace(" ","_",$fileName);
        $fileName = str_replace("-","_",$fileName);
        $fileName = strtolower($fileName);

        return($fileName);
    }
}




