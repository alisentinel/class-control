<?php

namespace App\Http\Controllers;


use App\Models\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {



        $roles = Role::latest()->where($request->except('page', 'limit', 'offset'))->paginate($request->input('limit', 10));
        return [
            "status" => 200,
            "data" => $roles
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
            $role = Role::create($request->all());
            return response()->json(["status" => 200, "message" => "Role created successfully", "data" => $role], 201);
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
     * @param  \App\Models\Role  $role
     */
    public function show(Role $role, Exception $exception)
    {
        return [
            "status" => 200,
            "data" => $role
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());

        return [
            "status" => 200,
            "data" => $role,
            "message" => "Role updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     */
    public function destroy(Role $role)
    {
        //
    }
}
