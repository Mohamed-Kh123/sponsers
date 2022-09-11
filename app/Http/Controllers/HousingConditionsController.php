<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\HousingCondition;
use Illuminate\Http\Request;

class HousingConditionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('house.index',[
            'houses' => HousingCondition::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('house.create', [
            'house' => new HousingCondition(),
            'beneficiaries' => Beneficiary::all(),
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
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'housing_property' => 'required',
            'rent_value' => 'required',
            'room_numbers' => 'required|Numeric',
            'number_of_people_in_the_same_room' => 'required|Numeric',
            'building_condition' => 'required',
            'building_type' => 'required',
            'building_erea' => 'required',
            'furniture_case' => 'required',
            'descriprion' => 'required',
        ]);

        HousingCondition::create($request->all());
        return redirect()->route('house.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('house.edit', [
            'house' => HousingCondition::findOrFail($id),
            'beneficiaries' => Beneficiary::all(),
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
        $house = HousingCondition::findOrFail($id);
        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'housing_property' => 'required',
            'rent_value' => 'required',
            'room_numbers' => 'required|Numeric',
            'number_of_people_in_the_same_room' => 'required|Numeric',
            'building_condition' => 'required',
            'building_type' => 'required',
            'building_erea' => 'required',
            'furniture_case' => 'required',
            'descriprion' => 'required',
        ]);

        $house->update($request->all());
        return redirect()->route('house.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        HousingCondition::destroy($id);

        return redirect()->back();
    }
}
