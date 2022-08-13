<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Sponser;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    public function search(Request $request)
    {
            $countries = Country::all();

            $search_name = request()->query('name');
            $search_identifier = request()->query('identifier');
            $search_country = request()->query('country_id');
            $search_city = request()->query('city_id');
            $search_nationality = request()->query('nationality');
    
            if($search_city && $search_country && $search_identifier && $search_name && $search_nationality){

                $sponser = Sponser::with('country')->where('name', 'LIKE', '%'.$search_name.'%')
                ->where('identifier', 'LIKE', '%'.$search_identifier.'%')
                ->where('country_id', 'LIKE', '%'.$search_country.'%')
                ->where('city_id', 'LIKE', '%'.$search_city.'%')
                ->where('nationality', 'LIKE', '%'.$search_nationality.'%')
                ->get();
                
            }
            
            return view('admin.search', [
                'countries' => $countries,
                'sponser' => $sponser,
            ]);
        }
}

