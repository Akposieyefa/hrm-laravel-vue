<?php
namespace App\Helpers;

class SystemHelper
{
    public function cleanStringHelper($string): mixed
    {
        if (is_null($string)) {
            return "";
        }else {
            return $string;
        }
    }
}
