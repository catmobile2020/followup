<?php

namespace App\Http\Controllers\api;

use App\Holiday;
use App\Http\Requests\Api\HolidayRequest;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;

class HolidayController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $rows = Holiday::all();
        return $this->showAll($rows,200);
    }


    public function store(HolidayRequest $request)
    {
        $holiday =Holiday::create($request->all());
        return $this->showOne($holiday);
    }

    public function update(HolidayRequest $request, Holiday $holiday)
    {
        $holiday->update($request->all());
        return $this->showOne($holiday);
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json(null,204);
    }
}
