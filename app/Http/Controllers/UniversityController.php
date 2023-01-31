<?php

namespace App\Http\Controllers;


use App\Models\University;
use Exception;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {



        $universities = University::latest()->where($request->except('page', 'limit', 'offset'))->paginate($request->input('limit', 10));
        return [
            "status" => 200,
            "data" => $universities
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
            $university = University::create($request->all());
            return response()->json(["status" => 200, "message" => "University created successfully", "data" => $university], 201);
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
     * @param  \App\Models\University  $university
     */
    public function show(University $university, Exception $exception)
    {
        return [
            "status" => 200,
            "data" => $university
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\University  $university
     */
    public function edit(University $university)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\University  $university
     */
    public function update(Request $request, University $university)
    {
        $university->update($request->all());

        return [
            "status" => 200,
            "data" => $university,
            "message" => "University updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\University  $university
     */
    public function destroy(University $university)
    {
        //
    }
}
