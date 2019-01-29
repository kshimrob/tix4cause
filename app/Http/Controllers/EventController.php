<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cause;

class EventController extends Controller
{
    public function index() 
    {
       
        $causes = Cause::where('display', '=', 1)->inRandomOrder()->take(3)->get();
        return view('event')->with([
            'causes'=> $causes,
        ]);
    }

}