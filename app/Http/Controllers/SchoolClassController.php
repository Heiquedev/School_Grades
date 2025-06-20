<?php

namespace App\Http\Controllers;

use App\Models\School_Class;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class = School_Class::all();
        return response()->json([
            'success' => true,
            'msg' => 'SchoolClass listed successfully',
            'SchoolClassCount' => $class->count(),
            'SchoolClass' => $class
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'class_leader_id' => 'required|exists:teachers,id',
                    'student_id'  => 'required|exists:students,id',

                ],

                [
                    'name.required' => 'Name is required',
                    'class_leader_id.required' => 'Class leader is required',
                    'class_leader_id.exists' => 'Class leader must be a valid user',
                    'student_id.required' => 'Class leader is required',
                    'student_id.exists' => 'Class leader must be a valid user',

                ]
            );

            $school_Class = School_Class::create($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while crate the school class',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'School class created with successfully',
            'data' => $school_Class
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(School_Class $school_Class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(School_Class $school_Class)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'class_leader_id' => 'required|exists:teachers,id',
                    'student_id'  => 'required|exists:students,id',

                ],

                [
                    'name.required' => 'Name is required',
                    'class_leader_id.required' => 'Class leader is required',
                    'class_leader_id.exists' => 'Class leader must be a valid user',
                    'student_id.required' => 'Class leader is required',
                    'student_id.exists' => 'Class leader must be a valid user',

                ]
            );

            $schoolClass = School_Class::findOrFail($id);
            $schoolClass->update($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while updating school class',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => "School Class from $schoolClass->id updated successfully",
            'data' => $schoolClass
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { {
            try {
                $school_Class = School_Class::findOrFail($id);
                $school_Class->delete();
                return response()->json([
                    'success' => true,
                    'msg' => "Scholl class $school_Class class->name deleted successfully"
                ], 200);
            } catch (\Exception $error) {
                return response()->json([
                    'success' => false,
                    'msg' => "Failed to delete Scholl class",
                    'error' => $error->getMessage()
                ], 500);
            }
        }
    }
}
