<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teachers::all();
        return response()->json([
            'success' => true,
            'msg' => 'Teachers listed successfully',
            'teachersCount' => $teachers->count(),
            'teachers' => $teachers
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate(
                [
                    'name' => 'required|string',
                    'graduation' => 'required|string',
                    'dicipline'  => 'required|string',
                ],
                [
                    'name.required' => 'Name is required',
                    'graduation.required' => 'Graduation is required',
                    'dicipline.required' => 'Dicipline is required',
                ]
            );

            $teachers = Teachers::create($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while crate the Theacher',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => 'Teacher created with successfully',
            'data' => $teachers
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Teachers $teachers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teachers $teachers)
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
                    'graduation' => 'required|string',
                    'dicipline'  => 'required|string',
                ],
                [
                    'name.required' => 'Name is required',
                    'graduation.required' => 'Graduation is required',
                    'dicipline.required' => 'Dicipline is required',
                ]
            );

            $teacher = Teachers::findOrFail($id);
            $teacher->update($request->all());
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => 'Error occurred while updating teacher',
                'error' => $error->getMessage(),
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg' => "Teacher from $teacher->id updated successfully",
            'data' => $teacher
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $teacher = Teachers::findOrFail($id);
            $teacher->delete();
            return response()->json([
                'success' => true,
                'msg' => "Teacher $teacher->name deleted successfully"
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'success' => false,
                'msg' => "Failed to delete Teacher",
                'error' => $error->getMessage()
            ], 500);
        }
    }
}
