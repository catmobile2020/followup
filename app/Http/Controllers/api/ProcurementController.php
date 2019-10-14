<?php

namespace App\Http\Controllers\api;

use App\OfferPrice;
use App\Procurement;
use App\ProcurementLog;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProcurementController extends Controller
{
    use ApiResponser;

    /*
     * Create new procurement
     */
    public function create(Request $request){
        $this->validate($request, [
            'user_id'=>'required|exists:users,id',
            'supplier_id'=>'required|exists:suppliers,id',
            'company_name'=>'required',
            'po_number'=>'required',
            'deadline'=>'required',
            'items'=>'required',
            'details'=>'required',
            'place'=>'required',
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
            'user_id'=>$request->user_id
        ]);

        return $this->successResponse('Procurement Added Successfully',200);
    }

    /*
     * Show All Procurements for specified User
     */

    public function show(User $user){
        $procurements = $user->procurements;

        return $this->showAll($procurements);
    }

    /*
     * Show Full Procurement Data
     */

    public function showProcurement(Procurement $procurement){
        switch ($procurement->status) {
            case 1:
                $bg = 'success';
                $stat = 'Confirmed from procurement manager';
                break;
            case 2:
                $bg = 'info';
                $stat = 'pending(Demo requested)';
                break;
            case 3:
                $bg = 'info';
                $stat = 'pending(Execute requested)';
                break;
            case 4:
                $bg = 'success';
                $stat = 'Accountant has confirmed your request';
                break;
            case 5:
                $bg = 'danger';
                $stat = 'Accountant has rejected your request';
                break;
            case 6:
                $bg = 'success';
                $stat = 'Manager has confirmed your request';
                break;
            case 7:
                $bg = 'danger';
                $stat = 'Manager has rejected your request';
                break;
            default:
                $bg = 'disabled';
                $stat = 'Pending (waiting for Price Offer)';
        }
        $procurement->status = $stat;
        foreach ($procurement->offers as $offer){
            if(count($offer->photos) > 0){
                foreach ($offer->photos->pluck('path') as $photo){
                    $offer->photos = $photo;
                }
            }else{
                $offer->files = null;
            }
        }

        foreach ($procurement->offers as $offer){
            if(count($offer->photos) > 0){
                foreach ($offer->photos()->pluck('path') as $photo){
                    $offer->photos = $photo;
                }
            }else{
                $offer->photos = null;
            }
        }

        foreach ($procurement->logs as $log){
            if(count($log->photos) > 0){
                foreach ($log->photos()->pluck('path') as $photo){
                    $log->photos = $photo;
                }
            }else{
                $log->photos = null;
            }
        }

        return response()->json(['data'=>$procurement, 'state'=>1]);
    }


    /*
     * show ALl Procurements For Procurement Manager
     */

    public function manager(User $user){

        if($user->role->name == 'Admin' && $user->team->name == 'Procurement')
        {
            $procurements = Procurement::all();

            foreach ($procurements as $procurement){
                switch ($procurement->status) {
                    case 1:
                        $bg = 'success';
                        $stat = 'Confirmed from procurement manager';
                        break;
                    case 2:
                        $bg = 'info';
                        $stat = 'pending(Demo requested)';
                        break;
                    case 3:
                        $bg = 'info';
                        $stat = 'pending(Execute requested)';
                        break;
                    case 4:
                        $bg = 'success';
                        $stat = 'Accountant has confirmed your request';
                        break;
                    case 5:
                        $bg = 'danger';
                        $stat = 'Accountant has rejected your request';
                        break;
                    case 6:
                        $bg = 'success';
                        $stat = 'Manager has confirmed your request';
                        break;
                    case 7:
                        $bg = 'danger';
                        $stat = 'Manager has rejected your request';
                        break;
                    default:
                        $bg = 'disabled';
                        $stat = 'Pending (waiting for Price Offer)';
                }
                $procurement->status = $stat;
            }

            return $this->showAll($procurements);
        }else{
            return response()->json(["data"=>"You don/'t have permission to enter this page", "state"=>0],200);
        }
    }

    /*
     * Add new offer price
     */

    public function addOffer(Request $request, Procurement $procurement){

        $this->validate($request, [
            'user_id'=>'required|exists:users,id',
            'notes'=>'sometimes|nullable',
            'attaches'=>'sometimes|nullable'
        ]);

        $user = User::find($request->user_id);

        if($user->role->name == 'Admin' && $user->team->name == 'Procurement')
        {
            $OfferPrice = OfferPrice::create([
                'procurement_id'=>$procurement->id,
                'notes'=>$request->notes,
            ]);

            $x=1;
            foreach ($request->attaches as $attach){
                $image_filename = $x.$OfferPrice->id.time().'.'.$attach->getClientOriginalExtension();
                $attach->move(public_path('uploads'), $image_filename);
                $OfferPrice->photos()->create(['path'=>'uploads/'.$image_filename]);
                $x++;
            }

            $procurement->status = 1 ;
            $procurement->save();

            return $this->showProcurement($procurement);
        }else{
            return response()->json(["data"=>"You don/'t have permission to enter this page", "state"=>0],200);
        }
    }

    /*
     * Request Demo
     */
    public function demo(Request $request, Procurement $procurement)
    {
        $this->validate($request, [
            'user_id'=>'required|exists:users,id'
        ]);

        if($procurement->user->id == $request->user_id)
        {
            if($procurement->status == 1)
            {
                $procurement->status = 2 ;
                $procurement->save();
                return response()->json(['data'=>'pending(Demo requested)', 'state'=>1], 200);
            }else{
                return response()->json(['data'=>'You can\'t update status now', 'state'=>1], 200);
            }

        }else{
            return response()->json(['data'=>'You don\'t authorize to request Demo', 'state'=>0], 200);
        }
    }

    /*
     * Request Execute
     */
    public function execute(Request $request, Procurement $procurement)
    {
        $this->validate($request, [
            'user_id'=>'required|exists:users,id'
        ]);

        if($procurement->user->id == $request->user_id)
        {
            if($procurement->status >= 1 AND $procurement->status < 3)
            {
                $procurement->status = 3 ;
                $procurement->save();

                return response()->json(['data'=>'pending(Demo requested)', 'state'=>1], 200);
            }else{
                return response()->json(['data'=>'You can\'t update status now', 'state'=>1], 200);
            }

        }else{
            return response()->json(['data'=>'You don\'t authorize to request Demo', 'state'=>0], 200);
        }
    }

    /*
     * Add procurement log
     */

    public function addLog(Request $request, Procurement $procurement)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'notes' => 'sometimes|nullable',
            'attaches' => 'sometimes|nullable',
            'status' => 'required'
        ]);
        $user = User::find($request->user_id);

        if($user->team->name == 'Management' && $user->role->name == 'Admin')
        {

            if($procurement->status == 3){
                $OfferPrice = ProcurementLog::create([
                    'procurement_id' => $procurement->id,
                    'notes' => $request->notes,
                    'status' => $request->status,
                    'user_id' => $user->id,
                ]);

                $x = 1;
                foreach ($request->attaches as $attach) {
                    $image_filename = 'manage' . $x . $OfferPrice->id . time() . '.' . $attach->getClientOriginalExtension();
                    $attach->move(public_path('uploads'), $image_filename);
                    $OfferPrice->photos()->create(['path' => 'uploads/' . $image_filename]);
                    $x++;
                }
                switch ($request->status)
                {
                    case 1:
                        $procurement->status = 6;
                        $stat = 'Manager has confirmed successfully';
                        break;

                    case 0:
                        $procurement->status = 7;
                        $stat = 'Manager has rejected the job successfully';
                        break;
                }
                $procurement->save();
                return response()->json(['data'=>$stat, 'state'=>1], 200);
            }else{
                return response()->json(['data'=>'You can\'t update job status' , 'state'=>0], 200);
            }
        }

        if($user->team->name == 'Accounts' && $user->role->name == 'Admin')
        {

            if($procurement->status == 2 || $procurement->status == 3){
                $OfferPrice = ProcurementLog::create([
                    'procurement_id' => $procurement->id,
                    'notes' => $request->notes,
                    'status' => $request->status,
                    'user_id' => $user->id,
                ]);

                $x = 1;
                foreach ($request->attaches as $attach) {
                    $image_filename = 'manage' . $x . $OfferPrice->id . time() . '.' . $attach->getClientOriginalExtension();
                    $attach->move(public_path('uploads'), $image_filename);
                    $OfferPrice->photos()->create(['path' => 'uploads/' . $image_filename]);
                    $x++;
                }
                switch ($request->status)
                {
                    case 1:
                        $procurement->status = 4;
                        $stat = 'Accountant has confirmed successfully';
                        break;

                    case 0:
                        $procurement->status = 5;
                        $stat = 'Accountant has rejected the job successfully';
                        break;
                }
                $procurement->save();
                return response()->json(['data'=>$stat, 'state'=>1], 200);
            }else{
                return response()->json(['data'=>'You can\'t update job status' , 'state'=>0], 200);
            }

        }



    }


}
