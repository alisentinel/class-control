<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Exception;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {



        $sessions = Session::latest()->where($request->except('page', 'limit', 'offset'))->paginate($request->input('limit', 10));
        return [
            "status" => 200,
            "data" => $sessions
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
            $session = Session::create($request->all());
            return response()->json(["status" => 200, "message" => "Session created successfully", "data" => $session], 201);
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
     * @param  \App\Models\Session  $session
     */
    public function show(Session $session, Exception $exception)
    {
        return [
            "status" => 200,
            "data" => $session
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Session  $session
     */
    public function edit(Session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Session  $session
     */
    public function update(Request $request, Session $session)
    {
        $session->update($request->all());

        return [
            "status" => 200,
            "data" => $session,
            "message" => "Session updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Session  $session
     */
    public function destroy(Session $session)
    {
        //
    }
}
