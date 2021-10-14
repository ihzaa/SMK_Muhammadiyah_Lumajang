<?php

namespace App\Utils;

class FlashMessageHelper
{
    public static function bootstrapAlert($data)
    {
        if(isset($data['class']))
        session()->flash('alert-class', $data['class']);
        if(isset($data['icon']))
        session()->flash('alert-icon', $data['icon']);
        if(isset($data['text']))
        session()->flash('alert-text', $data['text']);
    }
}
