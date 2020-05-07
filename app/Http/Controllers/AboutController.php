<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function faqIndex()
    {
        return view('about.faq.index');
    }
}
