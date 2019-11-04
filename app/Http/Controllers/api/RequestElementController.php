<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\Api\RequestElementRequest;
use App\RequestElement;
use App\RequestForm;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RequestElementController extends Controller
{
    use ApiResponser;

    /**
     *
     * @SWG\Get(
     *      tags={"forms elements"},
     *      path="/requests/{form}/elements",
     *      summary="Get form elements",
     *      @SWG\Parameter(
     *         name="form",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RequestForm $form)
    {
        $rows = $form->elements;
        return $this->showAll($rows,200);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"forms elements"},
     *      path="/requests/{form}/elements",
     *      summary="add New element",
     *       @SWG\Parameter(
     *         name="form",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="title",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="type",
     *         in="formData",
     *         description="type(text, select, checkbox)",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="value",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="validation",
     *         in="formData",
     *         description="validation(1,0)",
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="placeholder",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param RequestForm $form
     * @param RequestElementRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RequestForm $form,RequestElementRequest $request)
    {
        $element =$form->elements()->create($request->all());
        return $this->showOne($element);
    }

    /**
     *
     * @SWG\Post(
     *      tags={"forms elements"},
     *      path="/elements/{element}/update",
     *      summary="add update element",
     *      @SWG\Parameter(
     *         name="element",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="title",
     *         in="formData",
     *         required=true,
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="type",
     *         in="formData",
     *         description="type(text, select, checkbox)",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="value",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),@SWG\Parameter(
     *         name="validation",
     *         in="formData",
     *         description="validation(1,0)",
     *         type="integer",
     *         format="integer",
     *      ),@SWG\Parameter(
     *         name="placeholder",
     *         in="formData",
     *         type="string",
     *         format="string",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     * @param RequestElementRequest $request
     * @param RequestElement $element
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RequestElementRequest $request, RequestElement $element)
    {
        $element->update($request->all());
        return $this->showOne($element);
    }

    /**
     *
     * @SWG\post(
     *      tags={"forms elements"},
     *      path="/elements/{element}/destroy",
     *      summary="delete element",
     *      @SWG\Parameter(
     *         name="element",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     *      ),
     * @param RequestForm $form
     * @param RequestElement $element
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(RequestForm $form,RequestElement $element)
    {
        $element->delete();
        return response()->json(null,204);
    }
}
