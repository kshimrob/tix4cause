<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cause;

class CauseCheckoutController extends Controller
{
    public function index() 
    {
        // $existing_categories = [];
        // $causes = [];

        // If featured exists get featured cause
        // if (Cause::where('featured', 1)->exists()) {
        //     $featured = Cause::where('featured', '=', 1)->get();
        //     $existing_categories = [$featured[0]->category];
        // }

        // $cause_1 = Cause::where('display', '=', 1)->where('featured', '!=', 1)->whereNotIn('category', $existing_categories)->inRandomOrder()->take(1)->get();
        // array_push($existing_categories, $cause_1[0]->category);

        // $cause_2 = Cause::where('display', '=', 1)->where('featured', '!=', 1)->whereNotIn('category', $existing_categories)->inRandomOrder()->take(1)->get();
        // array_push($existing_categories, $cause_2[0]->category);

        // if there was no featured then find a third cause and push causes to array, or else
        // if (count($existing_categories) < 3) {
        //     $cause_3 = Cause::where('display', '=', 1)->where('featured', '!=', 1)->whereNotIn('category', $existing_categories)->inRandomOrder()->take(1)->get();
        //     array_push($existing_categories, $cause_3[0]->category);
        //     array_push($causes, $cause_1[0], $cause_2[0], $cause_3[0]);
        // } else {
        //     array_push($causes, $featured[0], $cause_1[0], $cause_2[0]);
        // }

        $causes = Cause::where('display', '=', 1)->inRandomOrder()->take(3)->get();
        return view('causecheckout')->with([
            'causes'=> $causes,
        ]);
    }

    public function show($slug)
    {
        $cause = Cause::where('slug', $slug)->firstOrFail();
        return view('cause')->with([
            'cause'=> $cause,
        ]);
    }
}
