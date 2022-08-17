<?php

namespace App\Http\Controllers;

use App\Models\Beneficiaries;
use App\Models\Sponser;
use Carbon\Carbon;
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
        return view('admin.beneficiaries.index', [
            'beneficiaries' => Beneficiaries::paginate(), 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.beneficiaries.create', [
            'beneficiary' => new Beneficiaries(),
            'sponsers' => Sponser::all(),
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
            'name' => 'required|string|max:100',
            'type' => 'required|in:سنوي,شهري',
            'sponser_id' => 'required|exists:sponsers,id',
        ]);

        Beneficiaries::create($request->all());

        return redirect()->route('beneficiary.index')->with('success', 'Beneficiary Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beneficiary = Beneficiaries::findOrFail($id);

        return view('beneficiary.show', compact('beneficiary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiary = Beneficiaries::findOrFail($id);
        $sponsers = Sponser::all();

        return view('admin.beneficiaries.edit', compact('beneficiary', 'sponsers'));
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
            'name' => 'required|string|max:100',
            'type' => 'required|in:سنوي,شهري',
            'sponser_id' => 'required|exists:sponsers,id',
        ]);
        

        $beneficiary = Beneficiaries::findOrfail($id);

        $beneficiary->update($request->all());

        return redirect()->route('beneficiary.index')->with('success', 'Beneficiary Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Beneficiaries::destroy($id);

        return redirect()->route('beneficiary.index')->with('success', 'Beneficiary Deleted!');
    }
}
