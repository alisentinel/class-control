<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\Request;

trait CrudOperations
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $model = $this->getModelInstance();

        $items = $model::latest()->where($request->except('page', 'limit', 'offset'))->paginate($request->input('limit', 10));

        return [
            "status" => 200,
            "data" => $items
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        try {
            $model = $this->getModelInstance();

            $item = $model::create($request->all());

            return response()->json(["status" => 200, "message" => $this->getModelName() . " created successfully", "data" => $item], 201);
        } catch (Exception $e) {
            return [
                "status" => 0,
                "message" => $e->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $model = $this->getModelInstance();

        $item = $model::findOrFail($id);

        return [
            "status" => 200,
            "data" => $item
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        $model = $this->getModelInstance();

        $item = $model::findOrFail($id);

        $item->update($request->all());

        return [
            "status" => 200,
            "data" => $item,
            "message" => $this->getModelName() . " updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $model = $this->getModelInstance();

        $item = $model::findOrFail($id);

        $item->delete();

        return [
            "status" => 200,
            "message" => $this->getModelName() . " deleted successfully"
        ];
    }

    /**
     * Get the instance of the model associated with the controller.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    abstract protected function getModelInstance();

    /**
     * Get the name of the model associated with the controller.
     *
     * @return string
     */
    abstract protected function getModelName();
}
