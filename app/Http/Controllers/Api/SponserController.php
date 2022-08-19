<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SponserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $sponsers = Sponser::with('country')->select('name', 'country_id', 'address', 'type', 'phone', 'email')->get();

        return $sponsers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type == 'personal') {

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


            $sponser = Sponser::insert([
                'name' => $name,
                'country_id' => $country,
                'city_id' => $city,
                'nationality' => $nationality,
                'telephone' => $telephone,
                'address' => $address,
                'email' => $email,
                'phone' => $phone,
                'ident_type' => $ident_type,
                'identifier' => $identifier,
                'type' => $type,
            ]);


            return Response::json($sponser, 201);
        }

        if ($request->type == 'institution') {
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


            $sponser = Sponser::insert([
                'name' => $name,
                'address' => $address,
                'responsible_name' => $responsible_name,
                'email' => $email,
                'phone' => $phone,
                'phone2' => $phone2,
                'country_id' => $country,
                'type' => $type,
            ]);

            return Response::json($sponser, 201);
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
        if ($sponser->type == 'personal') {
            return Response::json([
                'name' => $sponser->name,
                'country' => $sponser->country->name,
                'city' => $sponser->city->name,
                'ident type' => $sponser->ident_type,
                'identifier' => $sponser->identifier,
                'email' => $sponser->email,
                'phone' => $sponser->phone,
                'telephone' => $sponser->telephone,
                'address' => $sponser->address,
            ], 200);
        }

        if ($sponser->type == 'institution') {
            return Response::json([
                'name' => $sponser->name,
                'country' => $sponser->country->name,
                'email' => $sponser->email,
                'responsible name' => $sponser->responsible_name,
                'phone' => $sponser->phone,
                'phone2' => $sponser->phone2,
                'address' => $sponser->address,
            ], 200);
        }
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

        if ($sponser->type == 'personal') {
            $request->validate([
                'first_name' => 'sometimes|required|string|max:50',
                'second_name' => 'sometimes|required|string|max:50',
                'third_name' => 'sometimes|required|string|max:50',
                'family_name' => 'sometimes|required|string|max:50',
                'country_id' => 'sometimes|required|exists:countries,id',
                'city_id' => 'sometimes|required|exists:cities,id',
                'telephone' => 'sometimes|required|integer|digits:7',
                'phone' => 'sometimes|required|string|min:13|max:13',
                'nationality' => 'sometimes|required',
                'email' => 'sometimes|required|email|unique:sponsers,email,' . $id,
                'ident_type' => 'sometimes|required|in:identification,passport',
                'identifier' => 'sometimes|required|digits:10',
                'address' => 'sometimes|required',
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


            if($name){
                $sponser->name = $name;
            }
            
            if($country){
                $sponser->country_id = $country;
            }
            
            if($city){
                $sponser->city_id = $city;
            }

            if($telephone){
                $sponser->telephone = $telephone;
            }

            if($identifier){
                $sponser->identifier = $identifier;
            }

            if($address){
                $sponser->address = $address;
            }


            if($email){
                $sponser->email = $email;
            }

            if($nationality){
                $sponser->nationality = $nationality;
            }

            if($ident_type){
                $sponser->ident_type = $ident_type;
            }

            if($phone){
                $sponser->phone = $phone;
            }

            $sponser->save();

            return Response::json([
                'message' => 'Sponser Updated!',
            ]);
        }

        if ($sponser->type == 'institution') {

            $sponser = Sponser::findOrFail($id);


            $request->validate([
                'name' => 'sometimes|required|string|max:100',
                'address' => 'sometimes|required|max:255',
                'responsible_name' => 'sometimes|required|string|max:100',
                'phone' => 'sometimes|required|size:13',
                'phone2' => 'sometimes|required|size:13',
                'email' => 'sometimes|required|email|unique:sponsers,email',
                'country_id' => 'sometimes|required|exists:countries,id'
            ]);

            $name = $request->name;
            $email = $request->email;
            $phone = $request->phone;
            $phone2 = $request->phone2;
            $address = $request->address;
            $responsible_name = $request->responsible_name;
            $country = $request->country_id;

            if($name){
                $sponser->name = $name;
            }

            if($email){
                $sponser->email = $email;
            }

            if($phone){
                $sponser->phone = $phone;
            }

            if($phone2){
                $sponser->phone2 = $phone2;
            }
            
            if($responsible_name){
                $sponser->responsible_name = $responsible_name;
            }

            if($address){
                $sponser->address = $address;
            }

            if($country){
                $sponser->country_id = $country;
            }

            $sponser->save();

            return Response::json([
                'message' => 'Sponser Updated!',
            ], 200);
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
        $sponser = Sponser::findOrFail($id);
        $sponser->delete();

        return Response::json([
            'message' => 'Sponser Deleted!',
        ]);
    }
}
