<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    private $langActive = [
        'vi',
        'en',
    ];

    public function changeLang(Request $request)
    {
        if (in_array($request->language, $this->langActive)) {
            $request->session()->put(['lang' => $request->language]);
            
            return redirect()->back();
        }
    }
}
