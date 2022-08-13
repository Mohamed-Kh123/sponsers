<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Sponser;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Nationality;
use Illuminate\Support\Facades\DB;

class SponsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsers = Sponser::with('country')->with('city')->paginate();
        return view('admin.sponser.index', [
            'sponsers' => $sponsers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $cities = City::all();
        return view('admin.sponser.create', [

            'sponser' => new Sponser(),
            'countries' => $countries,
            'cities' => $cities,
        ]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == 'personal'){
            $request->validate([
                'first_name' => 'required|string|max:50',
                'second_name' => 'required|string|max:50',
                'third_name' => 'required|string|max:50',
                'family_name' => 'required|string|max:50',
                'type' => 'required|in:personal,institution',
                'country_id' => 'required|exists:countries,id',
                'city_id' => 'required|exists:cities,id',
                'telephone' => 'required|integer|digits:7',
                'phone' => 'required|string|min:13|max:13',
                'nationality' => 'required',
                'email' => 'required|email|unique:sponsers,email',
                'ident_type' => 'required|in:identification,passport',
                'identifier' => 'required|digits:10',
                'address' => 'required',
            ]);
            $name = $request->first_name . ' ' . $request->second_name . ' ' . $request->third_name . ' ' . $request->family_name;
            $country = $request->country_id;
            $city = $request->city_id;
            $telephone = $request->telephone;
            $address = $request->address;
            $identifier = $request->identifier;
            $email = $request->email;
            $nationality = $request->nationality;
            $ident_type = $request->ident_type;
            $phone = $request->phone;
            $type = $request->type;
            
            
            Sponser::insert([
                'name' =>$name, 
                'country_id' =>$country,
                'city_id' =>$city, 
                'nationality' =>$nationality, 
                'telephone' =>$telephone, 
                'address' =>$address, 
                'email' =>$email, 
                'phone' =>$phone, 
                'ident_type' =>$ident_type, 
                'identifier' =>$identifier,
                'type' => $type,
            ]);
            return redirect()->route('sponsers.index')->with('success', 'Sponser Added Successfully!');
        }
        elseif($request->type == 'institution'){
            $request->validate([
                'name' => 'required|string|max:100', 
                'address' => 'required|max:255',
                'responsible_name' => 'required|string|max:100',
                'phone' => 'required|size:13',
                'type' => 'required|in:personal,institution',
                'phone2' => 'required|size:13',
                'email' => 'required|email|unique:sponsers,email',
                'country_id' => 'required|exists:countries,id'
            ]);

            $name = $request->name;
            $address = $request->address;
            $responsible_name = $request->responsible_name;
            $email = $request->email;
            $country = $request->country_id;
            $phone = $request->phone;
            $phone2 = $request->phone2;
            $type = $request->type;


            Sponser::insert([
                'name' => $name,
                'address' => $address,
                'responsible_name' => $responsible_name,
                'email' => $email,
                'phone' => $phone,
                'phone2' => $phone2,
                'country_id' => $country,
                'type' => $type,
            ]);

            return redirect()->route('sponsers.index')->with('success', 'Sponser Added Successfully!');         
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sponser = Sponser::findOrFail($id);
        return view('admin.sponser.show', [
            'sponser' => $sponser,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.sponser.edit', [
            'sponser' => Sponser::findOrFail($id),
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sponser = Sponser::findOrFail($id);
        if($request->type == 'personal'){
            $request->validate([
                'first_name' => 'required|string|max:50',
                'second_name' => 'required|string|max:50',
                'third_name' => 'required|string|max:50',
                'family_name' => 'required|string|max:50',
                'type' => 'required|in:personal,institution',
                'country_id' => 'required|exists:countries,id',
                'city_id' => 'required|exists:cities,id',
                'telephone' => 'required|integer|digits:7',
                'phone' => 'required|string|min:13|max:13',
                'nationality' => 'required',
                'email' => 'required|email|unique:sponsers,email,'.$id,
                'ident_type' => 'required|in:identification,passport',
                'identifier' => 'required|digits:10',
                'address' => 'required',
            ]);
            $name = $request->first_name . ' ' . $request->second_name . ' ' . $request->third_name . ' ' . $request->family_name;
            $country = $request->country_id;
            $city = $request->city_id;
            $telephone = $request->telephone;
            $address = $request->address;
            $identifier = $request->identifier;
            $email = $request->email;
            $nationality = $request->nationality;
            $ident_type = $request->ident_type;
            $phone = $request->phone;
            $type = $request->type;
            
            
           $sponser->name = $name;
           $sponser->country_id = $country;
           $sponser->city_id = $city;
           $sponser->telephone = $telephone;
           $sponser->identifier = $identifier;
           $sponser->address = $address;
           $sponser->email = $email;
           $sponser->nationality = $nationality;
           $sponser->ident_type = $ident_type;
           $sponser->phone = $phone;
           $sponser->type = $type;
           $sponser->save();
            return redirect()->route('sponsers.index')->with('success', 'Sponser Added Successfully!');
        }
        elseif($request->type == 'institution'){
            $request->validate([
                'name' => 'required|string|max:100', 
                'address' => 'required|max:255',
                'responsible_name' => 'required|string|max:100',
                'phone' => 'required|size:13',
                'type' => 'required|in:personal,institution',
                'phone2' => 'required|size:13',
                'email' => 'required|email|unique:sponsers,email,'.$id,
                'country_id' => 'required|exists:countries,id',
            ]);

            $name = $request->name;
            $address = $request->address;
            $responsible_name = $request->responsible_name;
            $email = $request->email;
            $country_id = $request->country_id;
            $phone = $request->phone;
            $phone2 = $request->phone2;
            $type = $request->type;


            $sponser->name = $name;
            $sponser->address = $address;
            $sponser->responsible_name = $responsible_name;
            $sponser->email = $email;
            $sponser->country_id = $country_id;
            $sponser->phone = $phone;
            $sponser->phone2 = $phone2;
            $sponser->type = $type;

            $sponser->save();

            return redirect()->route('sponsers.index')->with('success', 'Sponser Updated Successfully!');         
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sponser::destroy($id);
        return redirect()->back()->with('success', 'Sponser Deleted!');
    }

    public function getCities()
    {
        $country_id = request('country');
        $cities = City::where('country_id', $country_id)->get();
        foreach($cities as $city){
            $option = "<option value=". $city->id .">$city->name</option>";
        }
        return $option;
    }

}
