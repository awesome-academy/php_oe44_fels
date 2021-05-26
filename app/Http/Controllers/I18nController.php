<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class I18nController extends Controller
{
    private $listOptionI18n = [
        'en',
        'vi',
    ];
    
    public function changes(Request $request, $option)
    {
        if(in_array($option, $this->listOptionI18n)){
            $request->session()->put(['i18n'=>$option]);
            
            return redirect()->back();
        }
    }
}
