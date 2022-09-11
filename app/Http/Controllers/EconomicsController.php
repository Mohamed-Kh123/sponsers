<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\Economic;
use Illuminate\Http\Request;

class EconomicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('economic.index', [
            'economics' => Economic::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('economic.create', [
            'economic' => new Economic(),
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
            'income_rate' => 'required',
            'income_source' => 'required',
            'receive_aid' => 'required|in:نعم,لا',
            'amount_per_month' => 'required',
            'source_orphan_sponsorships' => 'required', 
            'properties' => 'required', 
            'return_value_property' => 'required',
            'total_income_value' => 'required',
            'description' => 'required',
        ]);

        Economic::create($request->all());

        return redirect()->route('economic.index');
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
        
        return view('economic.edit', [
            'economic' => Economic::findOrFail($id),
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
        $economic = Economic::findOrFail($id);

        $request->validate([
            'beneficiary_id' => 'required|exists:beneficiaries,id',
            'income_rate' => 'required',
            'income_source' => 'required',
            'receive_aid' => 'required|in:نعم,لا',
            'amount_per_month' => 'required',
            'source_orphan_sponsorships' => 'required', 
            'properties' => 'required', 
            'return_value_property' => 'required',
            'total_income_value' => 'required',
            'description' => 'required',
        ]);
        $economic->update($request->all());

        return redirect()->route('economic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Economic::destroy($id);

        return redirect()->back();
    }
}
