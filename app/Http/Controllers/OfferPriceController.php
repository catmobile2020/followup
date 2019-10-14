<?php

namespace App\Http\Controllers;

use App\OfferPrice;
use App\Procurement;
use Illuminate\Http\Request;

class OfferPriceController extends Controller
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
            'notes'=>'sometimes|nullable',
            'attaches'=>'sometimes|nullable',
            'procurement_id'=>'integer|required'
        ]);


        $OfferPrice = OfferPrice::create([
            'procurement_id'=>$request->procurement_id,
            'notes'=>$request->notes,
        ]);

        $x=1;
        foreach ($request->attaches as $attach){
            $image_filename = $x.$OfferPrice->id.time().'.'.$attach->getClientOriginalExtension();
            $attach->move(public_path('uploads'), $image_filename);
            $OfferPrice->photos()->create(['path'=>'uploads/'.$image_filename]);
            $x++;
        }

        $procurement = Procurement::findOrFail($request->procurement_id);
        $procurement->status = 1 ;
        $procurement->save();

        return redirect('admin/all-pos')->with('status', $procurement->po_number);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OfferPrice  $offerPrice
     * @return \Illuminate\Http\Response
     */
    public function show(OfferPrice $offerPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OfferPrice  $offerPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(OfferPrice $offerPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OfferPrice  $offerPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OfferPrice $offerPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OfferPrice  $offerPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(OfferPrice $offerPrice)
    {
        //
    }
}
