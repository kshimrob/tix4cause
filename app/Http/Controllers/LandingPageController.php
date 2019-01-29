<?php

namespace App\Http\Controllers;

use App\Product;
use App\BlogPost;
use App\PromoEvent;
use Illuminate\Http\Request;
use GeoIP as GeoIP;
use Khsing\World\Models\City;
use Khsing\World\Models\Division;
use Khsing\World\Models\Country;
use Khsing\World\Models\DivisionLocale;
use Khsing\World\World;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('featured', true)->take(8)->inRandomOrder()->get();
        $posts = BlogPost::where('status', 'PUBLISHED')->where('featured', 1)->take(3)->inRandomOrder()->get();
        $long_promos = PromoEvent::where('promo_type', 'long')->where('published', true)->get();
        $short_promos = PromoEvent::where('promo_type', 'short')->where('published', true)->get();

        return view('landing-page')->with([
            'products' => $products,
            'posts' => $posts,
            'long_promos' => $long_promos,
            'short_promos' => $short_promos,
        ]);
    }
    public function current(Request $request) {
        $location = GeoIP::getLocation();
        $city = $location['city'];
        $state = $location['state'];
        $country = $location['country'];

        return response()->json([
            'state'=>$state,
            'city'=>$city,
            'country'=>$country,
            ]);
    }

    // NOTE THAT STATE IS INTERCHANGEABLE WITH DIVISION
    public function input(Request $request) {
        $cityInput = $request->cityInput;
        $stateInput = $request->stateInput;
        $city = City::getByName($cityInput);

        if (is_null($city)) {
            // If city name doesn't match in system then return null for all values
            $country = null;
            $state = null;
        } elseif (empty($stateInput)) {
            // if state isn't inputted by user
            $country = $city->country()->first()->name;

            if ($city->division()->first()) {
                $state = $city->division()->first()->name;
            } else {
                $state = null;
            }

            $city = $city->name;
        } else {
            // match state code (i.e. 'IL') or state name
            if (strlen($stateInput) <= 2) {
                $state = Division::where('code', strtolower($stateInput))->first();
            } else {
                $state = Division::where('name', ucwords(strtolower($stateInput)))->first();
            }

            // see if city exists in the given state
            // if state is null, only check out city
            if (is_null($state)) {
                $country = $city->country()->first()->name;

                if ($city->division()->first()) {
                    $state = $city->division()->first()->name;
                } else {
                    $state = null;
                }
    
                $city = $city->name;
            } else {
                $allCities = City::where('name', $city->name)->get();
                $stateId = $state['id'];
                $stateCityMatch = false;

                // go through each city that has the same name and see if 
                // a city's state id matches the inputted state Id.
                // if no match, ignore state.
                foreach ($allCities as $singleCity) {
                    if ($singleCity['division_id'] === $stateId) {
                        $city = $singleCity;
                        $stateCityMatch = true;
                    }
                }

                if ($stateCityMatch) {
                    $country = $city->country()->first()->name;
                    $city = $city->name;
                    $state = $state['name'];
                } else {
                    $country = $city->country()->first()->name;

                    if ($city->division()->first()) {
                        $state = $city->division()->first()->name;
                    } else {
                        $state = null;
                    }
        
                    $city = $city->name;
                }
                
            }
        }


        return response()->json([
            'city'=> $city,
            'state'=> $state,
            'country'=> $country,
        ]);
    }
}
