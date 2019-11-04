<?php

namespace App\Http\Controllers\api;

use App\Holiday;
use App\Http\Requests\Api\HolidayRequest;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    use ApiResponser;

    /**
     *
     * @SWG\Get(
     *      tags={"holidays"},
     *      path="/holidays",
     *      summary="Get all holidays",
     *
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function index()
    {
        $rows = Holiday::all();
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"holidays"},
     *      path="/holidays",
     *      summary="add new holiday",
     *      @SWG\Parameter(
     *         name="title",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         required=true,
     *         description="2019-10-14",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="active",
     *         in="formData",
     *         required=true,
     *     description="(1,2))",
     *          type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     *      ),
     * @param HolidayRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HolidayRequest $request)
    {
        $holiday =Holiday::create($request->all());
        return $this->showOne($holiday);
    }

    /**
     *
     * @SWG\post(
     *      tags={"holidays"},
     *      path="/holidays/{holiday}/update",
     *      summary="update holiday",
     *      @SWG\Parameter(
     *         name="holiday",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Parameter(
     *         name="title",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="date",
     *         in="formData",
     *         required=true,
     *          description="2019-10-14",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="active",
     *         in="formData",
     *     description="(1,2))",
     *         required=true,
     *          type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     *      ),
     * @param HolidayRequest $request
     * @param Holiday $holiday
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HolidayRequest $request, Holiday $holiday)
    {
        $holiday->update($request->all());
        return $this->showOne($holiday);
    }

    /**
     *
     * @SWG\post(
     *      tags={"holidays"},
     *      path="/holidays/{holiday}/destroy",
     *      summary="delete holiday",
     *      @SWG\Parameter(
     *         name="holiday",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     *      ),
     * @param Holiday $holiday
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json(null,204);
    }
}
