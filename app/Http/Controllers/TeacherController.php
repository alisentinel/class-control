<?php

namespace App\Http\Controllers;


use App\Models\Teacher;
use Exception;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {



        $teachers = Teacher::latest()->where($request->except('page', 'limit', 'offset'))->paginate($request->input('limit', 10));
        return [
            "status" => 200,
            "data" => $teachers
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
            $teacher = Teacher::create($request->all());
            return response()->json(["status" => 200, "message" => "Teacher created successfully", "data" => $teacher], 201);
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
     * @param  \App\Models\Teacher  $teacher
     */
    public function show(Teacher $teacher, Exception $exception)
    {
        return [
            "status" => 200,
            "data" => $teacher
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     */
    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update($request->all());

        return [
            "status" => 200,
            "data" => $teacher,
            "message" => "Teacher updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     */
    public function destroy(Teacher $teacher)
    {
        //
    }
}
