<?php

namespace App\Http\Controllers;

use App\Procurement;
use App\ProcurementLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcurementLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'notes' => 'sometimes|nullable',
            'attaches' => 'sometimes|nullable',
            'procurement_id' => 'integer|required',
            'status' => 'required'
        ]);


        $OfferPrice = ProcurementLog::create([
            'procurement_id' => $request->procurement_id,
            'notes' => $request->notes,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        $x = 1;
        foreach ($request->attaches as $attach) {
            $image_filename = 'manage' . $x . $OfferPrice->id . time() . '.' . $attach->getClientOriginalExtension();
            $attach->move(public_path('uploads'), $image_filename);
            $OfferPrice->photos()->create(['path' => 'uploads/' . $image_filename]);
            $x++;
        }

        $procurement = Procurement::findOrFail($request->procurement_id);
        if ($request->procurement_status == 2 && $request->status == 1){
            $procurement->status = 4;
        }elseif($request->procurement_status == 2 && $request->status == 0){
            $procurement->status = 5;
        }

        if($request->procurement_status == 3 && $request->status == 1){
        switch (Auth::user()->team->name){
            case 'Management':
                $procurement->status = 6;
                break;

            case 'Accounts':
                $procurement->status = 4;

                break;
        }
        }elseif($request->procurement_status == 3 && $request->status == 0){
            switch (Auth::user()->team->name){
                case 'Management':
                    $procurement->status = 7;
                    break;

                case 'Accounts':
                    $procurement->status = 5;
                    break;
            }
        }
        $procurement->save();

        return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProcurementLog  $procurementLog
     * @return \Illuminate\Http\Response
     */
    public function show(ProcurementLog $procurementLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProcurementLog  $procurementLog
     * @return \Illuminate\Http\Response
     */
    public function edit(ProcurementLog $procurementLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProcurementLog  $procurementLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProcurementLog $procurementLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProcurementLog  $procurementLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProcurementLog $procurementLog)
    {
        //
    }
}
