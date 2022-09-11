<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\City;
use App\Models\Guardian;
use Illuminate\Http\Request;

class GuardiansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guardian.index', [
            'guardians' => Guardian::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guardian.create', [
            'guardian' => new Guardian,
            'cities' => City::all(),
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
                'first_name' => 'required|max:50',
                'second_name' => 'required|max:50',
                'third_name' => 'required|max:50',
                'family_name' => 'required|max:50',
                'identefier' => 'required|size:10|unique:guardians,identefier',
                'beneficiary_id' => 'required|exists:beneficiaries,id',
                'birth_date' => 'required|date|before:guardianship_date',
                'guardianship_date' => 'required|date|after:birth_date',
                'type' => 'required|in:وصي,ولي,حاضن',
                'mobile_number' => 'required|size:13',
                'relation' => 'required',
                'address' => 'required',
                'the_trustee' => 'required',
                'city' => 'required',
            ]);
            $name = $request->first_name . ' ' . $request->second_name . ' ' . $request->third_name . ' ' . $request->family_name;
            $identefier = $request->identefier;
            $beneficiary_id = $request->beneficiary_id;
            $birth_date = $request->birth_date;
            $type = $request->type;
            $address = $request->address;
            $city = $request->city;
            $relation = $request->relation;
            $mobile_number = $request->mobile_number;
            $the_trustee = $request->the_trustee;
            $guardianship_date = $request->guardianship_date;

            Guardian::create([
                'name' => $name,
                'identefier' => $identefier,
                'beneficiary_id' => $beneficiary_id,
                'type' => $type,
                'address' => $address,
                'birth_date' => $birth_date,
                'city' => $city,
                'relation' => $relation,
                'mobile_number' => $mobile_number,
                'the_trustee' => $the_trustee,
                'guardianship_date' => $guardianship_date,
            ]);

            return redirect()->route('guardian.index')->with('success', 'تم إضافة بنجاح');
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
        return view('guardian.edit', [
            'guardian' => Guardian::findOrFail($id),
            'beneficiaries' => Beneficiary::all(),
            'cities' => City::all(),
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
        $guardian = Guardian::findOrFail($id);
            $request->validate([
                'first_name' => 'required|max:50',
                'second_name' => 'required|max:50',
                'third_name' => 'required|max:50',
                'family_name' => 'required|max:50',
                'identefier' => 'required|size:10|unique:guardians,identefier,'. $id,
                'beneficiary_id' => 'required|exists:beneficiaries,id',
                'birth_date' => 'required|date|before:guardianship_date',
                'guardianship_date' => 'required|date|after:birth_date',
                'type' => 'required|in:وصي,ولي,حاضن',
                'mobile_number' => 'required|size:13',
                'relation' => 'required',
                'address' => 'required',
                'the_trustee' => 'required',
                'issuance_place' => 'required',
                'city' => 'required',
            ]);

            $name = $request->first_name . ' ' . $request->second_name . ' ' . $request->third_name . ' ' . $request->family_name;
            $identefier = $request->identefier;
            $beneficiary_id = $request->beneficiary_id;
            $birth_date = $request->birth_date;
            $type = $request->type;
            $address = $request->address;
            $city = $request->city;
            $relation = $request->relation;
            $mobile_number = $request->mobile_number;
            $the_trustee = $request->the_trustee;
            $guardianship_date = $request->guardianship_date;
            $issuance_place = $request->issuance_place;

            $guardian->update([
                'name' => $name,
                'identefier' => $identefier,
                'beneficiary_id' => $beneficiary_id,
                'type' => $type,
                'address' => $address,
                'birth_date' => $birth_date,
                'issuance_place' => $issuance_place,
                'city' => $city,
                'relation' => $relation,
                'mobile_number' => $mobile_number,
                'the_trustee' => $the_trustee,
                'guardianship_date' => $guardianship_date,
            ]);

            return redirect()->route('guardian.index')->with('success', 'تم تحديث الوصي بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Guardian::destroy($id);

        return ;
    }
}
