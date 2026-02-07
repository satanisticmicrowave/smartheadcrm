<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\View\View;

class WidgetController extends Controller
{
    public function getWidget(Request $request): View
    {
        return view('widget.feedback');
    }
}
