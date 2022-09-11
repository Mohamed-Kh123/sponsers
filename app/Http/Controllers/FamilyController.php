<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::all();

        return view('family.index', [
            'families' => $families,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('family.create', [
            'beneficiaries' => Beneficiary::all(),
            'family' => new Family(),
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
            'name' => 'required|string|max:50',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'identifier' => 'required|size:10',
            'birth_date' => 'required|date',
            'gender' => 'required|in:ذكر,أنثى',
            'relation' => 'required|string|max:100',
            'social_status' => 'required',
            'grade' => 'nullable',
            'qualification' => 'nullable',
            'skills' => 'nullable',
            'educational_level' => 'required|in:ممتاز,متوسط,ضعيف',
            'work_nature' => 'nullable',
            'health_status' => 'required|in:سليم,إعاقة,مريض',
            'type_of_disease' => 'nullable',
            'type_of_disability' => 'nullable',
            'beneficiary_type' => 'required|in:غير مستفيد,مستفيد أيواء,مستفيد خدمات',
        ]);

        Family::create($request->all());

        return redirect()->route('family.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('family.edit', [
            'beneficiaries' => Beneficiary::all(),
            'family' => Family::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'identifier' => 'required|size:10',
            'birth_date' => 'required|date',
            'gender' => 'required|in:ذكر,أنثى',
            'relation' => 'required|string|max:100',
            'social_status' => 'required',
            'grade' => 'nullable',
            'qualification' => 'nullable',
            'skills' => 'nullable',
            'educational_level' => 'required|in:ممتاز,متوسط,ضعيف',
            'work_nature' => 'nullable',
            'health_status' => 'required|in:سليم,إعاقة,مريض',
            'type_of_disease' => 'nullable',
            'type_of_disability' => 'nullable',
            'beneficiary_type' => 'required|in:غير مستفيد,مستفيد أيواء,مستفيد خدمات',
        ]);

        $family = Family::findOrFail($id);

        $family->update($request->all());

        return redirect()->route('family.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Family::destroy($id);

        return redirect()->back();
    }
}
