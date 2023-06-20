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

        $search = $request->input('search');

        // Check if search is true search in database using like otherwise search for exact value
        if($search) {
            foreach($request->except('page', 'limit', 'offset', 'search') as $key => $value) {
                $items[] = $model::latest()->where($key, 'like', '%' . $value . '%')->paginate($request->input('limit', 10));
            }
        } else {
            $items = $model::latest()->where($request->except('page', 'limit', 'offset', 'search'))->paginate($request->input('limit', 10));
        }

        $code = empty($items['data']) ? 404 : 200;

        return $this->returnResponse($code, $items);
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

            return $this->returnResponse(201, $item, $this->getModelName() . " created successfully");
        } catch (Exception $e) {
            return [
                "status" => 400,
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

        return $this->returnResponse(200, $item);
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

        return $this->returnResponse(200, $item, $this->getModelName() . " updated successfully"
        );
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

        return $this->returnResponse(200, null, $this->getModelName() . " deleted successfully");

    }

    private function returnResponse($code, $data = null, $message = null)
    {
        return response()->json(
            ['status' => $code, 'data' => $data, 'message' => $message],
            $code);
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
