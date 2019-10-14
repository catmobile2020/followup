<?php

namespace App\Http\Controllers\api;

use App\Supplier;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    use ApiResponser;
    public function index()
    {
        if(empty($_GET['page']) || $_GET['page']==''){
            $suppliers = Supplier::where('active', 1)->get();
        }else{
            $suppliers = Supplier::where('active', 1)->paginate(10);
            return response()->json(['data' => $suppliers, 'state' => 1], 200);
        }
        return $this->showAll($suppliers);
    }

    public function show(Supplier $supplier)
    {
        return $this->showOne($supplier);
    }
}
