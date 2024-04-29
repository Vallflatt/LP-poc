<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class PageController
{
    public function home(): View
    {
        return view('pages.home');
    }
}
