<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiaries;
use App\Models\City;
use App\Models\Country;
use App\Models\Sponser;
use Illuminate\Http\Request;

class SearchController extends Controller
{

  public function index()
  {
    return view('admin.search', [
      'countries' => Country::all(),
    ]);
  }


  public function searchSponsers(Request $request)
  { 
    $name = $request['name'];
    $identifier = $request['identifier'];
    $country = $request['country_id'];
    $city = $request['city_id'];
    $nationality = $request['nationality'];
    $type =  $request['type'];
    $responsible_name = $request['responsible_name'];
    
    
    if ($request->type == 'personal') {
      $sponsers = new Sponser();

        if($type){
          $sponsers = $sponsers->where('type', '=', 'personal');
        }

        if($name){
          $sponsers = $sponsers->where('name', 'like', "%$name%");
        }

        if($country){
          $sponsers = $sponsers->where('country_id', '=', $country);
        }

        if($city){
          $sponsers = $sponsers->where('city_id', '=', $city);
        }

        if($nationality){
          $sponsers = $sponsers->where('nationality', '=', $nationality);
        }

        if($identifier){
          $sponsers = $sponsers->where('identifier', '=', $identifier);
        }

        $sponsers = $sponsers->get();
        

      return view('admin.results', compact('sponsers'));
    }elseif($request->type == 'institution'){
      $sponsers = new Sponser();

      if($type){
        $sponsers = $sponsers->where('type', '=', 'institution');
      }

      if($name){
        $sponsers = $sponsers->where('name', 'like', "%$name%");
      }

      if($country){
        $sponsers = $sponsers->where('country_id', '=', $country);
      }

      if($responsible_name){
        $sponsers = $sponsers->where('responsible_name', '=', $responsible_name);
      }

      $sponsers = $sponsers->get();

      return view('admin.results', compact('sponsers'));
    }
  }

  public function searchBeneficiary(Request $request)
  {
    
    $beneficiaries = new Beneficiaries();

    $name = $request['name'];
    $type = $request['type'];
    $sponser_id = $request['sponser_id'];

    if($name){
      $beneficiaries = $beneficiaries->where('name', '=', $name);
    }

    if($type){
      $beneficiaries = $beneficiaries->where('type', '=', $beneficiaries);
    }

    if($sponser_id){
      $beneficiaries = $beneficiaries->where('sponser_id', '=', $sponser_id);
    }

    
  }

  public function getCities()
  {
    $country_id = request('country');
    $cities = City::where('country_id', $country_id)->get();
    return $cities;
  }
}
