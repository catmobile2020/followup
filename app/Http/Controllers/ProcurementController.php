<?php

namespace App\Http\Controllers;

use App\Procurement;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procurements = Procurement::all();
        return view('procurements.index', compact('procurements'));
    }

    public function all()
    {

        $procurements = Procurement::all();
        return view('procurements.all', compact('procurements'));
    }

    public function allDemo()
    {

        $procurements = Procurement::where('status','>=', 2)->get();
        return view('procurements.all', compact('procurements'));
    }

    public function allExecute()
    {

        $procurements = Procurement::where('status','>=',  3)->get();
        return view('procurements.all', compact('procurements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::where('active', 1)->get();
        return view('procurements.create', compact('suppliers'));
    }

    public function reply(Procurement $procurement)
    {
        return view('procurements.reply', compact('procurement'));
    }

    public function manage(Procurement $procurement)
    {
        return view('procurements.manager', compact('procurement'));
    }

    public function demo(Procurement $procurement)
    {
        $procurement->status = 2;
        $procurement->save();
        return redirect('/admin/po')->with('demo', $procurement->company_name);
    }

    public function execute(Procurement $procurement)
    {
        $procurement->status = 3;
        $procurement->save();
        return redirect('/admin/po')->with('execute', $procurement->company_name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name'=>'required',
            'po_number'=>'required',
            'deadline'=>'required',
        ]);


        $procurement = Procurement::create([
            'company_name'=>$request->company_name,
            'po_number'=>$request->po_number,
            'supplier_id'=>$request->supplier_id,
            'items'=>$request->items,
            'deadline'=>$request->deadline,
            'place'=>$request->place,
            'details'=>$request->details,
            'status'=>0,
            'user_id'=>Auth::user()->id
        ]);

        return redirect('admin/po')->with('status', $procurement->po_number);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function show(Procurement $po)
    {
        return view('procurements.show', compact('po'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function edit(Procurement $procurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Procurement $procurement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Procurement  $procurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Procurement $procurement)
    {
        //
    }
}
