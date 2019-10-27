<?php

namespace App\Http\Controllers\api;

use App\Supplier;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    use ApiResponser;
    /**
     *
     * @SWG\Get(
     *      tags={"Suppliers"},
     *      path="/suppliers",
     *      summary="Get all Suppliers",
     *
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
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
    /**
     *
     * @SWG\Get(
     *      tags={"Suppliers"},
     *      path="/supplier/{supplier}",
     *      summary="Get one supplier",
     *       @SWG\Parameter(
     *         name="supplier",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */
    public function show(Supplier $supplier)
    {
        return $this->showOne($supplier);
    }
}
