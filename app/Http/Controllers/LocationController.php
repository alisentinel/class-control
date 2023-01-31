<?php

namespace App\Http\Controllers;


use App\Models\Location;
use Exception;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {



        $locations = Location::latest()->where($request->except('page', 'limit', 'offset'))->paginate($request->input('limit', 10));
        return [
            "status" => 200,
            "data" => $locations
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
            $location = Location::create($request->all());
            return response()->json(["status" => 200, "message" => "Location created successfully", "data" => $location], 201);
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
     * @param  \App\Models\Location  $location
     */
    public function show(Location $location, Exception $exception)
    {
        return [
            "status" => 200,
            "data" => $location
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     */
    public function update(Request $request, Location $location)
    {
        $location->update($request->all());

        return [
            "status" => 200,
            "data" => $location,
            "message" => "Location updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     */
    public function destroy(Location $location)
    {
        //
    }
}
