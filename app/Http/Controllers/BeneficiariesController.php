<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Economic;
use App\Models\Family;
use App\Models\Guardian;
use App\Models\HousingCondition;
use App\Models\Parents;
use Illuminate\Http\Request;

class BeneficiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('beneficiaries.index', [
            'beneficiaries' => Beneficiary::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $beneficiary = new Beneficiary();

        return view('beneficiaries.create', [
            'beneficiary' => $beneficiary,
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
            'type' => 'required|in:حالة انسانية,يتيم الأبوين,يتيم الأب,يتيم الأم,غير يتيم',
        ]);

        Beneficiary::create($request->all());

        return redirect()->route('beneficiary.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);

        return view('beneficiaries.show', [
            'beneficiary' => $beneficiary,
            'family' => Family::where('beneficiary_id', '=', $beneficiary->id)->first(),
            'parent' => Parents::where('beneficiary_id', '=', $beneficiary->id)->first(),
            'house' => HousingCondition::where('beneficiary_id', '=', $beneficiary->id)->first(),
            'guardian' => Guardian::where('beneficiary_id', '=', $beneficiary->id)->first(),
            'economic' => Economic::where('beneficiary_id', '=', $beneficiary->id)->first(),
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
        return view('beneficiaries.edit', [
            'beneficiary' => Beneficiary::findOrFail($id),
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
        $request->validate([
            'type' => 'required|in:حالة انسانية,يتيم الأبوين,يتيم الأب,يتيم الأم,غير يتيم',
        ]);

        $beneficiary = Beneficiary::findOrFail($id);

        $beneficiary->update($request->all());

        return redirect()->route('beneficiary.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Beneficiary::destroy($id);
        
        return redirect()->back();
    }
}
